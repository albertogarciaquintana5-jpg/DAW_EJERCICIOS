<?php
if (isset($_POST["nombre"])) {
    echo "Hola " . $_POST["nombre"] . " " . $_POST["apellidos"] . "<br>";
}

echo "Fecha del servidor: ";
echo date("d/m/Y H:i:s");
?>
