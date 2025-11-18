<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ejercicio 15/16 - Primo / Divisores (Entrada)</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
	<h1 class="mb-4">Ejercicio 15 y 16 (Formulario)</h1>

	<div class="card mb-4">
		<div class="card-body">
			<form id="ej16Form" action="Ejercicio16_process.php" method="post" novalidate>
				<div class="mb-3">
					<label for="n" class="form-label">Número entero positivo</label>
					<input type="number" class="form-control" id="n" name="n" min="1" step="1" required>
					<div class="invalid-feedback">Introduce un entero positivo (>= 1).</div>
				</div>

				<fieldset class="mb-3">
					<legend class="col-form-label">Qué desea comprobar</legend>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="action" id="opPrimo" value="primo" required>
						<label class="form-check-label" for="opPrimo">Determinar si es primo</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="radio" name="action" id="opDivisores" value="divisores" required>
						<label class="form-check-label" for="opDivisores">Mostrar todos los divisores (se mostrará cada número probado)</label>
					</div>
					<div class="invalid-feedback d-block" id="radioFeedback" style="display:none;">Selecciona una opción.</div>
				</fieldset>

				<div class="mb-3">
					<button type="submit" class="btn btn-primary">Enviar</button>
					<button type="reset" class="btn btn-secondary">Limpiar</button>
				</div>
			</form>
		</div>
	</div>

	<p class="text-muted small">Este formulario POSTea a <code>Ejercicio16_process.php</code>. La validación en servidor es obligatoria.</p>
</div>

<script>
// Vanilla JS validation: ensure positive integer and radio selected
document.getElementById('ej16Form').addEventListener('submit', function (e) {
	const nEl = document.getElementById('n');
	const nVal = Number(nEl.value);
	const radios = document.getElementsByName('action');
	let radioChecked = false;
	for (const r of radios) if (r.checked) radioChecked = true;

	let valid = true;
	if (!Number.isInteger(nVal) || nVal < 1 || isNaN(nVal)) {
		nEl.classList.add('is-invalid');
		valid = false;
	} else {
		nEl.classList.remove('is-invalid');
	}

	const radioFeedback = document.getElementById('radioFeedback');
	if (!radioChecked) {
		radioFeedback.style.display = 'block';
		valid = false;
	} else {
		radioFeedback.style.display = 'none';
	}

	if (!valid) {
		e.preventDefault();
		e.stopPropagation();
	}
});
</script>

</body>
</html>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicio - Primo / Divisores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="mb-4">Determinar Primo o Mostrar Divisores</h1>

    <div class="card mb-4">
        <div class="card-body">
            <form method="post" novalidate>
                <div class="mb-3">
                    <label for="numero" class="form-label">Número entero positivo</label>
                    <input type="number" class="form-control" id="numero" name="numero" min="1" step="1" required
                           value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>">
                    <div class="invalid-feedback">Introduce un número entero positivo (>= 1).</div>
                </div>

                <fieldset class="mb-3">
                    <legend class="col-form-label">¿Qué deseas comprobar?</legend>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="operacion" id="opPrimo" value="primo" 
                               <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'primo') ? 'checked' : ''; ?> required>
                        <label class="form-check-label" for="opPrimo">
                            Determinar si es primo
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="operacion" id="opDivisores" value="divisores"
                               <?php echo (isset($_POST['operacion']) && $_POST['operacion'] == 'divisores') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="opDivisores">
                            Mostrar todos los divisores
                        </label>
                    </div>
                    
                    <div class="invalid-feedback d-block" id="radioFeedback" style="display:none;">
                        Debes seleccionar una opción.
                    </div>
                </fieldset>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Comprobar</button>
                    <button type="reset" class="btn btn-secondary">Limpiar</button>
                </div>
            </form>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['numero']) && isset($_POST['operacion'])) {
        
        echo "<div class='card'>";
        echo "<div class='card-body'>";
        echo "<h2>Resultado</h2>";
        
        $numero = $_POST['numero'];
        $operacion = $_POST['operacion'];
        
        // Validar que el número sea un entero positivo
        if (!is_numeric($numero) || $numero < 1 || floor($numero) != $numero) {
            echo "<div class='alert alert-danger'>El número debe ser un entero positivo (>= 1).</div>";
        } else {
            $numero = (int)$numero;
            
            // Usar match para determinar qué operación realizar
            $resultado = match($operacion) {
                'primo' => determinarPrimo($numero),
                'divisores' => mostrarDivisores($numero),
                default => "<div class='alert alert-danger'>Operación no válida</div>"
            };
            
            echo $resultado;
        }
        echo "</div>";
        echo "</div>";
    }

    // Función para determinar si un número es primo
    function determinarPrimo($numero) {
        if ($numero < 2) {
            return "<div class='alert alert-warning'><strong>$numero</strong> no es un número primo.</div>";
        }
        
        $esPrimo = true;
        $pasos = [];
        
        for ($i = 2; $i <= sqrt($numero); $i++) {
            if ($numero % $i == 0) {
                $esPrimo = false;
                $pasos[] = "Divisible por $i → NO es primo";
                break;
            }
            $pasos[] = "No divisible por $i → sigue comprobando...";
        }
        
        // Mostrar pasos de verificación
        echo "<div class='mb-3'>";
        echo "<h5>Proceso de verificación:</h5>";
        echo "<div class='list-group small'>";
        foreach ($pasos as $paso) {
            echo "<div class='list-group-item'>$paso</div>";
        }
        echo "</div>";
        echo "</div>";
        
        if ($esPrimo) {
            return "<div class='alert alert-success'><strong>$numero</strong> es un número primo.</div>";
        } else {
            return "<div class='alert alert-warning'><strong>$numero</strong> no es un número primo.</div>";
        }
    }

    // Función para mostrar todos los divisores
    function mostrarDivisores($numero) {
        $divisores = [];
        $pasos = [];
        
        echo "<p class='lead'>Buscando divisores de <strong>$numero</strong>:</p>";
        
        for ($i = 1; $i <= $numero; $i++) {
            if ($numero % $i == 0) {
                $divisores[] = $i;
                $pasos[] = "$numero ÷ $i = " . ($numero / $i) . " → $i es divisor";
            } else {
                $pasos[] = "$numero ÷ $i = " . number_format($numero / $i, 2) . " → $i NO es divisor";
            }
        }
        
        // Mostrar pasos de búsqueda
        echo "<div class='mb-3'>";
        echo "<h5>Proceso de búsqueda:</h5>";
        echo "<div class='list-group small' style='max-height: 300px; overflow-y: auto;'>";
        foreach ($pasos as $paso) {
            $clase = strpos($paso, 'es divisor') !== false ? 'list-group-item-success' : '';
            echo "<div class='list-group-item $clase'>$paso</div>";
        }
        echo "</div>";
        echo "</div>";
        
        // Mostrar resultado final
        $cantidad = count($divisores);
        $listaDivisores = implode(', ', $divisores);
        
        return "<div class='alert alert-info'>
                    <h5>Resultado final:</h5>
                    <p class='mb-1'><strong>$numero</strong> tiene <strong>$cantidad</strong> divisores:</p>
                    <p class='mb-0'><strong>$listaDivisores</strong></p>
                </div>";
    }
    ?>
</div>

<script>
// Validación del formulario
document.querySelector('form').addEventListener('submit', function (e) {
    const inputNumero = document.getElementById('numero');
    const radios = document.querySelectorAll('input[name=\"operacion\"]');
    const radioFeedback = document.getElementById('radioFeedback');
    
    const valorNumero = Number(inputNumero.value);
    let radioSeleccionado = false;
    
    radios.forEach(radio => {
        if (radio.checked) radioSeleccionado = true;
    });
    
    let valid = true;
    
    // Validar número
    if (!Number.isInteger(valorNumero) || valorNumero < 1 || isNaN(valorNumero)) {
        inputNumero.classList.add('is-invalid');
        valid = false;
    } else {
        inputNumero.classList.remove('is-invalid');
    }
    
    // Validar radio buttons
    if (!radioSeleccionado) {
        radioFeedback.style.display = 'block';
        valid = false;
    } else {
        radioFeedback.style.display = 'none';
    }

    if (!valid) {
        e.preventDefault();
        e.stopPropagation();
    }
});
</script>

</body>
</html>