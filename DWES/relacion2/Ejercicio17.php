<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ejercicio 17 - Cociente y Resto (Entrada)</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
	<h1 class="mb-4">Ejercicio 17 (Formulario)</h1>

	<div class="card mb-4">
		<div class="card-body">
			<form id="ej17Form" action="ejercicio17_process.php" method="post" novalidate>
				<div class="mb-3">
					<label for="dividendo" class="form-label">Dividendo (entero positivo)</label>
					<input type="number" class="form-control" id="dividendo" name="dividendo" min="1" step="1" required>
					<div class="invalid-feedback">Introduce un entero positivo (>= 1).</div>
				</div>

				<div class="mb-3">
					<label for="divisor" class="form-label">Divisor (entero positivo)</label>
					<input type="number" class="form-control" id="divisor" name="divisor" min="1" step="1" required>
					<div class="invalid-feedback">Introduce un entero positivo (>= 1).</div>
				</div>

				<fieldset class="mb-3">
					<legend class="col-form-label">Qué desea calcular</legend>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="calculo[]" id="opCociente" value="cociente">
						<label class="form-check-label" for="opCociente">Calcular cociente</label>
					</div>
					<div class="form-check">
						<input class="form-check-input" type="checkbox" name="calculo[]" id="opResto" value="resto">
						<label class="form-check-label" for="opResto">Calcular resto</label>
					</div>
					<div class="invalid-feedback d-block" id="checkboxFeedback" style="display:none;">Selecciona al menos una opción.</div>
				</fieldset>

				<div class="mb-3">
					<button type="submit" class="btn btn-primary">Enviar</button>
					<button type="reset" class="btn btn-secondary">Limpiar</button>
				</div>
			</form>
		</div>
	</div>

	<p class="text-muted small">Este formulario POSTea a <code>ejercicio17_process.php</code>. La validación en servidor es obligatoria.</p>
</div>

<script>
// Vanilla JS validation: ensure positive integers and at least one checkbox selected
document.getElementById('ej17Form').addEventListener('submit', function (e) {
	const dividendoEl = document.getElementById('dividendo');
	const divisorEl = document.getElementById('divisor');
	const dividendoVal = Number(dividendoEl.value);
	const divisorVal = Number(divisorEl.value);
	
	const checkboxes = document.getElementsByName('calculo[]');
	let checkboxChecked = false;
	for (const cb of checkboxes) if (cb.checked) checkboxChecked = true;

	let valid = true;
	
	// Validar dividendo
	if (!Number.isInteger(dividendoVal) || dividendoVal < 1 || isNaN(dividendoVal)) {
		dividendoEl.classList.add('is-invalid');
		valid = false;
	} else {
		dividendoEl.classList.remove('is-invalid');
	}

	// Validar divisor
	if (!Number.isInteger(divisorVal) || divisorVal < 1 || isNaN(divisorVal)) {
		divisorEl.classList.add('is-invalid');
		valid = false;
	} else {
		divisorEl.classList.remove('is-invalid');
	}

	// Validar checkboxes
	const checkboxFeedback = document.getElementById('checkboxFeedback');
	if (!checkboxChecked) {
		checkboxFeedback.style.display = 'block';
		valid = false;
	} else {
		checkboxFeedback.style.display = 'none';
	}

	if (!valid) {
		e.preventDefault();
		e.stopPropagation();
	}
});
</script>

</body>
</html>
