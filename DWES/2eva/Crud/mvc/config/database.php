<?php
// config/database.php
// Crea y devuelve una instancia PDO con manejo de excepciones

function getPDO() {
    $host = '127.0.0.1';
    $db   = 'crud_php';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        // En un proyecto real no mostrar detalles en producción
        die('DB Connection failed: ' . $e->getMessage());
    }
}
