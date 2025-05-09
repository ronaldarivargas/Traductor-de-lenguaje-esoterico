<<<<<<< HEAD



<?php
$host = 'localhost';
$port = '5432';
$db = 'Traductor';
$user = 'postgres';
$pass = '1234';

$dsn = "pgsql:host=$host;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

=======
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
>>>>>>> 2e40fff (Subiendo backup de la base de datos del proyecto)
