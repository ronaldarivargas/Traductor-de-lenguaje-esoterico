<?php
session_start();
require '../commons/db.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

$id_usr = $_SESSION['user_id'];

try {
    $stmt = $db->prepare(
        'SELECT ot.id_orig_t, ot."source_Content", t."transld_Contn", t."translation_Date"
         FROM translator."Usr" u
         JOIN translator."Translation_Requests" tr ON u.id_usr = tr.cod_usr
         JOIN translator."Original_Texts" ot ON tr.id_t_reque = ot.cod_trad_resq
         JOIN translator."Translations" t ON t.cod_text_oring = ot.id_orig_t
         WHERE u.id_usr = :id_usr
         ORDER BY t."translation_Date" DESC'
    );
    $stmt->execute(['id_usr' => $id_usr]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($results);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error en la base de datos: ' . $e->getMessage()]);
}
