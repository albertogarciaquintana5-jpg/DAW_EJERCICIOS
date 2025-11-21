<?php
/*
  ejercicio14.php
  Simula guardar un carrito (array asociativo) en cookie codificado en JSON
  Muestra botón que enlaza a ver_carrito.php que recupera y muestra cookie
*/

$carrito = [
    ['codigo' => 'P001', 'nombre' => 'Camiseta', 'unidades' => 2],
    ['codigo' => 'P002', 'nombre' => 'Taza', 'unidades' => 1],
    ['codigo' => 'P003', 'nombre' => 'Libro', 'unidades' => 3]
];

$json = json_encode($carrito, JSON_UNESCAPED_UNICODE);
// Guardamos la cookie sin tiempo de expiración explícito (sesión del navegador)
setcookie('carrito', $json, 0, '/');

echo '<h2>Carrito guardado en cookie (JSON)</h2>';
echo '<pre>' . htmlspecialchars($json, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

echo '<p><a href="ver_carrito.php">Ver carrito (leer cookie)</a></p>';

?>
