<?php
/*require '../commons/db.php';

$stmt = $pdo->query("SELECT * FROM usr ORDER BY id_usr DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
*/

require '../commons/db.php';

header('Content-Type: application/json');

try {
    $stmt = $db->query("SELECT * FROM translator.usr ORDER BY id_usr DESC");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
