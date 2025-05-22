<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/styles_logins.css">
    
</head>
<body>
    <div class="login-container">
        <h2>Inicio Sesión</h2>
        <form action="auth.php" method="POST">
            <label>Correo:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Contraseña:</label><br>
            <input type="password" name="password" required><br><br>

            <button type="submit">Entrar</button>

            <?php if (isset($_GET['error'])): ?>
                <p style="color:red;">Correo o contraseña incorrectos</p>
            <?php endif; ?>
        </form>
        
    </div>
    <a href="/Traductor-de-lenguaje-esoterico/index.php" class="btn btn-outline-primary mt-3">🏠 Inicio</a>
</body>
</html>
