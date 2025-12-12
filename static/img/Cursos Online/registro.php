<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="form-container">
        <form method="POST" action="core/proceso.php" enctype="multipart/form-data"> 
            
            <h1>Registro</h1>
            
            <?php if(isset($_GET['error'])): ?>
                <p style="color: #cf6679; text-align: center;"><?php echo htmlspecialchars($_GET['error']); ?></p>
            <?php endif; ?>

            <input type="hidden" name="accion" value="registrar">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="foto_perfil">Foto de Perfil (JPG/PNG):</label>
            <input type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg, image/png" required>
            
            <button type="submit">Crear Cuenta</button>
            <a href="login.php">Volver</a>
        </form>
    </div>
</body>
</html>
</html>