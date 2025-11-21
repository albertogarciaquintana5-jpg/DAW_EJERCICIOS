<?php
/*
  ejercicio15.php
  Archivo que recopila notas sobre tipado: aquí mostramos que las clases
  anteriores ya usan tipado en parámetros y retornos. También se incluye
  un ejemplo adicional donde se acepta nullable.
*/

// Ejemplo de función con tipado y retorno nullable
function buscarRestaurante(?string $nombre): ?array {
    // Simulamos búsqueda: si nombre es null devolvemos null
    if (is_null($nombre)) return null;
    // Simulamos resultado
    return ['nombre' => $nombre, 'tipo' => 'Demo'];
}

$res = buscarRestaurante(null);
echo '<h2>Resultado búsqueda (nullable)</h2>';
echo '<pre>' . htmlspecialchars(var_export($res, true), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</pre>';

echo '<p>Nota: Las clases de los ejercicios 5-10 usan tipado en parámetros y retornos donde aplica.</p>';

?>
