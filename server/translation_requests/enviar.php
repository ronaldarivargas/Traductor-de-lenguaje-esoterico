<?php
require 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$cod_typ_writing = $_POST['cod_typ_writing'];
$source_Content = $_POST['source_Content'];

// Insertar usuario si no existe
$stmt = $pdo->prepare("INSERT INTO Usr (name, email) 
                       VALUES (:name, :email)
                       ON CONFLICT (email) DO NOTHING");
$stmt->execute(['name' => $name, 'email' => $email]);

// Obtener ID del usuario
$stmt = $pdo->prepare("SELECT id_usr FROM Usr WHERE email = :email");
$stmt->execute(['email' => $email]);
$id_usr = $stmt->fetchColumn();

// Insertar solicitud
$stmt = $pdo->prepare("INSERT INTO Translation_Requests (cod_usr, date_Request, state, shipping_edium)
                       VALUES (:cod_usr, NOW(), 'pendiente', 'correo') RETURNING id_t_reque");
$stmt->execute(['cod_usr' => $id_usr]);
$id_t_reque = $stmt->fetchColumn();

// Insertar texto original
$stmt = $pdo->prepare("INSERT INTO Original_Texts (cod_trad_resq, cod_typ_writing, source_Content)
                       VALUES (:cod_trad_resq, :cod_typ_writing, :source_Content)");
$stmt->execute([
  'cod_trad_resq' => $id_t_reque,
  'cod_typ_writing' => $cod_typ_writing,
  'source_Content' => $source_Content
]);

echo "Solicitud enviada correctamente.";
?>
