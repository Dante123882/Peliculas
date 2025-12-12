<?php
// 1. Iniciar la sesión ANTES de cualquier HTML
session_start();

require_once 'core/conexion.php';

// 2. Comprobar si el usuario está logueado
$esta_logueado = isset($_SESSION['usuario_id']);
$nombre_usuario = "";
$ruta_foto_perfil="images/default-user.png";

if ($esta_logueado) {
    $id_usuario = $_SESSION['usuario_id'];
    
    // 5. ...buscamos sus datos MÁS ACTUALIZADOS en la BD
    $sql = "SELECT nombre, foto_perfil FROM usuarios WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_usuario]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $nombre_usuario = $usuario['nombre'];
        
        // 6. Misma lógica de 'perfil.php' para encontrar la foto
        if (!empty($usuario['foto_perfil'])) {
            $ruta_tentativa = "uploads/" . $usuario['foto_perfil'];
            // Verificamos que el archivo SÍ exista
            if (file_exists($ruta_tentativa)) {
                $ruta_foto_perfil = $ruta_tentativa;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plataforma de Cursos</title>
    <link rel="stylesheet" href="style/estilo_base.css">
    <link rel="stylesheet" href="style/estilo_inicio.css">
</head>
<body>

    <nav class="navbar-landing">
        <div class="navbar-container">
            
            <a href="index.php" class="navbar-brand-landing">CursosWeb</a>
            
            <!-- <div class="search-bar-landing">
                <input type="text" placeholder="Buscar cursos...">
            </div> -->

            <div class="navbar-links-landing">
                
                <?php if ($esta_logueado): ?>
                    
                    <div class="navbar-user-group">
                        <a href="cursosApp/perfil.php" class="navbar-profile-pic">
                            <img src="<?php echo htmlspecialchars($ruta_foto_perfil); ?>" alt="Foto">
                        </a>
                        <span class="navbar-welcome-landing">
                            ¡Hola, <?php echo htmlspecialchars($nombre_usuario); ?>!
                        </span>
                    </div>

                    <a href="cursosApp/perfil.php" class="navbar-link-landing">Mi Perfil</a>
                    <a href="cursosApp/wallet.php" class="navbar-link">Mi wallet</a>
                    <a href="logout.php" class="navbar-link-logout">Cerrar Sesión</a>
                    
                    <?php else: ?>
                    
                    <a href="login.php" class="navbar-link-cta">Iniciar sesión</a>
                    <a href="registro.php" class="navbar-link-register">Regístrate</a>

                <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if ($esta_logueado): ?>

        <div class="hero-section logged-in">
            <div class="hero-content">
                <h1>Bienvenido de nuevo, <?php echo htmlspecialchars($nombre_usuario); ?>.</h1>
                <p>¿Qué te gustaría hacer hoy? Administra tus cursos o explora tu perfil.</p>
            </div>
        </div>
        
        <div class="menu-container-landing">
            <a href="cursosApp/agregar.php" class="menu-button-landing">
                <img src="images/registrar.jpeg" alt="Icono para registrar datos">
                <span>Registrar Curso</span>
            </a>
            <a href="cursosApp/mostrar.php" class="menu-button-landing">
                <img src="images/tabla.jpeg" alt="Icono para ver los registros">
                <span>Ver Registros</span>
            </a>
        </div>

    <?php else: ?>

        <div class="hero-section">
            <div class="hero-content">
                <h1>Empieza a aprender por menos</h1>
                <p>Si eres nuevo, tenemos buenas noticias: por tiempo limitado, tenemos cursos desde $179 MXN para nuevos estudiantes. Compra ya.</p>
                <a href="registro.php" class="hero-button">Regístrate ahora</a>
            </div>
            <div class="hero-image">
                            </div>
        </div>

    <?php endif; ?>
    
    </body>
</html>