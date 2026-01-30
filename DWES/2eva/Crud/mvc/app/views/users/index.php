<?php $view = __FILE__; // placeholder to include within layout ?>
<div class="row">
    <div class="col-md-10 offset-md-1">
        <h2 class="mb-4 text-primary">Listado de Usuarios</h2>
        <a href="index.php?action=create" class="btn btn-success mb-3">Crear nuevo usuario</a>
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $u): ?>
                    <tr>
                        <td><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['nombre']) ?></td>
                        <td><?= htmlspecialchars($u['apellido']) ?></td>
                        <td><?= htmlspecialchars($u['fecha']) ?></td>
                        <td><?= htmlspecialchars($u['telefono']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td>
                            <a href="index.php?action=edit&id=<?= (int)$u['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?action=delete&id=<?= (int)$u['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Eliminar usuario?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="index.php?action=index" class="btn btn-secondary">Volver</a>
    </div>
</div>