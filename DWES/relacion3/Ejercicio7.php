<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Fecha y hora</title>
</head>
<body>

<h2>Funciones de Fecha y Hora</h2>

<?php
function nombreDia($fecha) {
    $dias = ["domingo","lunes","martes","miércoles","jueves","viernes","sábado"];
    return $dias[ date("w", strtotime($fecha)) ];
}

function nombreMes($fecha) {
    $meses = ["enero","febrero","marzo","abril","mayo","junio","julio",
              "agosto","septiembre","octubre","noviembre","diciembre"];
    return $meses[ date("n", strtotime($fecha)) - 1 ];
}

$hoy = date("Y-m-d H:i:s");
?>

<p>Fecha actual: <strong><?= $hoy ?></strong></p>
<p>Ayer: <?= date("Y-m-d", strtotime("-1 day")) ?></p>
<p>Dentro de 10 días: <?= date("Y-m-d", strtotime("+10 days")) ?></p>

<p>Día en español: <?= nombreDia($hoy) ?></p>
<p>Mes en español: <?= nombreMes($hoy) ?></p>

</body>
</html>
