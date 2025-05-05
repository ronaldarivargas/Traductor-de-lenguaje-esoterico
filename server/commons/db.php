<?php
$host = "localhost";
$port = '5432';
$dbname = "Traductor";
$user = "postgres";
$password = "1234";

//$host = 'localhost';
//$port = '5432';
//$user = 'postgres';
//$pass = '1234';
//$db_name = 'task_tool';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
