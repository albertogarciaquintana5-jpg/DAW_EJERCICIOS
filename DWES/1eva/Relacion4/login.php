<?php
/*
  login.php
  Formulario de acceso que valida los campos con JavaScript antes de enviar.
  Credenciales por defecto para el examen: usuario = "admin", contraseña = "1234".
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <title>Login - Relación 4</title>
  <!-- Comentario HTML invisible: formulario de acceso -->
  <script>
    // Valida los campos en el cliente antes de enviar
    function validarForm() {
      var user = document.getElementById('nombre_usuario').value.trim();
      var pass = document.getElementById('contrasena').value.trim();
      // Comentario JS: comprobamos que no estén vacíos
      if (user === '' || pass === '') {
        alert('Introduce usuario y contraseña.');
        return false;
      }
      // Comentario JS: validación contra las credenciales por defecto
      if (user !== 'admin' || pass !== '1234') {
        // Nota: la validación JS es solo para comodidad; el servidor vuelve a validar
        alert('Usuario o contraseña incorrectos (validación cliente).');
        return false;
      }
      return true;
    }
  </script>
</head>
<body>
  <!-- Formulario: envía a proceso.php mediante POST -->
  <h1>Acceso</h1>
  <form action="proceso.php" method="post" onsubmit="return validarForm();">
    <label for="nombre_usuario">Usuario:</label>
    <input type="text" id="nombre_usuario" name="nombre_usuario" />
    <br />
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" />
    <br />
    <button type="submit">Entrar</button>
  </form>
  <!-- Comentario HTML: Credenciales para examen -> admin / 1234 -->
</body>
</html>
