
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login - Traductor de Lenguaje Esotérico</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 25px 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
        button {
            background-color: teal;
            color: white;
            border: none;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Inicio de Sesión</h2>
        <form action="server/user/auth.php" method="POST">
            <label>
                <span>Correo electrónico:</span>
                <input type="email" name="email" required>
            </label>
            <label>
                <span>Contraseña:</span>
                <input type="password" name="password" required>
            </label>
            <button type="submit">Entrar</button>
        </form>
        <?php if (isset($_GET['error'])): ?>
        <p class="error">Correo o contraseña incorrecta</p>
        <?php endif; ?>
    </div>
</body>
</html>
