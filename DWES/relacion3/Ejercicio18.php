<?php
$menu = [
    'entrante' => ['Ensalada César', 'Hummus', 'Boquerones al natural'],
    'primero' => ['Gazpachuelo', 'Salmorejo', 'Ajo Blanco'],
    'segundo' => ['Fritura Malagueña', 'Conejo al ajillo', 'Pisto con huevo'],
    'postre' => ['Helado 3 sabores', 'Flan', 'Tarta de Queso']
];

$menusGenerados = [];
if ($_GET['cantidad'] ?? false) {
    $cantidad = min(intval($_GET['cantidad']), 10);
    
    for ($i = 0; $i < $cantidad; $i++) {
        $menuAleatorio = [];
        foreach ($menu as $tipo => $platos) {
            $menuAleatorio[$tipo] = $platos[array_rand($platos)];
        }
        $menusGenerados[] = $menuAleatorio;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ejercicio 18 - Generador Menús</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Generador de Menús Aleatorios</h1>
        
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
                            <div class="card-header bg-success text-white">
                                Menú <?= $index + 1 ?>
                            </div>
                            <div class="card-body">
                                <p><strong>Entrante:</strong> <?= $menuGen['entrante'] ?></p>
                                <p><strong>Primero:</strong> <?= $menuGen['primero'] ?></p>
                                <p><strong>Segundo:</strong> <?= $menuGen['segundo'] ?></p>
                                <p><strong>Postre:</strong> <?= $menuGen['postre'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>