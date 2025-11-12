$(document).ready(function () {
    $("form").submit(function (event) {
        event.preventDefault();
        const actionForm = $(this).attr("action");

        switch (actionForm) {
            case "login":
                login(this);
                break;
            case "insertLevel":
                insertLevel(this);
                break;

            default:
                break;
        }
    });

    function login(form) {
        const formData = new FormData(form);
        const jsonData = Object.fromEntries(formData.entries());

        $.ajax({
            url: "../php/login.php",
            type: "POST",
            data: JSON.stringify(jsonData),
            processData: false,
            contentType: "application/json",
            dataType: "json",
            success: function (response) {
                console.log(response);
                alert("correcto");
            },
            error: function (xhr, status, error, response) {
                // const errorData = xhr.responseJSON.json || {};
                alert("Error");
                toast({
                    icon: "error",
                    title: `Error al intentar iniciar sesión. <br><br> ${errorData.message || "Error desconocido"} <br> Código ${xhr.status}`,
                    time: 5000,
                    position: "center",
                });
                console.error("--- Este es el error resultante de ajax ---");
                console.error(xhr);
            },
        });
    }

    function insertLevel(form) {
        const formData = new FormData(form);
        const jsonData = Object.fromEntries(formData.entries());

        $.ajax({
            url: "php/insertLevel.php",
            type: "POST",
            data: JSON.stringify(jsonData),
            processData: false,
            contentType: "application/json",
            dataType: "json",
            success: function (response) {
                $(form)[0].reset();
                getLevels();

                toast({
                    icon: "success",
                    title: `Se registro una clasificacion correctamente`,
                    time: 2000,
                    position: "top-end",
                });
            },
            error: function (xhr, status, error, response) {
                const errorData = xhr.responseJSON.json || {};
                toast({
                    icon: "error",
                    title: `Error al intentar registrar la clasificacion. <br><br> ${errorData.message || "Error desconocido"} <br> Código ${xhr.status}`,
                    time: 5000,
                    position: "center",
                });
                console.error("--- Este es el error resultante de ajax ---");
                console.error(xhr.status, errorData);
            },
        });
    }

    $("#btnShowPass").click(function () {
        const inputPass = $(this).data("input");
        const type = $(inputPass).attr("type") === "text" ? "password" : "text";

        $(inputPass).attr("type", type);
        $(this).toggleClass("fa-eye fa-eye-slash");
    });
});