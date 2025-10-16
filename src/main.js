$(document).ready(function(){
    $("#formInsertMovies").on("submit",function(event){
        
        event.preventDefault();
        submitlevels($(this));
        
    });

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
            // complete:function()
            });

    }

   
    // toast("Hola", "success", 5000, "top-end");
    // setTimeout(()=>{
    //     toast ("Adios","error",5000, "top-start");
    // }),6000
    
    function toast(titleToast,iconToast,timeToast,positionToast) {
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


});
