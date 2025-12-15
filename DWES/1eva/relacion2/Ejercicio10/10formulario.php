<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Calculadora básica</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <h1>Calculadora básica (captación de datos)</h1>

  <form action="10calculo.php" method="post" novalidate>
    <label>
      Primer número:
      <input type="number" name="num1" step="any" required placeholder="Ej: 5">
    </label>
    <br><br>

    <label>
      Operación:
      <select name="operacion" required>
        <option value="">-- Selecciona --</option>
        <option value="sumar">+</option>
        <option value="restar">−</option>
        <option value="multiplicar">×</option>
        <option value="dividir">÷</option>
      </select>
    </label>
    <br><br>

    <label>
      Segundo número:
      <input type="number" name="num2" step="any" required placeholder="Ej: 3">
    </label>
    <br><br>

    <button type="submit">Calcular</button>
  </form>

  <script>
    // Rellenar los campos si se vuelve desde 10calculo.php con ?num1=... etc.
    const params = new URLSearchParams(window.location.search);
    if (params.size > 0) {
      for (const name of ['num1', 'num2', 'operacion']) {
        const input = document.querySelector(`[name="${name}"]`);
        if (input && params.has(name)) {
          input.value = params.get(name);
        }
      }
    }
  </script>
</body>
</html>
