<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Registro</title>
</head>
<body>
  <h1>Registro de usuario</h1>

  <?php if (!empty($errors) && is_array($errors)): ?>
    <?php foreach ($errors as $e): ?>
      <p style="color:red"><?php echo htmlspecialchars($e) ?></p>
    <?php endforeach; ?>
  <?php endif; ?>

  <form method="post" action="?action=do_register">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Contraseña: <input type="password" name="password" required></label><br>
    <button type="submit">Registrar</button>
  </form>

  <p>¿Ya tienes cuenta? <a href="?action=login">Entrar</a></p>
</body>
</html>
