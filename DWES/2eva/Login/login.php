<?php
require_once 'functions.php';
secure_session_start();
generate_csrf_token();
update_session_activity();
maybe_regenerate_session_id();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        http_response_code(400);
        die('Token CSRF inválido.');
    }

    $username = sanitize_username($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $ip = $_SERVER['REMOTE_ADDR'];

    $info = get_failed_attempts_info($pdo, $username);
    $max_attempts = 5;
    $lockout_seconds = 15 * 60;

    if ($info) {
        if ($info['failed_attempts'] >= $max_attempts) {
            $last = strtotime($info['last_failed_at']);
            if (time() - $last < $lockout_seconds) {
                die('Cuenta temporalmente bloqueada por intentos fallidos. Intenta más tarde.');
            } else {
                $stmt = $pdo->prepare("UPDATE users SET failed_attempts = 0 WHERE username = ?");
                $stmt->execute([$username]);
            }
        }
    }

    $stmt = $pdo->prepare("SELECT id, password_hash, is_approved FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    $success = false;
    if ($user && password_verify($password, $user['password_hash'])) {
        if (!$user['is_approved']) {
            die('Tu registro está pendiente de aprobación por un administrador.');
        }
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $username;
        update_session_activity();
        $_SESSION['created'] = time();

        $success = true;
    }

    record_login_attempt($pdo, $username, $ip, $success);
    if ($success) {
        header('Location: protected.php');
        exit;
    } else {
        echo "Usuario/contraseña incorrectos.";
    }
}
?>

<!-- Formulario HTML (frontend JS validación abajo) -->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
</head>
<body>
<form id="loginForm" method="post" action="login.php" novalidate>
  <label>Usuario: <input type="text" name="username" id="username" required></label><br>
  <label>Contraseña: <input type="password" name="password" id="password" required></label><br>
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
  <button type="submit">Entrar</button>
</form>

<script src="validation.js"></script>
</body>
</html>
