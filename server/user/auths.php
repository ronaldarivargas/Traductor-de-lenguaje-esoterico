<?php
session_start();
require '../commons/db.php';

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// 1. Buscar en tabla de usuarios normales
$stmt = $db->prepare("SELECT * FROM translator.usr WHERE email = :email");
$stmt->execute([':email' => $email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id_usr'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['rol'] = 'usuario';
    header('Location: ../../nueva_traduccion.php');
    exit;
}

// 2. Buscar en tabla de administradores
$stmt = $db->prepare("SELECT * FROM translator.usr_admin WHERE email = :email");
$stmt->execute([':email' => $email]);
$admin = $stmt->fetch(PDO::FETCH_ASSOC);

if ($admin && $password === $admin['password']) {  // ¡Cuidado si no está hasheado!
    $_SESSION['user_id'] = $admin['id_usr_adm'];
    $_SESSION['user_name'] = $admin['name'];
    $_SESSION['rol'] = 'admin';
    header('Location: ../../ingresar_usr.php');
    exit;
}

// 3. No encontrado en ninguna tabla
header('Location: login.php?error=1');
exit;
