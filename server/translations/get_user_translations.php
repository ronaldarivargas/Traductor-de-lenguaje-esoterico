<?php
session_start();
require '../commons/db.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Consultar las traducciones anteriores del usuario
    try {
        $stmt = $db->prepare('SELECT * FROM translator."Translations" WHERE cod_usr = :user_id');
        $stmt->execute(['user_id' => $user_id]);
        $translations = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retornar las traducciones en formato JSON
        echo json_encode($translations);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al obtener las traducciones: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'No user_id provided']);
}
?>
