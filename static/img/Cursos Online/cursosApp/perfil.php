<?php
// --- INICIO: SEGURIDAD Y NO-CACHE ---
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start(); 

if (!isset($_SESSION['usuario_id'])) { 
    header("Location: ../index.php");
    exit(); 
}
// --- FIN: SEGURIDAD ---

// 1. Incluir conexión
require_once '../core/conexion.php';

// 2. Obtener la información MÁS RECIENTE del usuario desde la BD
$id_usuario = $_SESSION['usuario_id'];
$sql = "SELECT nombre, username, foto_perfil FROM usuarios WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id_usuario]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

// 3. (Opcional) Actualizar el nombre en la sesión si ha cambiado
$_SESSION['usuario_nombre'] = $usuario['nombre'];

// 4. Determinar la ruta de la foto de perfil
$ruta_foto = "../uploads/" . $usuario['foto_perfil'];
if (empty($usuario['foto_perfil']) || !file_exists($ruta_foto)) {
    $ruta_foto = "../images/default-user.png"; // ¡Debes crear esta imagen!
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="stylesheet" href="../style/estilo_base.css">
    <link rel="stylesheet" href="../style/estilo_perfil.css"> 
</head>
<body>

    <?php require_once 'includes/navbar.php'; ?>

    <div class="perfil-container">
        
        <a href="menu.php" class="btn-volver">Volver al Menú</a>
        
        <h2>Mi Perfil</h2>

        <?php 
        // Mostrar mensaje de éxito
        if(isset($_GET['exito'])) {
            echo '<p style="color:green; text-align:center;">¡Foto de perfil actualizada!</p>';
        }
        ?>
        
        <div class="perfil-foto">
            <img src="<?php echo htmlspecialchars($ruta_foto); ?>" alt="Foto de Perfil">
        </div>
        
        <div class="perfil-info">
            <label>Nombre:</label>
            <p><?php echo htmlspecialchars($usuario['nombre']); ?></p>
            
            <label>Usuario:</label>
            <p><?php echo htmlspecialchars($usuario['username']); ?></p>
        </div>
        
        <a href="editar_perfil.php" class="btn-editar-perfil">Editar Foto de Perfil</a>

    </div>

</body>
</html>