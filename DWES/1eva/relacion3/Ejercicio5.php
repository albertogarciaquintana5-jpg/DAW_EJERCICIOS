<?php
// Procesamiento de calculadora -> adaptado para calcular calificación
error_reporting(E_ALL);
ini_set('display_errors', '1');

$errors = [];
$resultado = null;

// Leer datos (GET)
$nombre = trim((string) filter_input(INPUT_GET, 'nombre', FILTER_UNSAFE_RAW));
$email = filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL);
$tipo_documento = trim((string) filter_input(INPUT_GET, 'tipo_documento', FILTER_UNSAFE_RAW));
$numero_documento = trim((string) filter_input(INPUT_GET, 'numero_documento', FILTER_UNSAFE_RAW));
$inicial = filter_input(INPUT_GET, 'inicial', FILTER_VALIDATE_FLOAT);
$primera = filter_input(INPUT_GET, 'primera', FILTER_VALIDATE_FLOAT);
$segunda = filter_input(INPUT_GET, 'segunda', FILTER_VALIDATE_FLOAT);
$tercera = filter_input(INPUT_GET, 'tercera', FILTER_VALIDATE_FLOAT);

$hasInput = ($_SERVER['REQUEST_METHOD'] === 'GET') && (
    $nombre !== '' || $email !== null || $tipo_documento !== '' || $numero_documento !== '' || 
    $inicial !== null || $primera !== null || $segunda !== null || $tercera !== null
);

// Función para validar documentos - CORREGIDA
function validarDocumento($tipo, $numero) {
    $numero = strtoupper(trim($numero));
    
    switch($tipo) {
        case 'dni':
            // DNI: 8 dígitos + 1 letra
            if (!preg_match('/^[0-9]{8}[A-Z]$/', $numero)) {
                return false;
            }
            $numeros = intval(substr($numero, 0, 8)); // Convertir a entero
            $letra = substr($numero, 8, 1);
            $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            $letraCorrecta = $letras[$numeros % 23];
            return $letra === $letraCorrecta;
            
        case 'nie':
            // NIE: X/Y/Z + 7 dígitos + 1 letra
            if (!preg_match('/^[XYZ][0-9]{7}[A-Z]$/', $numero)) {
                return false;
            }
            // Reemplazar primera letra para el cálculo
            $reemplazo = [
                'X' => '0',
                'Y' => '1', 
                'Z' => '2'
            ];
            $primerDigito = $reemplazo[$numero[0]];
            $numeros = intval($primerDigito . substr($numero, 1, 7)); // Convertir a entero
            $letra = substr($numero, 8, 1);
            $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
            $letraCorrecta = $letras[$numeros % 23];
            return $letra === $letraCorrecta;
            
        case 'tie':
            // TIE: E + 8 dígitos
            return preg_match('/^E[0-9]{8}$/', $numero);
            
        default:
            return false;
    }
}

if ($hasInput) {
    // Validaciones servidor
    if ($nombre === '') {
        $errors[] = 'El nombre es obligatorio.';
    }
    if ($email === false || $email === null) {
        $errors[] = 'Correo electrónico inválido o vacío.';
    }
    if ($tipo_documento === '') {
        $errors[] = 'El tipo de documento es obligatorio.';
    }
    if ($numero_documento === '') {
        $errors[] = 'El número de documento es obligatorio.';
    } elseif ($tipo_documento && $numero_documento && !validarDocumento($tipo_documento, $numero_documento)) {
        $errors[] = "El número de documento no es válido para el tipo $tipo_documento.";
    }

    $notes = ['inicial' => $inicial, 'primera' => $primera, 'segunda' => $segunda, 'tercera' => $tercera];
    foreach ($notes as $k => $v) {
        if ($v === false || $v === null) {
            $errors[] = "La nota '{$k}' es inválida o está vacía. Debe ser un número.";
        } else {
            // Comprobar rango 0..10
            if ($v < 0 || $v > 10) $errors[] = "La nota '{$k}' debe estar entre 0 y 10.";
        }
    }

    // Si todo OK, calcular promedio simple
    if (empty($errors)) {
        $suma = floatval($inicial) + floatval($primera) + floatval($segunda) + floatval($tercera);
        $resultado = $suma / 4.0; // Averaging equal weight
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio 5 - Calculadora</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="" crossorigin="anonymous">
    <style>
        body { background-color: #f8f9fa; }
        .card-calculator { max-width: 640px; margin: 40px auto; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Calculadora PHP</a>
        </div>
    </nav>

    <main class="container">
        <div class="card card-calculator shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-3">Calculadora básica</h5>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger" role="alert">
                        <ul class="mb-0">
                        <?php foreach ($errors as $e): ?>
                            <li><?= htmlspecialchars($e) ?></li>
                        <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif ($resultado !== null): ?>
                    <div class="alert alert-success" role="alert">
                        <p class="mb-1">Calificación para <strong><?= htmlspecialchars($nombre) ?></strong> (<?= htmlspecialchars($email) ?>)</p>
                        <p class="mb-1">Documento: <?= htmlspecialchars($tipo_documento) ?> <?= htmlspecialchars($numero_documento) ?></p>
                        <p class="mb-1">Notas: inicial=<?= htmlspecialchars((string)$inicial) ?>, primera=<?= htmlspecialchars((string)$primera) ?>, segunda=<?= htmlspecialchars((string)$segunda) ?>, tercera=<?= htmlspecialchars((string)$tercera) ?>.</p>
                        <hr>
                        <p class="mb-0">Calificación final (media simple): <strong><?= htmlspecialchars(number_format($resultado,2)) ?></strong></p>
                    </div>
                <?php endif; ?>

                <form method="get" class="row g-3 needs-validation" novalidate id="calculoForm">
                    <div class="col-12 col-md-6">
                        <label for="nombre" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required minlength="2" value="<?= htmlspecialchars($nombre ?? '') ?>">
                        <div class="invalid-feedback">Introduce el nombre.</div>
                    </div>

                    <div class="col-12 col-md-6">
                        <label for="email" class="form-label">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required value="<?= htmlspecialchars(isset($email) && $email !== false ? $email : '') ?>">
                        <div class="invalid-feedback" id="emailError">Introduce un correo válido.</div>
                    </div>

                    <div class="col-12 col-md-4">
                        <label for="tipo_documento" class="form-label">Tipo de documento</label>
                        <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                            <option value="">Seleccionar...</option>
                            <option value="dni" <?= ($tipo_documento ?? '') === 'dni' ? 'selected' : '' ?>>DNI</option>
                            <option value="nie" <?= ($tipo_documento ?? '') === 'nie' ? 'selected' : '' ?>>NIE</option>
                            <option value="tie" <?= ($tipo_documento ?? '') === 'tie' ? 'selected' : '' ?>>TIE</option>
                        </select>
                        <div class="invalid-feedback">Selecciona un tipo de documento.</div>
                    </div>

                    <div class="col-12 col-md-8">
                        <label for="numero_documento" class="form-label">Número de documento</label>
                        <input type="text" class="form-control" id="numero_documento" name="numero_documento" required value="<?= htmlspecialchars($numero_documento ?? '') ?>">
                        <div class="invalid-feedback" id="documentoError">Introduce un número de documento válido.</div>
                        <div class="form-text">
                            <small>
                                <strong>Formatos:</strong><br>
                                DNI: 8 dígitos + letra (ej: 12345678Z)<br>
                                NIE: Letra X/Y/Z + 7 dígitos + letra (ej: X1234567L)<br>
                                TIE: Letra E + 8 dígitos (ej: E00123456)
                            </small>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <label for="inicial" class="form-label">Nota inicial</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="inicial" name="inicial" required value="<?= isset($inicial) ? htmlspecialchars((string)$inicial) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="primera" class="form-label">Primera</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="primera" name="primera" required value="<?= isset($primera) ? htmlspecialchars((string)$primera) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="segunda" class="form-label">Segunda</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="segunda" name="segunda" required value="<?= isset($segunda) ? htmlspecialchars((string)$segunda) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <label for="tercera" class="form-label">Tercera</label>
                        <input type="number" step="0.01" min="0" max="10" class="form-control" id="tercera" name="tercera" required value="<?= isset($tercera) ? htmlspecialchars((string)$tercera) : '' ?>">
                        <div class="invalid-feedback">Valor entre 0 y 10.</div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Calcular calificación</button>
                        <a href="./Ejercicio5.php" class="btn btn-outline-secondary ms-2">Limpiar</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-muted text-center small">
                Notas entre 0 y 10. Todas las notas tienen el mismo peso (media simple).
            </div>
        </div>
    </main>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="" crossorigin="anonymous"></script>
    <script>
        // Validación de email con expresión regular
        function validarEmail(email) {
            const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return regex.test(email);
        }

        // Validación de documentos - CORREGIDA
        function validarDocumentoJS(tipo, numero) {
            numero = numero.toUpperCase().trim();
            
            switch(tipo) {
                case 'dni':
                    // DNI: 8 dígitos + 1 letra
                    if (!/^[0-9]{8}[A-Z]$/.test(numero)) {
                        return false;
                    }
                    const numerosDNI = parseInt(numero.substring(0, 8), 10); // Convertir a entero
                    const letraDNI = numero.substring(8, 9);
                    const letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
                    const letraCorrecta = letras[numerosDNI % 23];
                    return letraDNI === letraCorrecta;
                    
                case 'nie':
                    // NIE: X/Y/Z + 7 dígitos + 1 letra
                    if (!/^[XYZ][0-9]{7}[A-Z]$/.test(numero)) {
                        return false;
                    }
                    const reemplazo = {
                        'X': '0',
                        'Y': '1', 
                        'Z': '2'
                    };
                    const primerDigitoNIE = reemplazo[numero[0]];
                    const numerosNIE = parseInt(primerDigitoNIE + numero.substring(1, 8), 10); // Convertir a entero
                    const letraNIE = numero.substring(8, 9);
                    const letraCorrectaNIE = letras[numerosNIE % 23];
                    return letraNIE === letraCorrectaNIE;
                    
                case 'tie':
                    // TIE: E + 8 dígitos
                    return /^E[0-9]{8}$/.test(numero);
                    
                default:
                    return false;
            }
        }

        // Bootstrap-style client validation
        (function(){
            const form = document.getElementById('calculoForm');
            const emailInput = document.getElementById('email');
            const tipoDocInput = document.getElementById('tipo_documento');
            const numeroDocInput = document.getElementById('numero_documento');
            const emailError = document.getElementById('emailError');
            const documentoError = document.getElementById('documentoError');

            // Validación personalizada para email
            emailInput.addEventListener('blur', function() {
                if (this.value && !validarEmail(this.value)) {
                    this.classList.add('is-invalid');
                    emailError.textContent = 'Formato de email inválido. Ej: usuario@dominio.com';
                } else {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                }
            });

            // Validación personalizada para documento
            numeroDocInput.addEventListener('blur', function() {
                const tipo = tipoDocInput.value;
                const numero = this.value;
                
                if (tipo && numero) {
                    if (validarDocumentoJS(tipo, numero)) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.add('is-invalid');
                        this.classList.remove('is-valid');
                        let mensaje = '';
                        switch(tipo) {
                            case 'dni': mensaje = 'DNI inválido. Formato: 8 dígitos + letra (ej: 12345678Z)'; break;
                            case 'nie': mensaje = 'NIE inválido. Formato: X/Y/Z + 7 dígitos + letra (ej: X1234567L)'; break;
                            case 'tie': mensaje = 'TIE inválido. Formato: E + 8 dígitos (ej: E00123456)'; break;
                            default: mensaje = 'Documento inválido';
                        }
                        documentoError.textContent = mensaje;
                    }
                }
            });

            // También validar cuando cambia el tipo de documento
            tipoDocInput.addEventListener('change', function() {
                if (numeroDocInput.value) {
                    numeroDocInput.dispatchEvent(new Event('blur'));
                }
            });

            // Auto-formato para DNI/NIE (convertir a mayúsculas)
            numeroDocInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });

            form.addEventListener('submit', function(event){
                let isValid = true;

                // Validar email
                if (emailInput.value && !validarEmail(emailInput.value)) {
                    emailInput.classList.add('is-invalid');
                    emailError.textContent = 'Formato de email inválido. Ej: usuario@dominio.com';
                    isValid = false;
                } else {
                    emailInput.classList.remove('is-invalid');
                }

                // Validar documento si ambos campos están completos
                if (tipoDocInput.value && numeroDocInput.value) {
                    if (!validarDocumentoJS(tipoDocInput.value, numeroDocInput.value)) {
                        numeroDocInput.classList.add('is-invalid');
                        isValid = false;
                    } else {
                        numeroDocInput.classList.remove('is-invalid');
                    numeroDocInput.classList.add('is-valid');
                    documentoError.textContent = '';
                    documentoError.style.display = 'none';
                    // Crear y mostrar mensaje de éxito
                        const successElement = document.createElement('div');
                        successElement.className = 'valid-feedback';
                        successElement.textContent = 'Documento válido';
                        successElement.style.display = 'block';
                        // Limpiar feedback anterior
                        const existingFeedback = numeroDocInput.parentNode.querySelector('.valid-feedback');
                        if (existingFeedback) {
                            existingFeedback.remove();
                        }
                        numeroDocInput.parentNode.appendChild(successElement);
                    }
                }

                if (!form.checkValidity() || !isValid) {
                    event.preventDefault();
                    event.stopPropagation();
                    form.classList.add('was-validated');
                    return false;
                }
            }, false);
        })();

        // Ejemplos de documentos válidos para probar:
        // DNI: 12345678Z, 53018002J, 12345678Z
        // NIE: X1234567L, Y1234567X, Z1234567R
        // TIE: E00123456, E12345678, E00000001
    </script>
</body>
</html>