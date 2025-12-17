<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>
</head>
<body>
  <h1>Iniciar sesión</h1>

  <?php if (!empty($_GET['registered'])): ?>
    <p style="color:green">Registro correcto. Ahora puedes iniciar sesión.</p>
  <?php endif; ?>

  <?php if (!empty($errors) && is_array($errors)): ?>
    <?php foreach ($errors as $e): ?>
      <p style="color:red"><?php echo htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
  <?php endif; ?>

  <form method="post" action="?action=do_login">
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Contraseña: <input type="password" name="password" required></label><br>
    <button type="submit">Entrar</button>
  </form>

  <p>¿No tienes cuenta? <a href="?action=register">Regístrate</a></p>
</body>
</html>
