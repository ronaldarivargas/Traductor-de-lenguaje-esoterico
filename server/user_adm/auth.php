<?php
session_start();
require '../commons/db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Buscar al usuario por su correo
$stmt = $db->prepare('SELECT * FROM translator."Usr" WHERE email = :email');
$stmt->execute(['email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Para este ejemplo, usaremos el campo email como contraseña temporal
if ($user && $password === $user['email']) {
    $_SESSION['user_id'] = $user['id_usr'];
    $_SESSION['user_name'] = $user['name'];
    header('Location: /Traductor-de-lenguaje-esoterico/index.html');
    exit;
} else {
    header('Location: login.php?error=1');
    exit;
}
?>
