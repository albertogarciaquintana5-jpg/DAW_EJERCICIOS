<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="index.php?action=index">CRUD MVC</a>
    </div>
</nav>

<div class="container">
    <?php if (isset(
        $errors) && count($errors) > 0): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php foreach ($errors as $err) echo "<li>".htmlspecialchars($err)."</li>"; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <?php if ($_GET['msg'] === 'created') echo 'Usuario creado correctamente.';
            if ($_GET['msg'] === 'updated') echo 'Usuario actualizado correctamente.';
            if ($_GET['msg'] === 'deleted') echo 'Usuario eliminado correctamente.';
            ?>
        </div>
    <?php endif; ?>

    <?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>
    <div class="mb-3 text-end">
        <?php if (!empty(
            $_SESSION['usuario_nombre'])): ?>
            <span class="me-2">Hola, <?= htmlspecialchars($_SESSION['usuario_nombre']) ?></span>
            <a href="index.php?action=logout" class="btn btn-outline-secondary btn-sm">Cerrar sesión</a>
        <?php else: ?>
            <a href="index.php?action=login" class="btn btn-outline-primary btn-sm">Login</a>
        <?php endif; ?>
    </div>

    <?php
    // Insert view content: usamos el contenido buffered desde el front controller
    echo $content;
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>