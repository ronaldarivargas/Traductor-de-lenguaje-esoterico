<?php
$host = 'localhost';
$port = '5432';
$dbname = 'Traductor'; // Reemplaza por el nombre real de tu base de datos
$user = 'postgres';          // Usuario de PostgreSQL
$pass = '1234';     // Contraseña de PostgreSQL

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

echo json_encode(['error' => 'Se hizo la conexión']); 

?>
