<?php
require_once 'functions.php';
secure_session_start();
generate_csrf_token();
update_session_activity();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) die('CSRF inválido');

    $username = sanitize_username($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);

    if (empty($username) || empty($password)) {
        die('Datos faltan.');
    }
    if (!validate_password_policy($password)) {
        die('Contraseña no cumple la política.');
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, email, is_approved) VALUES (?, ?, ?, ?)");
    try {
        $stmt->execute([$username, $password_hash, $email, 0]);
        echo "Registro realizado. Espera aprobación de administrador.";
    } catch (PDOException $e) {
        echo "Error al registrar: " . htmlentities($e->getMessage());
    }
}
?>

<form method="post" action="register.php">
  <input name="username" required>
  <input type="email" name="email">
  <input type="password" name="password" required>
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
  <button>Registrarse</button>
</form>
