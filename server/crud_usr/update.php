<?php
require '../../db.php';
$data = json_decode(file_get_contents('php://input'), true);

$query = "UPDATE usr SET name = :name, email = :email WHERE id_usr = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':name' => $data['name'],
    ':email' => $data['email'],
    ':id' => $data['id_usr']
]);

echo json_encode(['success' => true]);
