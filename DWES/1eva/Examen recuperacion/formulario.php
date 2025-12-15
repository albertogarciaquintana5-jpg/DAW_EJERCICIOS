<?php
declare(strict_types=1);
session_start();

if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(16));
}
$token = $_SESSION['csrf_token'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Formulario - Números amigos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="bg-light">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm">
          <div class="card-body">
            <h1 class="h5 mb-3">Introduce dos números enteros y te digo si son amigos</h1>

            <form action="proceso.php" method="post" novalidate>
              <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($token, ENT_QUOTES); ?>">

              <div class="mb-3">
                <label for="num1" class="form-label">Número 1</label>
                <input type="number" class="form-control" id="num1" name="num1" required min="1" step="1">
                <div class="form-text">Introduce un número entero positivo (>=1).</div>
              </div>

              <div class="mb-3">
                <label for="num2" class="form-label">Número 2</label>
                <input type="number" class="form-control" id="num2" name="num2" required min="1" step="1">
              </div>

              <div class="d-flex justify-content-between align-items-center">
                <a href="./index.php" class="btn btn-link">Volver</a>
                <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>