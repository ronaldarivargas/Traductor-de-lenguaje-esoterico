<?php
require '../../db.php';
$data = json_decode(file_get_contents('php://input'), true);

$query = "DELETE FROM usr WHERE id_usr = :id";
$stmt = $pdo->prepare($query);
$stmt->execute([':id' => $data['id_usr']]);

echo json_encode(['success' => true]);
