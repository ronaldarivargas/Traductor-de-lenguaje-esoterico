<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Traductor de Lenguaje Esotérico</title>
</head>
<body>
    <div id="saludo-usuario"></div>
    <div id="mensaje-login"></div>
    <div id="contenido">
        <h2>Tus Traducciones</h2>
    </div>
    <p><a href="server/user/logout.php">Cerrar sesión</a></p>
    <script src="js/app.js"></script>
    <p><a href="server/user_adm/logout.php">Cerrar sesión adm</a></p>
    <script src="js/app_adm.js"></script>
    
    
</body>
</html>