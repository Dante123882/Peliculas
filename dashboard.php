<?php
    include 'php/components.php';
    include 'php/session.php';
?>
<!DOCTYPE html>
<html lang="es" data-mdb-theme="light">
    <head>
        <?php headContent("Administracion de Peliculas"); ?>
    </head>
    <body>
        <nav class="nav-session">
           <span>Peliculas</span>

        </nav>

        <div>
            <h1>Registrar Clasificaciones</h1>
            <input type="text" placeholder="Descripción">
            <button>Agregar</button>
        </div>
        
        <div>
            <th>
                <tr></tr>
            </th>
        </div>
    
        <h1>Administrar Peliculas</h1>
        <h2>Bienvenido <?php echo $_SESSION['username'] ?></h2>


        <?php footerScripts(); ?>
    </body>
</html>