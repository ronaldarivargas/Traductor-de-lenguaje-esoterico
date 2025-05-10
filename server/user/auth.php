<?php
// login.php
session_start();
require '../commons/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $db->prepare("SELECT * FROM translator.Usr WHERE email = :email AND password = :pwd");
    $stmt->execute([
        'email' => $email,
        'pwd' => $password
    ]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($user)) {
        $_SESSION['user_id'] = $user['id_usr'];
        $_SESSION['user_name'] = $user['name'];
        header('Location: /Traductor-de-lenguaje-esoterico/index.html');
        exit;
    } else {
        header('Location: login.php?error=1');
        exit;
    }
}