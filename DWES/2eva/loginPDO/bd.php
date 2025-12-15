<?php
$servidor = 'mysql:host=localhost;dbname=pdo';
$usuario = 'root';
$password = '';

try {
    $pdo = new PDO($servidor, $usuario, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión OK con PDO"; // o lo que sea pertinente hacer aquí
} catch (PDOException $e) {
    echo "Conexión fallida - ERROR de conexión: " . $e->getMessage(); // ídem
}
?>