<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
try {
    require_once __DIR__ . '/../db.php';
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

if (!isset($_SESSION['user']['id'])) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$user_id = (int)$_SESSION['user']['id'];
$input = json_decode(file_get_contents('php://input'), true) ?: [];

$pokemon_box_id = isset($input['box_id']) ? (int)$input['box_id'] : 0;
$movimiento_id = isset($input['movimiento_id']) ? (int)$input['movimiento_id'] : 0;
$slot = isset($input['slot']) ? (int)$input['slot'] : 0;
$action = isset($input['action']) ? trim($input['action']) : 'add'; // 'add' o 'remove'

// Validaciones
if ($pokemon_box_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid box_id']);
    exit;
}

// Para 'add' se necesita movimiento_id válido. Para 'remove' no es necesario (solo slot)
if ($action === 'add' && $movimiento_id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid movimiento_id']);
    exit;
}

if ($slot < 1 || $slot > 4) {
    http_response_code(400);
    echo json_encode(['error' => 'Slot debe estar entre 1 y 4']);
    exit;
}

// Verificar que el Pokémon pertenece al usuario
$own_check = "SELECT id FROM pokemon_box WHERE id = ? AND user_id = ? LIMIT 1";
if (!$check_stmt = $mysqli->prepare($own_check)) {
    http_response_code(500);
    echo json_encode(['error' => 'Prepare failed']);
    exit;
}

$check_stmt->bind_param('ii', $pokemon_box_id, $user_id);
$check_stmt->execute();
$check_res = $check_stmt->get_result();
if ($check_res->num_rows === 0) {
    $check_stmt->close();
    http_response_code(403);
    echo json_encode(['error' => 'Pokémon no pertenece al usuario']);
    exit;
}
$check_stmt->close();


// Transacción para operación segura
$mysqli->begin_transaction();
try {
    if ($action === 'add') {
        // Verificar que el movimiento existe y obtener PP máximo
        $pp_sql = "SELECT pp FROM movimientos WHERE id = ? LIMIT 1";
        $pp_stmt = $mysqli->prepare($pp_sql);
        if (!$pp_stmt) throw new Exception('Prepare failed');
        $pp_stmt->bind_param('i', $movimiento_id);
        $pp_stmt->execute();
        $pp_res = $pp_stmt->get_result();
        $pp_row = $pp_res->fetch_assoc();
        $pp_stmt->close();
        
        if (!$pp_row) throw new Exception('Movimiento no encontrado');
        $pp_max = (int)$pp_row['pp'];

        // Comprobar si el Pokémon ya conoce este movimiento en otro slot
        $exists_sql = "SELECT slot FROM pokemon_movimiento WHERE pokemon_box_id = ? AND movimiento_id = ? LIMIT 1";
        $exists_stmt = $mysqli->prepare($exists_sql);
        if (!$exists_stmt) throw new Exception('Prepare failed');
        $exists_stmt->bind_param('ii', $pokemon_box_id, $movimiento_id);
        $exists_stmt->execute();
        $exists_res = $exists_stmt->get_result();
        if ($exists_res && $exists_res->num_rows > 0) {
            $row = $exists_res->fetch_assoc();
            $exists_stmt->close();
            if ((int)$row['slot'] !== $slot) {
                $exists_stmt->close();
                $mysqli->rollback();
                http_response_code(409); // Conflict: movimiento duplicado
                echo json_encode(['error' => 'El Pokémon ya conoce ese movimiento']);
                exit;
            }
            // Si es el mismo slot y la misma move, seguimos y actualizamos PP
        } else {
            $exists_stmt->close();
        }

        // Si hay otro movimiento en el slot objetivo, lo reemplazamos (asegurando unicidad por slot)
        $del_slot_sql = "DELETE FROM pokemon_movimiento WHERE pokemon_box_id = ? AND slot = ?";
        $del_slot_stmt = $mysqli->prepare($del_slot_sql);
        if (!$del_slot_stmt) throw new Exception('Prepare delete slot failed');
        $del_slot_stmt->bind_param('ii', $pokemon_box_id, $slot);
        if (!$del_slot_stmt->execute()) throw new Exception('Execute delete slot failed');
        $del_slot_stmt->close();

        // Insertar el nuevo movimiento en el slot
        $insert_sql = "INSERT INTO pokemon_movimiento (pokemon_box_id, movimiento_id, slot, pp_actual) 
                       VALUES (?, ?, ?, ?)";
        $insert_stmt = $mysqli->prepare($insert_sql);
        if (!$insert_stmt) throw new Exception('Prepare insert failed');
        $insert_stmt->bind_param('iiii', $pokemon_box_id, $movimiento_id, $slot, $pp_max);
        if (!$insert_stmt->execute()) throw new Exception('Execute insert failed');
        $insert_stmt->close();

    } elseif ($action === 'remove') {
        // Eliminar movimiento del slot
        $delete_sql = "DELETE FROM pokemon_movimiento 
                       WHERE pokemon_box_id = ? AND slot = ?";
        $delete_stmt = $mysqli->prepare($delete_sql);
        if (!$delete_stmt) throw new Exception('Prepare delete failed');
        $delete_stmt->bind_param('ii', $pokemon_box_id, $slot);
        if (!$delete_stmt->execute()) throw new Exception('Execute delete failed');
        $delete_stmt->close();
    } else {
        throw new Exception('Invalid action');
    }

    $mysqli->commit();

    // Devolver movimientos actualizados
    $movimientos_sql = "SELECT 
                            pm.slot,
                            pm.pp_actual,
                            m.id AS movimiento_id,
                            m.nombre,
                            m.potencia,
                            m.precision,
                            m.pp,
                            m.categoria,
                            m.descripcion,
                            t.nombre AS tipo,
                            t.color AS tipo_color
                        FROM pokemon_movimiento pm
                        JOIN movimientos m ON pm.movimiento_id = m.id
                        LEFT JOIN tipos t ON m.tipo_id = t.id
                        WHERE pm.pokemon_box_id = ?
                        ORDER BY pm.slot ASC";

    $movimientos = [];
    if ($mov_stmt = $mysqli->prepare($movimientos_sql)) {
        $mov_stmt->bind_param('i', $pokemon_box_id);
        $mov_stmt->execute();
        $mov_res = $mov_stmt->get_result();
        while ($row = $mov_res->fetch_assoc()) {
            $movimientos[] = $row;
        }
        $mov_stmt->close();
    }

    echo json_encode([
        'success' => true,
        'message' => $action === 'add' ? 'Movimiento aprendido' : 'Movimiento olvidado',
        'movimientos' => $movimientos,
    ]);

} catch (Exception $e) {
    $mysqli->rollback();
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

exit;
?>
