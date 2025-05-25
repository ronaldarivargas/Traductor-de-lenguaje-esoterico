<?php
require '../commons/db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id_usr'], $data['name'], $data['email'])) {
    echo json_encode(['error' => 'Faltan campos.']);
    exit;
}

$id       = (int)$data['id_usr'];
$name     = trim($data['name']);
$email    = trim($data['email']);
$password = isset($data['password']) ? trim($data['password']) : '';

if ($id <= 0 || $name === '' || $email === '') {
    echo json_encode(['error' => 'Datos inválidos.']);
    exit;
}

try {
    // Validar correo duplicado
    $check = $db->prepare("SELECT COUNT(*) FROM translator.usr WHERE email = :email AND id_usr <> :id");
    $check->execute([':email' => $email, ':id' => $id]);
    if ($check->fetchColumn() > 0) {
        echo json_encode(['error' => 'Ese correo ya está en uso.']);
        exit;
    }

    // Según si hay password
    if ($password !== '') {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("
            UPDATE translator.usr 
            SET name = :name, email = :email, password = :password 
            WHERE id_usr = :id
        ");
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $hashed,
            ':id'       => $id
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Usuario y contraseña actualizados.'
        ]);
    } else {
        $stmt = $db->prepare("
            UPDATE translator.usr 
            SET name = :name, email = :email 
            WHERE id_usr = :id
        ");
        $stmt->execute([
            ':name'  => $name,
            ':email'=> $email,
            ':id'   => $id
        ]);

        echo json_encode([
            'success' => true,
            'message' => 'Usuario actualizado sin cambiar la contraseña.'
        ]);
    }

} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en BD: ' . $e->getMessage()]);
    exit;
}
