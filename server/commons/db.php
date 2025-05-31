<?php

$host     = getenv('DB_HOST') ?: '';
$port     = getenv('DB_PORT') ?: '5432';
$user     = getenv('DB_USER') ?: 'postgres';
$pass     = getenv('DB_PASS') ?: '';
$db_name  = getenv('DB_NAME') ?: 'Traductor';

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

bKrkahkdzLf1Jqt5Tm049ZGTVAe924lm.render.com:5432