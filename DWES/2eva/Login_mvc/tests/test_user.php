<?php
/**
 * Test sencillo para el modelo User usando SQLite en memoria.
 * No requiere PHPUnit; se ejecuta con `php tests/test_user.php`.
 */

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/models/User.php';

// Usar SQLite en memoria para pruebas rápidas
$pdo = new PDO('sqlite::memory:');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec("CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    email TEXT NOT NULL UNIQUE,
    password_hash TEXT NOT NULL,
    nombre TEXT,
    rol TEXT DEFAULT 'user',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
)");

$userModel = new User($pdo);

try {
    $id = $userModel->create('test@example.com', 'testpass', 'Test User');
    echo "Usuario creado con id: $id\n";

    if ($userModel->verifyPassword('test@example.com', 'testpass')) {
        echo "Verificación: OK\n";
    } else {
        echo "Verificación: FALLÓ\n";
    }

    echo "Pruebas completadas.\n";
} catch (Exception $e) {
    echo "Error en pruebas: " . $e->getMessage() . "\n";
}
