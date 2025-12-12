<?php
require_once 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST['accion'];

    if ($accion == 'registrar') {
        $sql = "INSERT INTO cursos (nombre_curso, instructor, costo, horas) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt ->execute([
            $_POST['nombre_curso'],
            $_POST['instructor'],
            $_POST['costo'],
            $_POST['horas']
        ]);
        header("Location: ../cursosApp/mostrar.php");
        exit();
    }

 if ($accion == 'editar') {
    $sql = "UPDATE cursos SET nombre_curso = ?, instructor = ?, costo = ?, horas = ? WHERE id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['nombre_curso'],
        $_POST['instructor'],
        $_POST['costo'],
        $_POST['horas'],
        $_POST['id'] 
    ]);
    
    
    header("Location: ../cursosApp/mostrar.php");
    exit();
}

    if ($accion == 'eliminar') {
        $sql = "DELETE FROM cursos WHERE Id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['id']]);
        header("Location: ../cursosApp/mostrar.php");
        exit();
    }


}