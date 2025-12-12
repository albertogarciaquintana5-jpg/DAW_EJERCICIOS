<?php
require_once __DIR__ . '/cola.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Prueba de Cola</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body class="bg-light">
	<div class="container py-5">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card shadow-sm">
					<div class="card-body">
						<h1 class="h5">Prueba de la clase Cola</h1>
						<?php
							$cola = new Cola(10);
							echo "<div class=mb-2>1) Cola creada (longitud máxima 10): <strong>" . htmlspecialchars((string)$cola) . "</strong></div>";

							$antes = $cola->getElementos();
							$cola->ponerEnCola(5);
							$despues = $cola->getElementos();
							echo "<div class=mb-2>2) Insertar 5 → ";
							if ($despues === $antes) {
								echo "<span class=text-danger>No se pudo insertar: cola llena</span></div>";
							} else {
								echo "<span class=text-success>Insertado correctamente</span></div>";
							} 

							echo "<div class=mb-2>3) Cola actual: " . htmlspecialchars((string)$cola) . "</div>";

							$antes = $cola->getElementos();
							$cola->ponerEnCola(3);
							$despues = $cola->getElementos();
							echo "<div class=mb-2>4) Insertar 3 → ";
							if ($despues === $antes) {
								echo "<span class=text-danger>No se pudo insertar: cola llena</span></div>";
							} else {
								echo "<span class=text-success>Insertado correctamente</span></div>";

							} 
							echo "<div class=mb-2>5) Cola actual: " . htmlspecialchars((string)$cola) . "</div>";

							$elem = $cola->extraerDeCola();
							echo "<div class=mb-2>6) Extraer elemento → ";
							if ($elem === null) {
								echo "<span class=text-danger>No se pudo extraer: cola vacía</span></div>";
							} else {
								echo "<span class=text-success>Extraído: " . htmlspecialchars(var_export($elem, true)) . "</span></div>";
							}

							echo "<div class=mb-2>7) Número de elementos: " . $cola->getElementos() . "</div>";

							echo "<div class=mb-2>8) Cola completa (toString): " . htmlspecialchars((string)$cola) . "</div>";

							for ($i=0;$i<9;$i++){
								$cola->ponerEnCola($i);
							} 

							$antes = $cola->getElementos();
							$cola->ponerEnCola('X');
							$despues = $cola->getElementos();
							if ($despues === $antes) {
								echo "<div class=mt-2 text-success>No se pudo insertar 'X' — cola llena (correcto).</div>";
							} else {
								echo "<div class=mt-2 text-danger>Insertado 'X' (unexpected).</div>";
							}

							echo "<div class=mt-3>Estado final de la cola: " . htmlspecialchars((string)$cola) . "</div> <br>";

						?>
						<a href="./index.php" class="btn btn-success">Volver</a>
					</div>
