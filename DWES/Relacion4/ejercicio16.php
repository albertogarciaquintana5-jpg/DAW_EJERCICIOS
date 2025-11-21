<?php
/*
  ejercicio16.php
  Ejemplo sencillo de namespaces y uso de require/require_once para incluir archivos.
  Creamos dos pequeños ficheros de demostración dentro de un namespace.
*/

// Para simplificar el ejemplo creamos dos archivos de librería que se incluirán.
// En un proyecto real estos serían ficheros separados; aquí se generarán dinámicamente
// si no existen.

$base = __DIR__ . DIRECTORY_SEPARATOR;
if (!file_exists($base . 'LibA.php')) {
    file_put_contents($base . 'LibA.php', "<?php\nnamespace MiLibreria;\nfunction saludaA() { return 'Hola desde LibA'; }\n");
}
if (!file_exists($base . 'LibB.php')) {
    file_put_contents($base . 'LibB.php', "<?php\nnamespace MiLibreria;\nfunction saludaB() { return 'Hola desde LibB'; }\n");
}

// Incluimos las librerías
require_once $base . 'LibA.php';
require_once $base . 'LibB.php';

// Usamos funciones del namespace
echo '<p>' . 
    \MiLibreria\saludaA() . ' - ' . 
    \MiLibreria\saludaB() .
    '</p>';

echo '<p>Nota: use include/require y sus variantes según la necesidad: require detiene ejecución si falta el archivo.</p>';

?>
