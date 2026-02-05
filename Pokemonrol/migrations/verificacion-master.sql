-- =====================================================
-- VERIFICACIÓN RÁPIDA DEL PANEL DE MASTER
-- Ejecuta estas consultas para verificar tu configuración
-- =====================================================

USE `rol`;

-- 1. VERIFICAR TU USUARIO MASTER
-- =====================================================
SELECT 
    id,
    nombre,
    apellido,
    correo,
    money,
    created_at,
    CASE 
        WHEN id = 67 THEN '✅ ERES EL MASTER'
        ELSE '❌ Necesitas cambiar tu ID a 67'
    END AS estado
FROM usuarios 
WHERE correo = 'albertogarciaquintana5@gmail.com';

-- Si tu ID NO es 67, ejecuta esto (ajusta el correo):
-- UPDATE usuarios SET id = 67 WHERE correo = 'tu_correo@ejemplo.com';

-- 2. VER TODOS LOS JUGADORES (excepto Master)
-- =====================================================
SELECT 
    id,
    nombre,
    apellido,
    correo,
    money,
    (SELECT COUNT(*) FROM pokemon_box WHERE user_id = usuarios.id) AS total_pokemon,
    (SELECT COUNT(*) FROM inventario WHERE user_id = usuarios.id) AS total_items
FROM usuarios 
WHERE id != 67
ORDER BY nombre;

-- 3. VERIFICAR QUE EXISTEN LAS TABLAS NECESARIAS
-- =====================================================
SELECT 
    TABLE_NAME,
    CASE 
        WHEN TABLE_NAME IN ('usuarios', 'pokemon_box', 'pokemon_species', 'items', 'inventario', 'team', 'movimientos', 'pokemon_movimiento') 
        THEN '✅ OK'
        ELSE '⚠️ Tabla adicional'
    END AS estado
FROM INFORMATION_SCHEMA.TABLES 
WHERE TABLE_SCHEMA = 'rol'
ORDER BY TABLE_NAME;

-- 4. VERIFICAR POKÉMON CON MOVIMIENTOS
-- =====================================================
SELECT 
    pb.id,
    ps.nombre AS especie,
    pb.apodo,
    pb.nivel,
    pb.hp,
    pb.max_hp,
    COUNT(pm.movimiento_id) AS num_movimientos
FROM pokemon_box pb
JOIN pokemon_species ps ON pb.species_id = ps.id
LEFT JOIN pokemon_movimiento pm ON pm.pokemon_box_id = pb.id
GROUP BY pb.id
ORDER BY pb.id;

-- 5. ESTADÍSTICAS GENERALES
-- =====================================================
SELECT 
    (SELECT COUNT(*) FROM usuarios WHERE id != 67) AS total_jugadores,
    (SELECT COUNT(*) FROM pokemon_box) AS total_pokemon,
    (SELECT COUNT(*) FROM pokemon_species) AS especies_disponibles,
    (SELECT COUNT(*) FROM items) AS items_disponibles,
    (SELECT COUNT(*) FROM movimientos) AS movimientos_disponibles,
    (SELECT SUM(cantidad) FROM inventario) AS items_en_inventarios;

-- 6. VERIFICAR CONFIGURACIÓN DE MOVIMIENTOS
-- =====================================================
-- Ver si hay Pokémon con movimientos asignados
SELECT 
    pb.id AS pokemon_id,
    ps.nombre AS especie,
    pb.apodo,
    m.nombre AS movimiento,
    pm.slot,
    pm.pp_actual,
    m.pp AS pp_max
FROM pokemon_box pb
JOIN pokemon_species ps ON pb.species_id = ps.id
JOIN pokemon_movimiento pm ON pm.pokemon_box_id = pb.id
JOIN movimientos m ON m.id = pm.movimiento_id
ORDER BY pb.id, pm.slot;

-- Si no hay resultados, significa que ningún Pokémon tiene movimientos asignados
-- Puedes asignar movimientos manualmente:
-- INSERT INTO pokemon_movimiento (pokemon_box_id, movimiento_id, slot, pp_actual) 
-- VALUES (1, 1, 1, 35); -- Pokemon ID 1, Movimiento ID 1, Slot 1, 35 PP

-- 7. CREAR USUARIO DE PRUEBA (si no tienes jugadores)
-- =====================================================
-- Descomenta para crear un jugador de prueba:
/*
INSERT INTO usuarios (nombre, apellido, correo, contraseña, money) VALUES
('Test', 'Jugador', 'test@jugador.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 500.00);

-- La contraseña es 'password'
-- Luego puedes darle un Pokémon de prueba:
SET @test_user_id = LAST_INSERT_ID();
INSERT INTO pokemon_box (user_id, species_id, apodo, nivel, hp, max_hp) 
VALUES (@test_user_id, 1, 'Pika de Prueba', 10, 50, 50);
*/

-- 8. VERIFICAR ACCESO A ADMIN.PHP
-- =====================================================
-- No se puede verificar desde SQL, pero asegúrate de:
-- 1. Apache y MySQL están corriendo en XAMPP
-- 2. Visita: http://localhost/DAW_EJERCICIOS/Pokemonrol/admin.php
-- 3. Si no eres ID 67, deberías ser redirigido al dashboard
-- 4. Si eres ID 67, deberías ver el panel de Master

-- =====================================================
-- NOTAS FINALES
-- =====================================================
-- • Si tu ID no es 67, usa la consulta UPDATE del punto 1
-- • Cierra sesión y vuelve a iniciar sesión después de cambiar el ID
-- • Para generar hashes de contraseña: <?php echo password_hash('TuContraseña', PASSWORD_DEFAULT); ?>
-- • Los jugadores NO pueden acceder a admin.php (solo ID 67)
-- • Todas las APIs de admin verifican que seas el usuario ID 67
