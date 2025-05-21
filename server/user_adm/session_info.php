<?php
session_start();
require_once '../commons/db.php';

header('Content-Type: application/json');

if (!$db) {
    echo json_encode(['error' => 'No se pudo establecer conexión con la base de datos']);
    exit;
}

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'user_id' => $_SESSION['id_usr_ad'],
        'user_name' => $_SESSION['name']
    ]);
} else {
    echo json_encode(['error' => 'No hay sesión activa']);
}
?>