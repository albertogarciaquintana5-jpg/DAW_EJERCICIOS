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
