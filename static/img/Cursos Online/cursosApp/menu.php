<?php
// 1. Llama al script de seguridad y sesión
require_once 'includes/auth_check.php'; 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>

    <link rel="stylesheet" href="../style/estilo_base.css">
    <link rel="stylesheet" href="../style/estilo_menu.css">
</head>
<body>

    <?php require_once 'includes/navbar.php'; ?>

    <div class="menu-container">
        <a href="agregar.php" class="menu-button">
            <img src="../images/registrar.jpeg" alt="Icono para registrar datos">
            <span>Registrar</span>
        </a>
        <a href="mostrar.php" class="menu-button">
            <img src="../images/tabla.jpeg" alt="Icono para ver los registros">
            <span>Ver Registros</span>
        </a>
    </div>

</body>
</html>