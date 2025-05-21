<?php
require '../../db.php';

$stmt = $pdo->query("SELECT * FROM usr ORDER BY id_usr DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
