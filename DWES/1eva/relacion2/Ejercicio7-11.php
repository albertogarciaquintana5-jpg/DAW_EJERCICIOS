
<!DOCTYPE html>
<html lang="es">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 7 (Relación) — Formulario con GET / POST</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>body{padding:16px}</style>
</head>
<body>
    <div class="container">
        <h1 class="mb-3"> Calculadora simple (SoC)</h1>
        <p class="text-muted">

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Enviar con GET</div>
                    <div class="card-body">
                        <form action="Ejercicio7_process.php" method="get" novalidate>
                            <div class="mb-2">
                                <label for="g_num1" class="form-label">Número 1</label>
                                <input id="g_num1" name="num1" type="number" class="form-control" required min="-1000000" max="1000000" step="any" aria-describedby="g_num1_help">
                                <div id="g_num1_help" class="form-text">Introduce un número (decimales permitidos).</div>
                            </div>
                            <div class="mb-2">
                                <label for="g_num2" class="form-label">Número 2</label>
                                <input id="g_num2" name="num2" type="number" class="form-control" required min="-1000000" max="1000000" step="any">
                            </div>
                            <div class="mb-3">
                                <label for="g_oper" class="form-label">Operador</label>
                                <select id="g_oper" name="operador" class="form-select" required>
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                    <option value="*">*</option>
                                    <option value="/">/</option>
                                    <option value="%">%</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Calcular (GET)</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">Enviar con POST</div>
                    <div class="card-body">
                        <form action="Ejercicio7_process.php" method="post" novalidate>
                            <div class="mb-2">
                                <label for="p_num1" class="form-label">Número 1</label>
                                <input id="p_num1" name="num1" type="number" class="form-control" required min="-1000000" max="1000000" step="any">
                            </div>
                            <div class="mb-2">
                                <label for="p_num2" class="form-label">Número 2</label>
                                <input id="p_num2" name="num2" type="number" class="form-control" required min="-1000000" max="1000000" step="any">
                            </div>
                            <div class="mb-3">
                                <label for="p_oper" class="form-label">Operador</label>
                                <select id="p_oper" name="operador" class="form-select" required>
                                    <option value="+">+</option>
                                    <option value="-">-</option>
                                    <option value="*">*</option>
                                    <option value="/">/</option>
                                    <option value="%">%</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Calcular (POST)</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <p class="small text-muted">Puntos de interés: la validación HTML evita envíos inválidos en el cliente; <code>Ejercicio7_process.php</code> debe validar también en servidor usando <code>$_GET</code> o <code>$_POST</code> según corresponda.</p>
            <p>Ejemplo rápido (GET): <a href="Ejercicio7_process.php?num1=4&num2=2&operador=/">Abrir ejemplo 4 ÷ 2 (GET)</a></p>
        </div>

    </div>

    <script>

        (function(){
            var forms = document.querySelectorAll('form');
            Array.prototype.forEach.call(forms, function(f){
                f.addEventListener('submit', function(e){
                    if (!f.checkValidity()){
                        e.preventDefault();
                        f.classList.add('was-validated');
                        alert('Hay campos inválidos. Por favor revisa los datos antes de enviar.');
                    }
                }, false);
            });
        })();
    </script>

</body>
</html>