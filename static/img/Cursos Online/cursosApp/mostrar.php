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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Cursos</title>
    <link rel="stylesheet" href="../style/estilo_base.css">
    <link rel="stylesheet" href="../style/estilo_mostrar.css">
</head>
<body>

     <?php require_once 'includes/navbar.php'; ?> 
    <div class="container">
        <div class="header">
            <h2>🗂️ Listado de Cursos Registrados</h2>
            <a href="../index.php" class="btn-nuevo">Ir al Inicio</a>
            <a href="agregar.php" class="btn-nuevo">🆕 Registrar Nuevo Curso</a>
            <a href="../logout.php" class="btn-logout">Cerrar sesion</a>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Curso</th>
                        <th>Instructor</th>
                        <th>Costo</th>
                        <th>Número de Horas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../core/conexion.php';
                    $sql = "SELECT * FROM cursos";
                    $resultado = $pdo->query($sql);

                    if ($resultado->rowCount() > 0) {
                        while ($curso = $resultado->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($curso['Id']) . "</td>";
                            echo "<td>" . htmlspecialchars($curso['nombre_curso']) . "</td>";
                            echo "<td>" . htmlspecialchars($curso['instructor']) . "</td>";
                            echo "<td>$" . htmlspecialchars($curso['costo']) . "</td>";
                            echo "<td>" . htmlspecialchars($curso['horas']) . " hrs</td>";
                            echo "<td>
                                    <form action='editar.php' method='get' style='display:inline;'>
                                        <input type='hidden' name='id' value='{$curso['Id']}'>
                                        <button type='submit' class='btn-editar'>✏ Editar</button>
                                    </form>
                                    <form action='../core/procesar.php' method='post' style='display:inline;'>
                                        <input type='hidden' name='accion' value='eliminar'>
                                        <input type='hidden' name='id' value='{$curso['Id']}'>
                                        <button type='submit' class='btn-eliminar' onclick='return confirm(\"¿Estás seguro de eliminar este curso?\")'>🗑 Eliminar</button>
                                    </form>
                                </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='empty-state'>
                                <div class='empty-state-icon'>📭</div>
                                <div class='empty-state-text'>No hay cursos registrados aún</div>
                              </td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>