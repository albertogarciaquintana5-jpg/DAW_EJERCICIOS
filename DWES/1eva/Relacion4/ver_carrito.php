<?php
/*
  ver_carrito.php
  Lee la cookie 'carrito' (JSON) y la muestra como array asociativo y como stdClass
*/

echo '<h1>Ver carrito desde cookie</h1>';

if (!isset($_COOKIE['carrito'])) {
    echo '<p>No hay cookie de carrito. Ejecuta <a href="ejercicio14.php">ejercicio14.php</a> primero.</p>';
    exit();
}

$json = $_COOKIE['carrito'];
echo '<h2>Contenido JSON (raw)</h2>';
echo '<pre>' . htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

$array = json_decode($json, true);
echo '<h2>Convertido a array asociativo</h2>';
echo '<pre>' . htmlspecialchars(print_r($array, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

$obj = json_decode($json, false);
echo '<h2>Convertido a stdClass</h2>';
echo '<pre>' . htmlspecialchars(print_r($obj, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

?>
