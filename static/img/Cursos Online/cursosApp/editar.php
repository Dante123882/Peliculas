<?php
session_start(); // Inicia la sesión


// Si la variable de sesión 'id_usuario' no existe, significa que no ha iniciado sesión
if (!isset($_SESSION['usuario_id'])) { 
    // Redirige al usuario al login (que ahora está en la raíz, fuera de la carpeta 'app/')
    header("Location: ../index.php");
    exit(); // Detiene la ejecución del script
}

require_once '../core/conexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cursos WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $curso = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Curso</title>
    <link rel="stylesheet" href="../style/estilo_base.css">
    <link rel="stylesheet" href="../style/estilo_editar.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <?php require_once 'includes/navbar.php'; ?>
    <form action="../core/procesar.php" method="post">
        
        <h2>✒️ Editar Curso </h2> <input type="hidden" name="accion" value="editar">
        <input type="hidden" name="id" value="<?php echo isset($curso['Id']) ? htmlspecialchars($curso['Id']) : ''; ?>">

        <div>
            <label for="nombre">Nombre del curso:</label>
            <input type="text" id="nombre" name="nombre_curso" value="<?php echo isset($curso['nombre_curso']) ? htmlspecialchars($curso['nombre_curso']) : ''; ?>" required>
        </div>

        <div>
            <label for="instructor">Instructor:</label>
            <input type="text" id="instructor" name="instructor" value="<?php echo isset($curso['instructor']) ? htmlspecialchars($curso['instructor']) : ''; ?>" required>
        </div>

        <div>
            <label for="costo">Costo:</label>
            <input type="text" id="costo" name="costo" value="<?php echo isset($curso['costo']) ? htmlspecialchars($curso['costo']) : ''; ?>" required>
        </div>

        <div>
            <label for="horas">Número de horas:</label>
            <input type="text" id="horas" name="horas" value="<?php echo isset($curso['horas']) ? htmlspecialchars($curso['horas']) : ''; ?>" required>
        </div>

        <div class="form-actions">
            <button type="submit">Guardar Cambios</button>
            <a href="mostrar.php" class="button-link">Cancelar</a>
        </div>
    </form>
</body>
</html>