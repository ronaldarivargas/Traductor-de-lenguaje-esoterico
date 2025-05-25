<?php
require '../commons/db.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="reporte_traducciones.csv"');

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=\"reporte_traducciones.csv\"');

$output = fopen("php://output", "w");
fputcsv($output, ['ID', 'Texto original', 'Traducción', 'Fecha']);

$sql = "SELECT t.id_trans, o.source_content, t.transld_contn, t.translation_date
        FROM translator.\"Translations\" t
        JOIN translator.\"Original_Texts\" o ON o.id_orig_t = t.cod_text_oring";

foreach ($db->query($sql) as $row) {
    fputcsv($output, [
        $row['id_trans'],
        $row['source_content'],
        $row['transld_contn'],
        $row['translation_date']
    ]);
}

fclose($output);
exit;
