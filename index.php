<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['rol'])) {
    if ($_SESSION['rol'] === 'admin') {
        header('Location: ingresar_usr.php');
        exit;
    } elseif ($_SESSION['rol'] === 'usuario') {
        header('Location: nueva_traduccion.php');
        exit;
    }
}?>
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio - Traductor de Lenguaje Esotérico</title>
    <link rel="stylesheet" href="css/layout.css"> 
    <!-- --> 
</head>
<body>
    <header class="bg-dark text-white py-3">
        <div class="container">
            <h1 class="mb-0">Traductor de Lenguaje Esotérico</h1>
        </div>
    </header>
    <main class="container my-4">
        <div class="text-center">
        <div id="saludo-usuario"></div>
        <div id="mensaje-login"></div>

        <div id="contenido">
            <h2>Tus Traducciones</h2>
        </div>

        <p><a href="server/user/login.php">Iniciar sesión</a></p>

        <footer class="bg-light text-center py-3">
        <p class="mb-0">&copy; 2025 Traductor Esotérico. Todos los derechos reservados.</p>
        </footer>

         <script src="js/app.js"></script>
    </main>


<body>
    
</html>