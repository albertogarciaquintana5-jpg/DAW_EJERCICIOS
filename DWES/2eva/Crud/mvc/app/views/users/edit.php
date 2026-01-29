<?php $view = __FILE__; ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <h2 class="mb-0">Editar Usuario</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?action=update">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($user['nombre']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($user['apellido']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($user['telefono']) ?>">
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($user['fecha']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña (dejar en blanco para mantener)</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña">
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-warning btn-lg">Actualizar usuario</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="index.php?action=index" class="btn btn-secondary w-100">Volver</a>
        </div>
    </div>
</div>