<?php
require_once 'includes/auth_check.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link rel="stylesheet" href="../style/estilo_base.css">
    <link rel="stylesheet" href="../style/estilo_registrar.css"> 
</head>
<body>

    <?php require_once 'includes/navbar.php'; ?>
    
    <form action="../core/perfil_proceso.php" method="post" enctype="multipart/form-data">
        <h2>📷 Editar Foto de Perfil</h2>
        <hr>

        <?php 
        // Mostrar mensajes de error
        if(isset($_GET['error'])) {
            echo '<p style="color:var(--color-error); text-align:center;">' . htmlspecialchars($_GET['error']) . '</p>';
        }
        ?>

        <label for="foto_perfil">Selecciona una imagen (JPG o PNG):</label>
        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/jpeg, image/png" required>
        <br><br>

        <button type="submit">Guardar Nueva Foto</button>
        <a href="perfil.php" style="text-align:center; display:block; margin-top:15px; color:var(--color-texto-secundario);">Cancelar</a>
    </form>

</body>
</html>