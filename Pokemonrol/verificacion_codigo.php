<?php
echo "╔══════════════════════════════════════════════════════════════╗\n";
echo "║  VERIFICACIÓN DE CÓDIGO: VALIDACIÓN DE NIVEL DE MOVIMIENTOS  ║\n";
echo "╚══════════════════════════════════════════════════════════════╝\n\n";

$errores = 0;
$tests_pasados = 0;

// TEST 1: Verificar que learn_move.php tiene validación de nivel
echo "TEST 1: Verificar api/learn_move.php\n";
echo str_repeat("-", 60) . "\n";

$archivo = 'api/learn_move.php';
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    
    // Buscar validaciones clave
    $checks = [
        'nivel_requerido' => strpos($contenido, 'nivel_requerido') !== false,
        'SELECT.*nivel.*pokemon_box' => preg_match('/SELECT.*nivel.*FROM\s+pokemon_box/i', $contenido),
        'nivel_pokemon.*nivel_requerido' => preg_match('/nivel_pokemon\s*<\s*nivel_requerido/', $contenido),
        'error mensaje nivel' => strpos($contenido, 'necesita nivel') !== false
    ];
    
    foreach ($checks as $check => $resultado) {
        if ($resultado) {
            echo "  ✓ Contiene: $check\n";
            $tests_pasados++;
        } else {
            echo "  ✗ FALTA: $check\n";
            $errores++;
        }
    }
} else {
    echo "  ✗ ERROR: Archivo no encontrado\n";
    $errores += 4;
}

// TEST 2: Verificar admin_teach_move.php
echo "\nTEST 2: Verificar api/admin_teach_move.php\n";
echo str_repeat("-", 60) . "\n";

$archivo = 'api/admin_teach_move.php';
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    
    $checks = [
        'nivel_requerido' => strpos($contenido, 'nivel_requerido') !== false,
        'validación de nivel' => preg_match('/nivel_pokemon\s*<\s*nivel_requerido/', $contenido),
        'error mensaje' => strpos($contenido, 'necesita nivel') !== false
    ];
    
    foreach ($checks as $check => $resultado) {
        if ($resultado) {
            echo "  ✓ Contiene: $check\n";
            $tests_pasados++;
        } else {
            echo "  ✗ FALTA: $check\n";
            $errores++;
        }
    }
} else {
    echo "  ✗ ERROR: Archivo no encontrado\n";
    $errores += 3;
}

// TEST 3: Verificar pokemon-info.js (Frontend)
echo "\nTEST 3: Verificar scripts/pokemon-info.js\n";
echo str_repeat("-", 60) . "\n";

$archivo = 'scripts/pokemon-info.js';
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    
    $checks = [
        'move-locked class' => strpos($contenido, 'move-locked') !== false,
        'nivel validación' => preg_match('/nivelActual\s*>=\s*nivelRequerido/i', $contenido) || preg_match('/puedeAprender/', $contenido),
        'disabled button' => strpos($contenido, 'disabled') !== false,
        'candado emoji' => strpos($contenido, '🔒') !== false
    ];
    
    foreach ($checks as $check => $resultado) {
        if ($resultado) {
            echo "  ✓ Contiene: $check\n";
            $tests_pasados++;
        } else {
            echo "  ✗ FALTA: $check\n";
            $errores++;
        }
    }
} else {
    echo "  ✗ ERROR: Archivo no encontrado\n";
    $errores += 4;
}

// TEST 4: Verificar estilos CSS
echo "\nTEST 4: Verificar style.css\n";
echo str_repeat("-", 60) . "\n";

$archivo = 'style.css';
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    
    $checks = [
        '.move-locked' => strpos($contenido, '.move-locked') !== false,
        'opacity para locked' => preg_match('/\.move-locked\s*{[^}]*opacity\s*:/i', $contenido),
        'color gris' => preg_match('/\.move-locked.*#(999|ccc|e9ecef)/is', $contenido)
    ];
    
    foreach ($checks as $check => $resultado) {
        if ($resultado) {
            echo "  ✓ Contiene: $check\n";
            $tests_pasados++;
        } else {
            echo "  ✗ FALTA: $check\n";
            $errores++;
        }
    }
} else {
    echo "  ✗ ERROR: Archivo no encontrado\n";
    $errores += 3;
}

// TEST 5: Verificar migración SQL
echo "\nTEST 5: Verificar migrations/add_nivel_requerido_movimientos.sql\n";
echo str_repeat("-", 60) . "\n";

$archivo = 'migrations/add_nivel_requerido_movimientos.sql';
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    
    $checks = [
        'ALTER TABLE' => strpos($contenido, 'ALTER TABLE') !== false,
        'nivel_requerido' => strpos($contenido, 'nivel_requerido') !== false,
        'UPDATE statements' => preg_match_all('/UPDATE\s+movimientos/i', $contenido) >= 3
    ];
    
    foreach ($checks as $check => $resultado) {
        if ($resultado) {
            echo "  ✓ Contiene: $check\n";
            $tests_pasados++;
        } else {
            echo "  ✗ FALTA: $check\n";
            $errores++;
        }
    }
} else {
    echo "  ✗ ERROR: Archivo no encontrado\n";
    $errores += 3;
}

// TEST 6: Verificar admin.php tiene modal y funciones
echo "\nTEST 6: Verificar admin.php\n";
echo str_repeat("-", 60) . "\n";

$archivo = 'admin.php';
if (file_exists($archivo)) {
    $contenido = file_get_contents($archivo);
    
    $checks = [
        'teachMoveModal' => strpos($contenido, 'teachMoveModal') !== false,
        'showTeachMoveModal function' => strpos($contenido, 'function showTeachMoveModal') !== false,
        'teachMove function' => strpos($contenido, 'function teachMove()') !== false,
        'admin_teach_move.php call' => strpos($contenido, 'admin_teach_move.php') !== false,
        'nivel_requerido query' => strpos($contenido, 'nivel_requerido') !== false
    ];
    
    foreach ($checks as $check => $resultado) {
        if ($resultado) {
            echo "  ✓ Contiene: $check\n";
            $tests_pasados++;
        } else {
            echo "  ✗ FALTA: $check\n";
            $errores++;
        }
    }
} else {
    echo "  ✗ ERROR: Archivo no encontrado\n";
    $errores += 5;
}

// RESUMEN FINAL
echo "\n";
echo "╔══════════════════════════════════════════════════════════════╗\n";
echo "║  RESUMEN DE LA VERIFICACIÓN                                  ║\n";
echo "╚══════════════════════════════════════════════════════════════╝\n\n";

$total_tests = $tests_pasados + $errores;
$porcentaje = $total_tests > 0 ? round(($tests_pasados / $total_tests) * 100, 2) : 0;

echo "Checks ejecutados: $total_tests\n";
echo "Checks pasados: $tests_pasados ✓\n";
echo "Checks fallidos: $errores ✗\n";
echo "Porcentaje de éxito: $porcentaje%\n\n";

if ($errores === 0) {
    echo "╔══════════════════════════════════════════════════════════════╗\n";
    echo "║  ✓✓✓ TODOS LOS CHECKS PASADOS ✓✓✓                           ║\n";
    echo "║                                                              ║\n";
    echo "║  CORRECCIONES APLICADAS:                                     ║\n";
    echo "║  ✓ api/learn_move.php - Validación de nivel agregada        ║\n";
    echo "║  ✓ scripts/pokemon-info.js - UI bloqueada para Nv bajo      ║\n";
    echo "║  ✓ style.css - Estilos para movimientos bloqueados          ║\n";
    echo "║  ✓ admin.php - Modal y funciones ya validaban               ║\n";
    echo "║                                                              ║\n";
    echo "║  El problema estaba en api/learn_move.php que permitía      ║\n";
    echo "║  a los usuarios normales aprender cualquier movimiento      ║\n";
    echo "║  sin validar el nivel. Ahora está corregido.                ║\n";
    echo "║                                                              ║\n";
    echo "║  SIGUIENTE PASO:                                             ║\n";
    echo "║  1. Inicia MySQL/MariaDB en XAMPP                            ║\n";
    echo "║  2. Prueba en el navegador http://localhost/.../index.php   ║\n";
    echo "║  3. Intenta aprender un movimiento de alto nivel            ║\n";
    echo "║  4. Deberías ver un mensaje de error con el nivel requerido ║\n";
    echo "╚══════════════════════════════════════════════════════════════╝\n";
} else {
    echo "╔══════════════════════════════════════════════════════════════╗\n";
    echo "║  ⚠ SE ENCONTRARON $errores ERROR(ES)                                 ║\n";
    echo "║                                                              ║\n";
    echo "║  Por favor revisa los errores indicados arriba.             ║\n";
    echo "╚══════════════════════════════════════════════════════════════╝\n";
}
?>
