<?php
// Ejercicio9.php - Calculadora en un único archivo (procesa y muestra formulario)
error_reporting(E_ALL);
ini_set('display_errors', '1');

$errors = [];
$resultado = null;
$num1 = null;
$num2 = null;
$operador = null;

// Procesar solo si el formulario se ha enviado por POST
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
	$num1 = filter_input(INPUT_POST, 'num1', FILTER_VALIDATE_FLOAT);
	$num2 = filter_input(INPUT_POST, 'num2', FILTER_VALIDATE_FLOAT);
	$operador = filter_input(INPUT_POST, 'operador', FILTER_UNSAFE_RAW);

	if ($num1 === null || $num1 === false) $errors[] = 'Número 1 no válido';
	if ($num2 === null || $num2 === false) $errors[] = 'Número 2 no válido';

	if (empty($errors)) {
		if (($operador === '/' || $operador === '%') && $num2 == 0) {
			$errors[] = 'Error: División por cero.';
		} else {
			if (version_compare(PHP_VERSION, '8.0.0', '>=')) {
				$resultado = match ($operador) {
					'+' => $num1 + $num2,
					'-' => $num1 - $num2,
					'*' => $num1 * $num2,
					'/' => $num1 / $num2,
					'%' => $num1 % $num2,
					default => null,
				};
				if ($resultado === null) $errors[] = 'Operador no válido.';
			} else {
				switch ($operador) {
					case '+':
						$resultado = $num1 + $num2;
						break;
					case '-':
						$resultado = $num1 - $num2;
						break;
					case '*':
						$resultado = $num1 * $num2;
						break;
					case '/':
						$resultado = $num1 / $num2;
						break;
					case '%':
						$resultado = $num1 % $num2;
						break;
					default:
						$errors[] = 'Operador no válido.';
				}
			}
		}
	}
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ejercicio 9 - Calculadora</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<style>body{background:#f8f9fa} .card-calculator{max-width:640px;margin:40px auto}</style>
</head>
<body>
	<nav class="navbar navbar-dark bg-primary mb-4">
		<div class="container"><span class="navbar-brand mb-0 h1">Calculadora (Ej.9)</span></div>
	</nav>

	<main class="container">
		<div class="card card-calculator shadow-sm">
			<div class="card-body">
				<h5 class="card-title">Calculadora básica</h5>

				<?php if (!empty($errors)): ?>
					<div class="alert alert-danger" role="alert"><?php foreach ($errors as $e) echo htmlspecialchars($e) . '<br>'; ?></div>
				<?php elseif ($resultado !== null): ?>
					<div class="alert alert-success" role="alert">
						Resultado: <strong><?= htmlspecialchars((string)$num1) ?></strong>
						<?= htmlspecialchars($operador) ?>
						<strong><?= htmlspecialchars((string)$num2) ?></strong>
						= <strong><?= htmlspecialchars((string)$resultado) ?></strong>
					</div>
				<?php endif; ?>

				<form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="row g-3">
					<div class="col-md-5">
						<label for="num1" class="form-label">Número 1</label>
						<input id="num1" name="num1" type="number" step="any" class="form-control" required value="<?= isset($num1) ? htmlspecialchars((string)$num1) : '' ?>">
					</div>

					<div class="col-md-2 d-flex align-items-end justify-content-center">
						<select id="operador" name="operador" class="form-select" required>
							<?php $ops = ['+' => '+','-' => '-','*' => '*','/' => '/','%' => '%'];
							foreach ($ops as $val => $label) {
								$sel = ($operador === $val) ? ' selected' : '';
								echo "<option value=\"{$val}\"{$sel}>{$label}</option>";
							} ?>
						</select>
					</div>

					<div class="col-md-5">
						<label for="num2" class="form-label">Número 2</label>
						<input id="num2" name="num2" type="number" step="any" class="form-control" required value="<?= isset($num2) ? htmlspecialchars((string)$num2) : '' ?>">
					</div>

					<div class="col-12 text-end">
						<button type="submit" class="btn btn-primary">Calcular</button>
						<a href="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" class="btn btn-outline-secondary ms-2">Borrar</a>
					</div>
				</form>
			</div>
			<div class="card-footer text-muted text-center small">Operadores: + - * / %</div>
		</div>
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

