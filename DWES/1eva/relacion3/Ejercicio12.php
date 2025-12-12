<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Bubble Sort PHP</title>
</head>
<body>

<h2>Ordenación por burbuja</h2>

<?php
function bubbleSort(&$arr) {
    $n = count($arr);
    for ($i = 0; $i < $n - 1; $i++) {
        for ($j = 0; $j < $n - $i - 1; $j++) {
            if ($arr[$j] > $arr[$j + 1]) {
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j + 1];
                $arr[$j + 1] = $tmp;
            }
        }
    }
}

$datos = ['Pérez','García','López','Márquez','Álvarez','Domínguez','Ruíz','Díaz'];

bubbleSort($datos);

echo "<p><strong>" . implode(", ", $datos) . "</strong></p>";
?>

</body>
</html>
