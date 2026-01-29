<?php
// Front controller simple: index.php?action=...
require_once __DIR__ . "/../app/controllers/UserController.php";
require_once __DIR__ . "/../app/controllers/AuthController.php";

$action = $_GET['action'] ?? 'index';

// Acciones de auth
$authActions = ['login','login_post','logout','register','register_post'];
$userActions = ['index','create','store','edit','update','delete'];

ob_start();
if (in_array($action, $authActions)) {
    $controller = new AuthController();
    $controller->$action();
} else {
    // fallback a controlador de usuarios
    $controller = new UserController();
    if (!in_array($action, $userActions)) $action = 'index';
    $controller->$action();
}
$content = ob_get_clean();

// Renderizar layout
include __DIR__ . "/../app/views/layout.php";
