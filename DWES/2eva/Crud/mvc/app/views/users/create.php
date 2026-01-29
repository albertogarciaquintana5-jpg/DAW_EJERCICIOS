<?php $view = __FILE__; ?>
<div class="row">
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">Crear nuevo usuario</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="index.php?action=store">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="apellido" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($_POST['fecha'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">Guardar usuario</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="mt-3">
            <a href="index.php?action=index" class="btn btn-secondary w-100">Volver</a>
        </div>
    </div>
</div>