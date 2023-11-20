document.addEventListener("DOMContentLoaded", function () {
// Script para manejar pestañas
const tabLinks = document.querySelectorAll(".nav-link");
const tabPanes = document.querySelectorAll(".tab-pane");

tabLinks.forEach(link => {
    link.addEventListener("click", () => {
        tabPanes.forEach(pane => {
            pane.classList.remove("show", "active");
        });

        const targetPaneId = link.getAttribute("href").replace("#", "");
        const targetPane = document.getElementById(targetPaneId);
        targetPane.classList.add("show", "active");
    });
});
});

$(document).ready(function () {
    $("#crearCitaForm").submit(function (event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            // Evitar el envío predeterminado para manejarlo con AJAX
            event.preventDefault();

            // Resto del código AJAX aquí...
            $.ajax({
                type: "POST",
                url: "./herramientas/procesar_cita.php",
                data: $("#crearCitaForm").serialize(),
                success: function (response) {
                    console.log(response);
                    $("#crearCitaForm")[0].reset(); // Restablecer el formulario
                    $("#crearCitaForm").removeClass('was-validated'); // Quitar la clase de validación de Bootstrap
                },
                error: function (error) {
                    console.error(error);
                }
            });
        }

        // Marcar el formulario como validado
        $(this).addClass('was-validated');
    });
});
