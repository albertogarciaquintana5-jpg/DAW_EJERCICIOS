<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Simulación de dados</title>
</head>
<body>

<h2>Simulación de dado normal y trucado</h2>

<form method="post">
    Nº de tiradas: <input type="number" name="tiradas" required>
    <button type="submit">Simular</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $n = intval($_POST["tiradas"]);
    echo "<h3>Realizando $n tiradas...</h3>";

    $normal = array_fill(1, 6, 0);
    $trucado = array_fill(1, 6, 0);

    for ($i = 0; $i < $n; $i++) {
        // Dado normal
        $normal[rand(1,6)]++;

        // Dado trucado (6 tres veces más probable)
        $r = rand(1, 8); 
        $cara = ($r <= 5) ? $r : 6;
        $trucado[$cara]++;
    }

    echo "<h3>Dado Normal</h3>";
    foreach ($normal as $cara => $freq) {
        echo "Cara $cara: $freq<br>";
    }

    echo "<h3>Dado Trucado</h3>";
    foreach ($trucado as $cara => $freq) {
        echo "Cara $cara: $freq<br>";
    }
}
?>

</body>
</html>
