<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingresar un nuevo usuario - Traductor de Lenguaje Esotérico</title>
</head>
<body>
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
    <ul id="user-list" style="display:none;"></ul>

    <script src="/Traductor-de-lenguaje-esoterico/js/client_crud.js"></script>
    <hr>
    <button onclick="window.location.href='index.php'">Volver a inicio</button>
</body>
</html>


