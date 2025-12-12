<?php
session_start();
require_once 'conexion.php';

// 1. Verificar que el usuario esté logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../index.php");
    exit();
}

// 2. Verificar que se haya enviado un archivo
if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
    
    $id_usuario = $_SESSION['usuario_id'];
    
    // --- Validación del archivo ---
    $archivo_tmp = $_FILES['foto_perfil']['tmp_name'];
    $tipo_archivo = mime_content_type($archivo_tmp); // Comprueba el tipo real
    $tamano_archivo = $_FILES['foto_perfil']['size'];

    // Solo permitir imágenes JPEG o PNG
    if ($tipo_archivo == "image/jpeg" || $tipo_archivo == "image/png") {
        
        // Limitar tamaño a 5MB
        if ($tamano_archivo < 5000000) { 
            
            // --- Crear nombre y ruta únicos ---
            $extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
            $nombre_archivo_nuevo = "user_" . $id_usuario . "." . $extension;
            
            // Ruta de destino (subir un nivel desde 'core', entrar a 'assets/uploads/')
            $ruta_destino = "../uploads/" . $nombre_archivo_nuevo;

            // --- Mover el archivo ---
            if (move_uploaded_file($archivo_tmp, $ruta_destino)) {
                
                // --- Actualizar la Base de Datos ---
                $sql = "UPDATE usuarios SET foto_perfil = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nombre_archivo_nuevo, $id_usuario]);
                
                // Redirigir de vuelta al perfil
                header("Location: ../cursosApp/perfil.php?exito=1");
                exit();

            } else {
                header("Location: ../cursosApp/editar_perfil.php?error=Error al mover archivo");
                exit();
            }
        } else {
            header("Location: ../cursosApp/editar_perfil.php?error=Archivo demasiado grande (max 5MB)");
            exit();
        }
    } else {
        header("Location: ../cursosApp/editar_perfil.php?error=Tipo de archivo no permitido (solo JPG o PNG)");
        exit();
    }
} else {
    // Si no se subió nada o hubo un error
    header("Location: ../cursosApp/editar_perfil.php?error=No se seleccionó ningún archivo");
    exit();
}
?>