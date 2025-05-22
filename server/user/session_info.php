<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['user_id'])) {
    echo json_encode([
        'user_id' => $_SESSION['user_id'],
        'user_name' => $_SESSION['user_name'],
        'rol' => $_SESSION['rol'] ?? 'usuario' // Por si no se define explícitamente
    ]);
} else {
    echo json_encode(['error' => 'No hay sesión activa']);
}
?>