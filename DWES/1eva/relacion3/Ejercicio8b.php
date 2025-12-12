<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Disyunción estricta</title>
<script>
function validar() {
    if (!document.querySelector('input[name=opcion]:checked')) {
        alert("Debe seleccionar mayúsculas o minúsculas.");
        return false;
    }
    return true;
}
</script>
</head>
<body>

<h2>Conversión estricta</h2>

<form method="post" onsubmit="return validar()">
    Texto: <input type="text" name="texto" required><br><br>

    <label><input type="radio" name="opcion" value="may"> Mayúsculas</label><br>
    <label><input type="radio" name="opcion" value="min"> Minúsculas</label><br><br>

    <button type="submit">Enviar</button>
</form>

<?php
if ($_POST) {
    $texto = $_POST["texto"];
    $op = $_POST["opcion"];

    echo "<p><strong>";
    echo ($op == "may") ? strtoupper($texto) : strtolower($texto);
    echo "</strong></p>";
}
?>

</body>
</html>
