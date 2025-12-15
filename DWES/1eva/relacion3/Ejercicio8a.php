<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Conversor de texto</title>
</head>
<body>

<h2>Convertir texto</h2>

<form method="post">
    Texto: <input type="text" name="texto" required><br><br>

    <label><input type="checkbox" name="may"> Mayúsculas</label><br>
    <label><input type="checkbox" name="min"> Minúsculas</label><br><br>

    <button type="submit">Enviar</button>
</form>

<?php
if ($_POST) {

    $texto = $_POST["texto"];

    if (isset($_POST["may"])) echo "<p><strong>" . strtoupper($texto) . "</strong></p>";
    if (isset($_POST["min"])) echo "<p><strong>" . strtolower($texto) . "</strong></p>";
}
?>

</body>
</html>
