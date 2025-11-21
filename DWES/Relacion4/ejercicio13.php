<?php
/*
  ejercicio13.php
  Array asociativo de socios -> json_encode -> json_decode a array asociativo y stdClass
*/

$socios = [
    ['nombre' => 'Ana', 'apellidos' => 'García Pérez', 'edad' => 30],
    ['nombre' => 'Luis', 'apellidos' => 'Martín López', 'edad' => 45],
    ['nombre' => 'Marta', 'apellidos' => 'Sánchez Ruiz', 'edad' => 22]
];

echo '<h2>Array original</h2>';
echo '<pre>' . htmlspecialchars(print_r($socios, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

$json = json_encode($socios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo '<h2>JSON (json_encode)</h2>';
echo '<pre>' . htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

// Decodificamos a array asociativo
$decodedArray = json_decode($json, true);
echo '<h2>JSON -> array asociativo (json_decode(..., true))</h2>';
echo '<pre>' . htmlspecialchars(print_r($decodedArray, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

// Decodificamos a stdClass
$decodedObj = json_decode($json, false);
echo '<h2>JSON -> stdClass (json_decode(..., false))</h2>';
echo '<pre>' . htmlspecialchars(print_r($decodedObj, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

?>
