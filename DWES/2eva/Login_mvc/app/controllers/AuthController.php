<?php
/**
 * Controlador de autenticación. Métodos:
 * - showLogin(), login()
 * - showRegister(), register()
 * - logout()
 * Todas las llamadas esperan que exista una instancia PDO disponible.
 */

require_once __DIR__ . '/../models/User.php';

class AuthController
{
    private PDO $pdo;
    private User $userModel;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->userModel = new User($pdo);
    }

    public function showLogin(array $errors = [])
    {
        require __DIR__ . '/../views/login.php';
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (!$email || !$password) {
            $this->showLogin(['Debe proporcionar email y contraseña']);
            return;
        }

        if ($this->userModel->verifyPassword($email, $password)) {
            $user = $this->userModel->findByEmail($email);
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            header('Location: ?action=dashboard');
            exit;
        }

        $this->showLogin(['Credenciales incorrectas']);
    }

    public function showRegister(array $errors = [])
    {
        require __DIR__ . '/../views/register.php';
    }

    public function register()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $nombre = $_POST['nombre'] ?? '';

        try {
            if ($this->userModel->findByEmail($email)) {
                $this->showRegister(['El email ya está en uso']);
                return;
            }

            $id = $this->userModel->create($email, $password, $nombre);
            header('Location: ?action=login&registered=1');
            exit;
        } catch (Exception $e) {
            $this->showRegister([$e->getMessage()]);
        }
    }

    public function logout()
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            setcookie(session_name(), '', time() - 42000);
        }
        session_destroy();
        header('Location: ?action=login');
        exit;
    }
}
