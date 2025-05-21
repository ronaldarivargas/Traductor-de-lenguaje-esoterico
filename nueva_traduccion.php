<?php
session_start();
if (!isset($_SESSION['user_id'])) {
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
    <h2>Bienvenido, <?php echo $_SESSION['user_name']; ?></h2>

    <form id="translation-form">
        <textarea id="source_Content" placeholder="Escribe el texto original aquí..." rows="5" cols="60" required></textarea><br>
        <label>Tipo de escritura:</label>
        <select id="cod_typ_writing">
            <option value="1">Runas vikingas</option>
            <option value="2">Antiguos Geroglificos egipcios</option>
            
            <!-- Puedes cargar dinámicamente si tienes más -->
        </select><br><br>
        <button type="submit">Traducir</button>
    </form>

    <div id="mensaje"></div>

    <script src="js/submit_translation.js"></script>
    <hr>
<button onclick="window.location.href='index.php'">Volver a inicio</button>
</body>
</html>