<?php
require 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$tipo = $_POST['tipo'];
$contenido = $_POST['contenido'];

// Insertar usuario si no existe (simplificación)
$stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo_electronico) 
                       VALUES (:nombre, :correo)
                       ON CONFLICT (correo_electronico) DO NOTHING");
$stmt->execute(['nombre' => $nombre, 'correo' => $correo]);

// Obtener ID del usuario
$stmt = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE correo_electronico = :correo");
$stmt->execute(['correo' => $correo]);
$id_usuario = $stmt->fetchColumn();

// Insertar solicitud
$stmt = $pdo->prepare("INSERT INTO solicitudes_traduccion (id_usuario, fecha_solicitud, estado, medio_envio)
                       VALUES (:id_usuario, NOW(), 'pendiente', 'correo') RETURNING id_solicitud");
$stmt->execute(['id_usuario' => $id_usuario]);
$id_solicitud = $stmt->fetchColumn();

// Insertar texto
$stmt = $pdo->prepare("INSERT INTO textos_originales (id_solicitud, id_tipo, contenido_original)
                       VALUES (:id_solicitud, :id_tipo, :contenido)");
$stmt->execute([
  'id_solicitud' => $id_solicitud,
  'id_tipo' => $tipo,
  'contenido' => $contenido
]);

echo "Solicitud enviada correctamente.";
?>
