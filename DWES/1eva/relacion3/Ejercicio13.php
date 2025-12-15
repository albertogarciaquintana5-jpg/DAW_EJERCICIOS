<?php
// Procesar formulario
if ($_POST['texto'] ?? false) {
    $texto = $_POST['texto'];
    
    // Cadena del revés y palíndroma
    $reves = strrev($texto);
    $esPalindroma = strtolower(str_replace(' ', '', $texto)) === strtolower(str_replace(' ', '', $reves));
    
    // Palabras del revés
    $palabras = explode(' ', $texto);
    $palabrasReves = array_reverse($palabras);
    $textoPalabrasReves = implode(' ', $palabrasReves);
    
    // Mayúsculas y minúsculas
    $mayusculas = strtoupper($texto);
    $minusculas = strtolower($texto);
    
    // Recuentos
    $numCaracteres = strlen($texto);
    $numPalabras = str_word_count($texto);
    
    // Encriptaciones
    $crypt = crypt($texto, 'salt');
    $md5 = md5($texto);
    $sha1 = sha1($texto);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 13 - Funciones String</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Funciones de String en PHP</h1>
        
        <form method="POST" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Introduce un texto:</label>
                <input type="text" name="texto" class="form-control" value="<?= $_POST['texto'] ?? '' ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Procesar</button>
        </form>

        <?php if (isset($texto)): ?>
            <!-- Cadena del revés -->
            <div class="alert alert-primary">
                <h4>Cadena del revés:</h4>
                <p><?= htmlspecialchars($reves) ?></p>
                <p><strong>¿Es palíndroma?</strong> <?= $esPalindroma ? 'Sí' : 'No' ?></p>
            </div>

            <!-- Palabras del revés -->
            <div class="alert alert-success">
                <h4>Palabras del revés:</h4>
                <p><?= htmlspecialchars($textoPalabrasReves) ?></p>
            </div>

            <!-- Mayúsculas y minúsculas -->
            <div class="alert alert-warning">
                <h4>Mayúsculas y minúsculas:</h4>
                <p><strong>Mayúsculas:</strong> <?= htmlspecialchars($mayusculas) ?></p>
                <p><strong>Minúsculas:</strong> <?= htmlspecialchars($minusculas) ?></p>
            </div>

            <!-- Recuentos -->
            <div class="alert alert-info">
                <h4>Recuentos:</h4>
                <p><strong>Caracteres (con espacios):</strong> <?= $numCaracteres ?></p>
                <p><strong>Palabras:</strong> <?= $numPalabras ?></p>
            </div>

            <!-- Encriptaciones -->
            <div class="alert alert-dark">
                <h4>Encriptaciones:</h4>
                <p><strong>crypt:</strong> <?= $crypt ?></p>
                <p><strong>md5:</strong> <?= $md5 ?></p>
                <p><strong>sha1:</strong> <?= $sha1 ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>