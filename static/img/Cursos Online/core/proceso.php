<?php
session_start(); 

require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // --- LÓGICA DE REGISTRO ---
    // --- LÓGICA DE REGISTRO CON FOTO OBLIGATORIA ---
    if (isset($_POST['accion']) && $_POST['accion'] == 'registrar') {
        
        // 1. VALIDAR IMAGEN PRIMERO
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
            
            $archivo_tmp = $_FILES['foto_perfil']['tmp_name'];
            $tipo_archivo = mime_content_type($archivo_tmp);
            $tamano_archivo = $_FILES['foto_perfil']['size'];
            $extension = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);

            // Validaciones (Tipo y Tamaño)
            if (($tipo_archivo == "image/jpeg" || $tipo_archivo == "image/png") && $tamano_archivo < 5000000) {
                
                try {
                    // 2. INSERTAR USUARIO (Aun sin la foto, para conseguir el ID)
                    $password_hasheada = password_hash($_POST['password'], PASSWORD_DEFAULT);
                    
                    // Insertamos nombre, user y pass. Foto se queda NULL un segundo.
                    $sql = "INSERT INTO usuarios (nombre, username, password) VALUES (?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        $_POST['nombre'],
                        $_POST['username'],
                        $password_hasheada
                    ]);
                    
                    // 3. OBTENER EL ID DEL NUEVO USUARIO
                    $id_nuevo_usuario = $pdo->lastInsertId();

                    // 4. RENOMBRAR Y MOVER LA IMAGEN
                    // Nombre final: user_ID.jpg
                    $nombre_foto_final = "user_" . $id_nuevo_usuario . "." . $extension;
                    $ruta_destino = "../uploads/" . $nombre_foto_final;

                    if (move_uploaded_file($archivo_tmp, $ruta_destino)) {
                        
                        // 5. ACTUALIZAR LA BD CON EL NOMBRE DE LA FOTO
                        $sql_update = "UPDATE usuarios SET foto_perfil = ? WHERE id = ?";
                        $stmt_update = $pdo->prepare($sql_update);
                        $stmt_update->execute([$nombre_foto_final, $id_nuevo_usuario]);

                        // ¡ÉXITO! Redirigir al login (o loguearlo directamente)
                        header("Location: ../index.php"); // O login.php
                        exit;

                    } else {
                        // Si falla al mover la imagen, borramos al usuario para no dejar registros "rotos"
                        $pdo->query("DELETE FROM usuarios WHERE id = $id_nuevo_usuario");
                        header("Location: ../registro.php?error=Error al guardar la imagen en el servidor");
                        exit;
                    }

                } catch (PDOException $e) {
                    // Error de base de datos (ej. usuario duplicado)
                    header("Location: ../registro.php?error=Error en base de datos: " . $e->getMessage());
                    exit;
                }

            } else {
                header("Location: ../registro.php?error=La imagen debe ser JPG/PNG y menor a 5MB");
                exit;
            }
        } else {
            header("Location: ../registro.php?error=Debes subir una foto de perfil obligatoriamente");
            exit;
        }
    }

    // --- LÓGICA DE LOGIN (NUEVA) ---
    if (isset($_POST['accion']) && $_POST['accion'] == 'login') {
        
        $username = $_POST['usuario'];
        $password_ingresada = $_POST['contrasena'];
        
        $sql = "SELECT * FROM usuarios WHERE username = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password_ingresada, $usuario['password'])) {
            // ¡Éxito! Guardar en la sesión
            // ESTANDARIZAMOS: Usaremos 'usuario_id' en toda la app
            $_SESSION['usuario_id'] = $usuario['id']; 
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            
            // CORRECCIÓN: Redirigir a la app, no a la raíz
            header("Location: ../index.php");
            exit;
        } else {
            // Error, redirigir de vuelta al login
            header("Location: ../login.php?error=1");
            exit;
        }
    }
}
?>