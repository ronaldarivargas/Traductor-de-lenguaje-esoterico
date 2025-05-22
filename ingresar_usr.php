<?php
session_start();

// Verificar que haya sesión y sea un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    header('Location: server/user/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <!--<link rel="stylesheet" href="css/admin.css">  opcional -->
</head>
<body>
    <form action="server/user/logout.php" method="get">
        <button type="submit" class="delete-btn left-align">Cerrar sesión</button>
    </form>

    <br><br><br>
    <h2>Formulario para crear nuevo usuario</h2>
    <form id="user-form">
        <input id="name" placeholder="Nombre" required>
        <input id="email" placeholder="Correo" required>
        <input id="password" placeholder="Contraseña" required type="password">
        <button type="submit">Guardar</button>
    </form>

    <hr>

    <h2>Gestión de usuarios existentes</h2>
    <button id="btn-ver-usuarios">Mostrar usuarios</button>
    <ul id="user-list"></ul>

    
    <script src="js/client_crud.js"></script>
</body>
</html>





