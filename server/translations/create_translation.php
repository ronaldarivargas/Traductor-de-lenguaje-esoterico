<?php
session_start();
header('Content-Type: application/json');
require_once '../commons/db.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'No has iniciado sesión.']);
    exit;
}

// REGISTRA EL JSON RECIBIDO EN UN ARCHIVO LOG (para depuración)
$input = file_get_contents('php://input');
file_put_contents('log.txt', $input); // Guarda el cuerpo crudo del request


$data = json_decode(file_get_contents('php://input'), true);
$userId = $_SESSION['user_id'];
$source_Content = trim($data['source_Content']);
$cod_typ_writing = intval($data['cod_typ_writing']);

// Normaliza UTF-8 y elimina caracteres invisibles problemáticos

// 1. Intenta convertir a UTF-8 desde lo que venga
$source_Content = mb_convert_encoding($source_Content, 'UTF-8', 'UTF-8');

// 2) Translitera caracteres especiales a su equivalente más cercano
//    (por ejemplo “—” → "-", ““” → '"', etc.)
$source_Content = iconv('UTF-8', 'UTF-8//TRANSLIT//IGNORE', $source_Content);
$cod_typ_writing = intval($data['cod_typ_writing']);
// 3) Elimina sólo los caracteres de control no imprimibles
$source_Content = preg_replace('/[\x00-\x1F\x7F]/u', '', $source_Content);
$source_Content = preg_replace('/[^\x{20}-\x{7E}\x{A1}-\x{FF}\p{L}\p{N}\p{P}\p{Z}]/u', '', $source_Content);

// Aquí va tu línea
//$source_Content = filter_var($source_Content, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);


// 4) Finalmente normaliza las tildes y la ñ con NFC (si está disponible)
if (class_exists('Normalizer')) {
    $source_Content = Normalizer::normalize($source_Content, Normalizer::FORM_C);
}

// validar vacío
if (empty($source_Content)) {
    echo json_encode(['error' => 'El texto original no puede estar vacío.']);
    exit;
}

try {
    // 1. Insertar solicitud de traducción
    $stmt = $db->prepare("INSERT INTO translator.\"Translation_Requests\" (date_Request, state, shipping_edium, cod_usr) VALUES (NOW(), 'pendiente', 'web', :usr_id) RETURNING id_t_reque");
    $stmt->execute([':usr_id' => $userId]);
    $id_t_reque = $stmt->fetchColumn();

    // 2. Insertar texto original
    $stmt2 = $db->prepare("INSERT INTO translator.\"Original_Texts\" (source_Content, cod_trad_resq, cod_typ_writing) VALUES (:content, :req, :type) RETURNING id_orig_t");
    $stmt2->execute([
        ':content' => $source_Content,
        ':req' => $id_t_reque,
        ':type' => $cod_typ_writing
    ]);
    $id_orig_t = $stmt2->fetchColumn();

    // 3. Insertar traducción (sólo como ejemplo, normalmente deberías procesar esto)
    $fake_translation = strrev($source_Content); // Simula traducción
    $stmt3 = $db->prepare("INSERT INTO translator.\"Translations\" (transld_Contn, translation_Date, cod_text_oring) VALUES (:trad, NOW(), :orig)");
    $stmt3->execute([
        ':trad' => $fake_translation,
        ':orig' => $id_orig_t
    ]);

    //echo json_encode(['success' => true]);
    echo json_encode([
    'success' => true,
    'traduccion' => $fake_translation // Devuelve la traducción generada
]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}