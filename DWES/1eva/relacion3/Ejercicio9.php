<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Palabra más larga</title>
</head>
<body>

<h2>Palabra más larga</h2>

<form method="post">
    Texto: <input type="text" name="texto" required>
    <button type="submit">Enviar</button>
</form>

<?php
if ($_POST) {
    $palabras = preg_split('/\s+/', trim($_POST["texto"]));
    $max = "";

    foreach ($palabras as $p) {
        if (strlen($p) > strlen($max)) $max = $p;
    }

    echo "<p>La palabra más larga es: <strong>$max</strong></p>";
}
?>

</body>
</html>
