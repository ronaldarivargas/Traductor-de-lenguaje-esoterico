<?php
require '../commons/db.php';
$data = json_decode(file_get_contents('php://input'), true);

$query = "DELETE FROM translator.usr WHERE id_usr = :id";
$stmt = $db->prepare($query);
$stmt->execute([':id' => $data['id_usr']]);

echo json_encode(['success' => true]);
?>