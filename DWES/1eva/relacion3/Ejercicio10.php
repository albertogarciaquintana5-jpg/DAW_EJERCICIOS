<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Invertir palabras</title>
</head>
<body>

<h2>Invertir las palabras de un texto</h2>

<form method="post">
    Texto: <input type="text" name="texto" required>
    <button type="submit">Invertir</button>
</form>

<?php
if ($_POST) {
    $palabras = preg_split('/\s+/', trim($_POST["texto"]));
    $invertido = array_reverse($palabras);
    echo "<p><strong>" . implode(" ", $invertido) . "</strong></p>";
}
?>

</body>
</html>
