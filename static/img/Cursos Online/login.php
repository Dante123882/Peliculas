<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="form-container">
        <form action="core/proceso.php" method="POST">
            <h1>Iniciar Sesión</h1>

            <input type="hidden" name="accion" value="login">
            
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
            
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>

            <button type="submit">Entrar</button>

            <a href="registro.php">Crea una cuenta</a>
        </form>
    </div>
</body>
</html>