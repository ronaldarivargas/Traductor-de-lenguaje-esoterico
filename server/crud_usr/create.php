<?php
require '../commons/db.php';
header('Content-Type: application/json');

// Leer el cuerpo JSON enviado por fetch
$input = json_decode(file_get_contents('php://input'), true);

// Validar que los campos necesarios existan
if (!isset($input['name'], $input['email'], $input['password'])) {
    echo json_encode(['error' => 'Faltan campos obligatorios.']);
    exit;
}

$name = $input['name'];
$email = $input['email'];
$password = $input['password'];

// Validar que no sean vacíos
if (empty($name) || empty($email) || empty($password)) {
    echo json_encode(['error' => 'Todos los campos son requeridos.']);
    exit;
}

try {

    // Verificar si el correo ya existe
    $checkStmt = $db->prepare("SELECT COUNT(*) FROM translator.usr WHERE email = :email");
    $checkStmt->execute([':email' => $email]);
    $emailExists = $checkStmt->fetchColumn();

    if ($emailExists > 0) {
        echo json_encode(['error' => 'El correo ya está registrado.']);
        exit;
    }

    // Encriptar contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Preparar y ejecutar inserción
    $stmt = $db->prepare("INSERT INTO translator.usr (name, email, password, registration_date) VALUES (:name, :email, :password, NOW())");
    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':password' => $hashedPassword
    ]);

    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}