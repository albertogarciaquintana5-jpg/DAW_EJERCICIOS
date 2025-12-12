<?php
require_once 'functions.php';
secure_session_start();

if (is_session_expired()) {
    secure_logout();
    die('Sesión expirada. Por favor inicia sesión de nuevo.');
}

if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

maybe_regenerate_session_id(15*60);
update_session_activity();

echo "Bienvenido, " . htmlspecialchars($_SESSION['username']);
?>
<form method="post" action="sensitive_action.php">
  <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">
  <button>Acción peligrosa</button>
</form>
