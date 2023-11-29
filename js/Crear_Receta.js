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

    // Seleccionar la pestaña basada en el parámetro 'tab' de la URL
    const url = new URL(window.location.href);
    const tab = url.searchParams.get("tab");
    if (tab) {
        const targetLink = document.querySelector('.nav-link[href="#' + tab + '"]');
        if (targetLink) {
            targetLink.click();
        }
    }
});
$(document).ready(function () {
    $("#crearCitaForm").submit(function (event) {
        if (this.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
              // Evitar el envío predeterminado para manejarlo con AJAX
              event.preventDefault();

              // Obtener todos los datos del formulario
              var formData = $("#crearCitaForm").serializeArray();
              var dataObject = {};
              $.each(formData, function (index, element) {
                  dataObject[element.name] = element.value;
              });
  
              // Imprimir los datos en la consola para verificar
              console.log(dataObject);

            // Resto del código AJAX aquí...
            $.ajax({
                type: "POST",
                url: "./herramientas/procesar_cita.php",
                data: $("#crearCitaForm").serialize(),
                success: function (response) {
                    console.log(response);

                    // Resetea el formulario y quitar la clase de validación de Bootstrap
                    $("#crearCitaForm")[0].reset();
                    $("#crearCitaForm").removeClass('was-validated');

                    // Mostrar la alerta según la respuesta del servidor
                    if (response.includes("exitosamente")) {
                        $(".alerta").html(`
                        <div class="alert alert-primary alert-success fade show" role="alert">
                            <strong>¡Cita creada con éxito!</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    } else {
                        $(".alerta").html('<div class="alert alert-danger alert-dismissible fade show" role="alert">' 
                        + response +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    }
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
