<?php
$hoy = date('l jS \of F Y h:i:s A');
$jsonCadena = '{
"Nombre":"ALberto",
"Apellido":"Garcia Quintana",
"Cargo":"IT Developer",
"Fecha":"' . $hoy . '"
}';
echo($jsonCadena);
?>
