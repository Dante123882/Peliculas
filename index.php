<?php include 'componentes.php'; ?>


<!DOCTYPE html>
<html lang="en">

<head> 
   <?php 
        $title = "inicio | Proyecto peliculas";
        headContent($title);
   ?>
</head>

<body class="container container-fluid">

    <section class="d-grid" heigh="1000vh">
        <form class="card" id="formInsertMovies">
            <div class="card-body">
                <h5 class="card-title text-center">Peliculas</h5>
                <hr>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="nameMovie" class="form-control" />
                    <label class="form-label" for="nameMoviE">Nombre</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="nameAuthor" class="form-control" />
                    <label class="form-label" for="nameAuthor">Director</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="timeMovie" class="form-control" />
                    <label class="form-label" for="timeMovie">Duracion</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="genderMovie" class="form-control" />
                    <label class="form-label" for="genderMovie">Genero</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="dateMovie" class="form-control" />
                    <label class="form-label" for="dateMovie">Fecha de lanzamiento</label>
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="ClasId" name="ClasId"/>
                    <label class="form-label" for="ClasId">Clasficacion</label>
                 
                </div>


                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block" id="submit" name="submit">Sign in</button>
            </div>
        </form>
    </section>

   
    <?php scriptContent()?>
</body>

</html>