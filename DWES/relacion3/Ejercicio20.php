<?php
$errores = [];
$datosSanitizados = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $edad = filter_input(INPUT_POST, 'edad', FILTER_SANITIZE_NUMBER_INT);
    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
    
    // Validación
    if (empty($nombre) || strlen($nombre) < 2) {
        $errores[] = "Nombre debe tener al menos 2 caracteres";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "Email no válido";
    }
    
    if (!filter_var($edad, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 120]])) {
        $errores[] = "Edad debe ser entre 1 y 120";
    }
    
    if (!empty($telefono) && !preg_match('/^[6-9][0-9]{8}$/', $telefono)) {
        $errores[] = "Teléfono debe tener 9 dígitos y empezar por 6-9";
    }
    
    // Si no hay errores, preparar datos sanitizados
    if (empty($errores)) {
        $datosSanitizados = [
            'nombre' => htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
            'edad' => htmlspecialchars($edad, ENT_QUOTES, 'UTF-8'),
            'telefono' => htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8')
        ];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 20 - Seguridad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Seguridad en Formularios PHP</h1>
        
        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <h4>Errores:</h4>
                <ul>
                    <?php foreach ($errores as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($datosSanitizados)): ?>
            <div class="alert alert-success">
                <h4>Datos validados:</h4>
                <pre><?php print_r($datosSanitizados); ?></pre>
            </div>
        <?php endif; ?>

        <!-- Uso de htmlspecialchars en action -->
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="mb-3">
                <label class="form-label">Nombre *</label>
                <input type="text" name="nombre" class="form-control" value="<?= $_POST['nombre'] ?? '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="<?= $_POST['email'] ?? '' ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Edad *</label>
                <input type="number" name="edad" class="form-control" value="<?= $_POST['edad'] ?? '' ?>" min="1" max="120" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="tel" name="telefono" class="form-control" value="<?= $_POST['telefono'] ?? '' ?>">
                <div class="form-text">9 dígitos, empezando por 6-9</div>
            </div>
            
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>
</html>