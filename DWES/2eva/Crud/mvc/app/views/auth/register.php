<?php $view = __FILE__; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <h2 class="text-center mb-4 fw-bold">Registro de Usuario</h2>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?action=register_post">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($_POST['nombre'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?= htmlspecialchars($_POST['apellido'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($_POST['telefono'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha</label>
                        <input type="date" name="fecha" class="form-control" value="<?= htmlspecialchars($_POST['fecha'] ?? '') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="contraseña" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button class="btn btn-success" type="submit">Registrarse</button>
                    </div>
                </form>

                <div class="mt-3 text-center">
                    <a href="index.php?action=login">Volver al login</a>
                </div>
            </div>
        </div>
    </div>
</div>