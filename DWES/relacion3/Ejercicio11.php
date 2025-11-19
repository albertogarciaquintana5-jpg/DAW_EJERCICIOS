<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Invertir Array</title>
</head>
<body>

<h2>Invertir Array</h2>

<?php
require "functionsRel3.php";

$arr = [1, 2, 3, 4, 5];
invertirArray($arr);

echo "Resultado: " . implode(", ", $arr);
?>

</body>
</html>
