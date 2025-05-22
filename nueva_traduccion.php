<?php
session_start();

// Verificar que haya sesión y sea un usuario
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'usuario') {
    header('Location: server/user/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar Traducción</title>
    
</head>
<body>
    <form action="server/user/logout.php" method="post">
        <button type="submit">Cerrar sesión</button>
    </form>

    <h2>Bienvenido, <?php echo $_SESSION['user_name']; ?></h2>

    <form id="translation-form">
        <textarea id="source_Content" placeholder="Escribe el texto original aquí..." rows="5" cols="60" required></textarea><br>
        <label>Tipo de escritura:</label>
        <select id="cod_typ_writing">
            <option value="1">Runas vikingas</option>
            <option value="2">Lenguaje Antiguo Vikingo Anciano</option>



        </select><br><br>
        <button type="submit">Traducir</button>
    </form>

    <h3>Traducción:</h3>
    <textarea id="resultado_traduccion" rows="5" cols="60" readonly></textarea>
    
    <div id="mensaje"></div>

    <script src="js/submit_translation.js"></script>
</body>
</html>
