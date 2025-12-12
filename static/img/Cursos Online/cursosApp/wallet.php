<?php
session_start(); // Inicia la sesión


// Si la variable de sesión 'id_usuario' no existe, significa que no ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) { 
    // Redirige al usuario al login (que ahora está en la raíz, fuera de la carpeta 'app/')
    header("Location: ../index.php");
    exit(); // Detiene la ejecución del script
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet</title>
</head>
<body>
    <?php require_once 'includes/navbar.php'; ?>
    <hr>
    <section>
        <div>
            <i class="fas fa-credit-card"></i>">
        </div>
    </section>

</body>
</html>