<?php $view = __FILE__; ?>
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h2 class="text-center mb-4 fw-bold">Iniciar Sesión</h2>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $e) echo '<li>'.htmlspecialchars($e).'</li>'; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['registered'])): ?>
                    <div class="alert alert-success">Cuenta creada correctamente. Ya puedes iniciar sesión.</div>
                <?php endif; ?>

                <form method="POST" action="index.php?action=login_post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contraseña" class="form-label">Contraseña</label>
                        <input type="password" id="contraseña" name="contraseña" class="form-control" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Entrar</button>
                </form>

                <hr>

                <?php if ($allowRegistration): ?>
                    <p class="text-center">No existen usuarios. <a href="index.php?action=register">Crea la primera cuenta</a></p>
                <?php else: ?>
                    <p class="text-center">¿No tienes cuenta? <a href="index.php?action=register">Regístrate</a></p>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>