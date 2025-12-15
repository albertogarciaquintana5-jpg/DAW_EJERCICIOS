<?php
$menu = [
    'entrante' => ['Ensalada César', 'Hummus', 'Boquerones al natural'],
    'primero' => ['Gazpachuelo', 'Salmorejo', 'Ajo Blanco'],
    'segundo' => ['Fritura Malagueña', 'Conejo al ajillo', 'Pisto con huevo'],
    'postre' => ['Helado 3 sabores', 'Flan', 'Tarta de Queso']
];

$imagenes = [
    'Gazpachuelo' => 'img/gazpachuelo.jpg',
    'Salmorejo' => 'img/salmorejo.jpg',
    'Ajo Blanco' => 'img/ajo-blanco.jpg'
];

// Función con probabilidad aumentada para tercera opción
function elegirConProbabilidad($platos) {
    $opciones = [];
    foreach ($platos as $indice => $plato) {
        $peso = ($indice == 2) ? 2 : 1;
        for ($i = 0; $i < $peso; $i++) {
            $opciones[] = $plato;
        }
    }
    return $opciones[array_rand($opciones)];
}

$menusGenerados = [];
$primerPlatoImagen = null;

if ($_GET['cantidad'] ?? false) {
    $cantidad = min(intval($_GET['cantidad']), 10);
    
    for ($i = 0; $i < $cantidad; $i++) {
        $menuAleatorio = [];
        foreach ($menu as $tipo => $platos) {
            $menuAleatorio[$tipo] = elegirConProbabilidad($platos);
        }
        
        if ($i === 0) {
            $primerPlatoImagen = $menuAleatorio['primero'];
        }
        
        $menusGenerados[] = $menuAleatorio;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 19 - Menús con Probabilidad</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Generador de Menús con Probabilidad Aumentada</h1>
        
        <form method="GET" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Número de menús (1-10):</label>
                <input type="number" name="cantidad" min="1" max="10" class="form-control" value="<?= $_GET['cantidad'] ?? 1 ?>">
            </div>
            <button type="submit" class="btn btn-primary">Generar</button>
        </form>

        <?php if (!empty($menusGenerados)): ?>
            <div class="row">
                <?php foreach ($menusGenerados as $index => $menuGen): ?>
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-header bg-warning">
                                Menú <?= $index + 1 ?>
                                <?php if ($index === 0): ?>
                                    <span class="badge bg-success">Con imagen</span>
                                <?php endif; ?>
                            </div>
                            
                            <?php if ($index === 0 && isset($imagenes[$primerPlatoImagen])): ?>
                                <img src="<?= $imagenes[$primerPlatoImagen] ?>" class="card-img-top" alt="<?= $primerPlatoImagen ?>" style="height: 150px; object-fit: cover;">
                            <?php endif; ?>
                            
                            <div class="card-body">
                                <?php foreach ($menuGen as $tipo => $plato): ?>
                                    <p><strong><?= ucfirst($tipo) ?>:</strong> 
                                        <?= $plato ?>
                                        <?= array_search($plato, $menu[$tipo]) === 2 ? ' 🎯' : '' ?>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>