<?php
require '../../db.php'; // tu archivo de conexión
$data = json_decode(file_get_contents('php://input'), true);

$name = $data['name'];
$email = $data['email'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);

$query = "INSERT INTO usr(name, email, password, registration_Date) VALUES (:name, :email, :password, CURRENT_DATE)";
$stmt = $pdo->prepare($query);
$stmt->execute([':name' => $name, ':email' => $email, ':password' => $password]);

echo json_encode(['success' => true]);
