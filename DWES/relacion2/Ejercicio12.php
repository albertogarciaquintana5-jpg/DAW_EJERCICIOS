
<?php
// Procesamiento de calculadora -> adaptado para calcular calificación
error_reporting(E_ALL);
ini_set('display_errors', '1');

$errors = [];
$resultado = null;

// Leer datos (GET)
$nombre = trim((string) filter_input(INPUT_GET, 'nombre', FILTER_UNSAFE_RAW));
$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
$inicial = filter_input(INPUT_GET, 'inicial', FILTER_VALIDATE_FLOAT);
$primera = filter_input(INPUT_GET, 'primera', FILTER_VALIDATE_FLOAT);
$segunda = filter_input(INPUT_GET, 'segunda', FILTER_VALIDATE_FLOAT);
$tercera = filter_input(INPUT_GET, 'tercera', FILTER_VALIDATE_FLOAT);

$hasInput = ($_SERVER['REQUEST_METHOD'] === 'GET') && (
    $nombre !== '' || $email !== null || $inicial !== null || $primera !== null || $segunda !== null || $tercera !== null
);

if ($hasInput) {
    // Validaciones servidor
    if ($nombre === '') {
        $errors[] = 'El nombre es obligatorio.';
    }
    if ($email === false || $email === null) {
        $errors[] = 'Correo electrónico inválido o vacío.';
    }

    $notes = ['inicial' => $inicial, 'primera' => $primera, 'segunda' => $segunda, 'tercera' => $tercera];
    foreach ($notes as $k => $v) {
        if ($v === false || $v === null) {
            $errors[] = "La nota '{$k}' es inválida o está vacía. Debe ser un número.";
        } else {
            // Comprobar rango 0..10
            if ($v < 0 || $v > 10) $errors[] = "La nota '{$k}' debe estar entre 0 y 10.";
        }
    }

    // Si todo OK, calcular promedio simple
    if (empty($errors)) {
        $suma = floatval($inicial) + floatval($primera) + floatval($segunda) + floatval($tercera);
        $resultado = $suma / 4.0; // Averaging equal weight
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 8 - Calculadora</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <style>
        body { background-color: #f8f9fa; }
        .card-calculator { max-width: 640px; margin: 40px auto; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Calculadora PHP</a>
        </div>
    </nav>

    <main class="container">
        <div class="card card-calculator shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Calculadora básica</h5>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                        <?php foreach ($errors as $e): ?>
                            <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif ($resultado !== null): ?>
                    <div class="alert alert-success" role="alert">
                        <p class="mb-1">Calificación para <strong><?= htmlspecialchars($nombre) ?></strong> (<?= htmlspecialchars($email) ?>):</p>
                        <p class="mb-0">Notas: inicial=<?= htmlspecialchars((string)$inicial) ?>, primera=<?= htmlspecialchars((string)$primera) ?>, segunda=<?= htmlspecialchars((string)$segunda) ?>, tercera=<?= htmlspecialchars((string)$tercera) ?>.</p>
                        <hr>
                        <p class="mb-0">Calificación final (media simple): <strong><?= htmlspecialchars(number_format($resultado,2)) ?></strong></p>
                    </div>
                <?php endif; ?>

                            

                <form method="get" class="row g-3 needs-validation" novalidate>
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required minlength="2" value="<?= htmlspecialchars($nombre ?? '') ?>">
                        <div class="invalid-feedback">Introduce el nombre.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars(isset($email) && $email !== false ? $email : '') ?>">
                        <div class="invalid-feedback">Introduce un correo válido.</div>
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="inicial" class="form-label">Nota inicial</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="inicial" name="inicial" required value="<?= isset($inicial) ? htmlspecialchars((string)$inicial) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="primera" class="form-label">Primera</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="primera" name="primera" required value="<?= isset($primera) ? htmlspecialchars((string)$primera) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="segunda" class="form-label">Segunda</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="segunda" name="segunda" required value="<?= isset($segunda) ? htmlspecialchars((string)$segunda) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="tercera" class="form-label">Tercera</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="tercera" name="tercera" required value="<?= isset($tercera) ? htmlspecialchars((string)$tercera) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Calcular calificación</button>
                        <a href="./Ejercicio8.php" class="btn btn-outline-secondary ms-2">Limpiar</a>
                    </div>
                </form>
            </div>
                        <div class="card-footer text-muted text-center small">
                                Notas entre 0 y 10. Todas las notas tienen el mismo peso (media simple).
                        </div>
        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
        <script>
            // Bootstrap-style client validation: prevent submit if invalid
            (function(){
                var forms = document.querySelectorAll('.needs-validation');
                Array.prototype.forEach.call(forms, function(form){
                    form.addEventListener('submit', function(event){
                        if (!form.checkValidity()){
                            event.preventDefault();
                            event.stopPropagation();
                            form.classList.add('was-validated');
                            return false;
                        }
                        // allow submit (server will also validate)
                    }, false);
                });
            })();
        </script>
</body>
</html>