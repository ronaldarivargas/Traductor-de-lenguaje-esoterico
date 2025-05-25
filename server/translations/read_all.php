<?php
require '../commons/db.php';
header('Content-Type: application/json');

try {
    $sql = "
        SELECT 
            t.id_trans,
            o.source_content,
            t.transld_contn,
            t.translation_date
        FROM translator.\"Translations\" t
        JOIN translator.\"Original_Texts\" o 
          ON o.id_orig_t = t.cod_text_oring
        ORDER BY t.translation_date DESC
    ";
    $stmt = $db->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($rows);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
