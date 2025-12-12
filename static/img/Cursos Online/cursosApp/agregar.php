<?php
require_once 'includes/auth_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curso Online</title>
    <link rel="stylesheet" href="../style/estilo_base.css">
    <link rel="stylesheet" href="../style/estilo_registrar.css">
</head>
<body>
    
    <?php require_once 'includes/navbar.php'; ?>
    <hr>
    <form action="../core/procesar.php" method="post">
        <h2>Gestion de Cursos</h2>

        <input type="hidden" name="accion" value="registrar">


        <label for="nombre">Nombre del Curso:</label>
        <input type="text" id="nombre" name="nombre_curso" required>
        <br><br>
        <label>instructor:</label>
        <input type=text id="descripcion" name="instructor" required></textarea>
        <br><br>
        <label>Costo:</label>
        <input type="text" id="duracion" name="costo" required>
        <br><br>
        <label>Numero de horas:</label>
        <input type="text" id="duracion" name="horas" required>
        <br><br>
        <button type="submit">Agregar Curso</button>

        <a href="mostrar.php">Ver cursos</a>
    </form>
</body>
</html>