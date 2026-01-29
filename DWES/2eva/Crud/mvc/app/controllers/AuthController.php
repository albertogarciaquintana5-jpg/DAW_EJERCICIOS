<?php
// app/controllers/AuthController.php
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../models/User.php";

class AuthController {
    private $userModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $pdo = getPDO();
        $this->userModel = new User($pdo);
    }

    public function login() {
        // mostrar formulario de login
        $allowRegistration = (count($this->userModel->all()) === 0);
        include __DIR__ . "/../views/auth/login.php";
    }

    public function login_post() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['contraseña'] ?? '';
        $errors = [];

        if (empty($email) || empty($password)) {
            $errors[] = 'Email y contraseña son obligatorios';
            include __DIR__ . "/../views/auth/login.php";
            return;
        }

        $user = $this->userModel->findByEmail($email);
        if (!$user || !password_verify($password, $user['contraseña'])) {
            $errors[] = 'Credenciales incorrectas';
            include __DIR__ . "/../views/auth/login.php";
            return;
        }

        // Login OK
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['usuario_nombre'] = $user['nombre'];
        header('Location: index.php?action=index');
        exit;
    }

    public function logout() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        session_unset();
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }

    public function register() {
        $allowRegistration = (count($this->userModel->all()) === 0);
        include __DIR__ . "/../views/auth/register.php";
    }

    public function register_post() {
        $data = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellido' => $_POST['apellido'] ?? '',
            'email' => $_POST['email'] ?? '',
            'telefono' => $_POST['telefono'] ?? '',
            'fecha' => $_POST['fecha'] ?? '',
            'contraseña' => $_POST['contraseña'] ?? ''
        ];

        $errors = [];
        if (empty($data['nombre'])) $errors[] = 'El nombre es obligatorio';
        if (empty($data['email'])) $errors[] = 'El email es obligatorio';
        if (empty($data['contraseña'])) $errors[] = 'La contraseña es obligatoria';
        if ($this->userModel->existsEmail($data['email'])) $errors[] = 'El email ya está registrado';

        if (count($errors) > 0) {
            include __DIR__ . "/../views/auth/register.php";
            return;
        }

        $this->userModel->create($data);
        header('Location: index.php?action=login&registered=1&nombre=' . urlencode($data['nombre']));
        exit;
    }
}
