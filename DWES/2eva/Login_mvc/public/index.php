<?php
// Punto de entrada público. Rutas muy sencillas basadas en ?action=

session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../app/controllers/AuthController.php';

$pdo = getPDO();
$auth = new AuthController($pdo);

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $auth->showLogin();
        break;
    case 'do_login':
        $auth->login();
        break;
    case 'register':
        $auth->showRegister();
        break;
    case 'do_register':
        $auth->register();
        break;
    case 'logout':
        $auth->logout();
        break;
    case 'dashboard':
        if (empty($_SESSION['user_id'])) {
            header('Location: ?action=login');
            exit;
        }
        // mostrar dashboard simple
        $stmt = $pdo->prepare('SELECT id, email, nombre, rol FROM users WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['user_id']]);
        $user = $stmt->fetch();
        require __DIR__ . '/../app/views/dashboard.php';
        break;
    default:
        header('HTTP/1.1 404 Not Found');
        echo 'Página no encontrada';
}
