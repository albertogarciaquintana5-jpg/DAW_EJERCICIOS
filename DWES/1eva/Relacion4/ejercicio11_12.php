<?php
/*
  ejercicio11_12.php
  Uso de stdClass para crear un objeto dinámico 'moduloDWES' y conversión
  entre objeto y array. Además demostramos serialize/unserialize para ambos.
*/

// Creamos un stdClass dinámico
$modulo = new stdClass();
$modulo->modulo = 'Desarrollo Web en Entorno Servidor';
$modulo->acronimo = 'DWES';
$modulo->curso = 2;
$modulo->descripcion = 'Servidor, sesiones, cookies, clases y objetos';
$modulo->teacher = 'Pilar González Augusto';

echo '<h2>Objeto stdClass</h2>';
echo '<pre>' . htmlspecialchars(print_r($modulo, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

// Convertir a array
$arrayModulo = (array)$modulo;
echo '<h2>Convertido a array (cast)</h2>';
echo '<pre>' . htmlspecialchars(print_r($arrayModulo, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

// Volver a objeto
$objAgain = (object)$arrayModulo;
echo '<h2>Array convertido de nuevo a objeto</h2>';
echo '<pre>' . htmlspecialchars(print_r($objAgain, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

// Serialize / Unserialize para el array
$serializedArray = serialize($arrayModulo);
echo '<h2>serialize(array)</h2>';
echo '<pre>' . htmlspecialchars($serializedArray, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';
$unserArr = unserialize($serializedArray);
echo '<h2>unserialize(array)</h2>';
echo '<pre>' . htmlspecialchars(print_r($unserArr, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

// Serialize / Unserialize para el objeto
$serializedObj = serialize($modulo);
echo '<h2>serialize(obj)</h2>';
echo '<pre>' . htmlspecialchars($serializedObj, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';
$unserObj = unserialize($serializedObj);
echo '<h2>unserialize(obj)</h2>';
echo '<pre>' . htmlspecialchars(print_r($unserObj, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

?>
