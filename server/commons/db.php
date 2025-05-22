<?php

$host = 'localhost';
$port = '5432';
$user = 'postgres';
$pass = '1234';
$db_name = 'Traductor';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::PGSQL_ATTR_DISABLE_PREPARES => true, // evita errores de encoding
];

try {
    $db = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db_name",
        $user,
        $pass
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->exec("SET NAMES 'UTF8'");
    $db->exec("SET search_path TO translator"); // Establece el esquema por defecto
} catch (PDOException $e) {
    echo 'Error en la conexión ' . $e->getMessage();
    exit();
}

?>