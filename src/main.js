$(document).ready(function(){
    $("#formInsertMovies").on("submit",function(event){
        
        event.preventDefault();
        submitlevels($(this));
        
    });

    const levelsContainer =$("#levelsDatas");
    if (levelsContainer.length > 0){
        getLevels(levelsContainer);
    }

    function submitlevels(form){
        const levelVal=$(form).find("#ClasId").val();
        const nivelData= {
            ClasificacionDesc: levelVal,
        
        };
        const myApiToken= "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1laWQiOiJDVVJTTyIsInJvbGUiOiJBZG1pbiIsIm5iZiI6MTc2MDQ3NzUyNywiZXhwIjoxNzYwNTYzOTI3LCJpYXQiOjE3NjA0Nzc1MjcsImlzcyI6IkNpbmVtYSJ9.a-UxerUzwrE4lqXAj-cEOZGLbYGqC-YRQyEE5Rmp0j0";
        

        $.ajax({
            url: "http://localhost:5254/api/Clasificacion/RegistrarClasificacion", 
            type: "POST",  
            headers:{
                Authorization: "Bearer " + myApiToken,
            },
            contentType:"application/json",
            data: JSON.stringify(nivelData),
                      // Tipo de petición: GET o POST
            success: function(respuesta) {
                const msg = respuesta.message

                // Se ejecuta si la petición fue exitosa
                console.log("Respuesta del servidor:", respuesta);
                // alert(respuesta.mensaje)
                toast(msg, "success",5000,"top-end")
                variableIndefinida=1;
            },
            error: function(xhr, estado, error) {
                toast(error, "error",5000,"top-center")
                console.error("Error en la petición:", error);
            },
        });
    }

    function submitMovies(form) {
        const formData = new FormData(form[0]);
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        }); // <-- CORRECCIÓN: El '}' estaba mal puesto aquí.

        console.log("Datos de película (JSON):", jsonData);
        
        // --- ¡ACCIÓN FALTANTE! ---
        // Aquí necesitas una llamada $.ajax() para ENVIAR 'jsonData'
        // a tu API de películas, similar a como lo haces en submitlevels.
        /*
        $.ajax({
            url: "http://localhost:5254/api/Peliculas/RegistrarPelicula", // URL de ejemplo
            type: "POST",
            headers: { Authorization: "Bearer " + myApiToken },
            contentType: "application/json",
            data: JSON.stringify(jsonData),
            success: function(respuesta) {
                toast(respuesta.message, "success", 5000, "top-end");
            },
            error: function(xhr, estado, error) {
                toast(error, "error", 5000, "top-center");
            }
        });
        */
    }


    function getLevels($container) {
        $.ajax({
            url: "http://localhost:5254/api/Clasificacion/ObtenerClasificaciones",
            type: "GET",
            headers: {
                Authorization: "Bearer " + myApiToken,
            },
            success: function(respuesta) {
                console.log(respuesta.data[0]);
                $container.empty(); 
                    $($container).append(
                        respuesta.data.map((level)=>{
                        return `<div>${level.ClasificacionDesc}</div>`;
                        })
                    );
                    
                }
             }

    /**
     * Función de utilidad para mostrar notificaciones (toast).
     */
    function toast(titleToast, iconToast, timeToast, positionToast) {
        const Toast = Swal.mixin({
            toast: true,
            position: positionToast,
            showConfirmButton: false,
            timer: timeToast,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        
        });
        Toast.fire({
            icon: iconToast,
            title: titleToast
        });
    }


    const fName = "Dante";
    const numOne= 1;
    const LName ="Rodriguez";
    const numTwo = "2";
    const numTre= 3;

    let operation;

    operation = fName + LName 

    toast(operation, "info", 8000, "center")
});
