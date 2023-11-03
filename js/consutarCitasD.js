document.addEventListener('DOMContentLoaded', function () {
    // Agregar un evento de clic a los botones "Aceptar" por su clase
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("btn-aceptar")) {
            // Obtener el IDC de la cita desde el atributo data-id
            const citaID = event.target.getAttribute("data-id");

            // Realizar una solicitud al servidor para actualizar el estado de la cita
            // Puedes utilizar AJAX o Fetch para esto
            // Ejemplo con Fetch:
            fetch("../doctores/herramientas/actualizar_cita.php", {
                method: "POST",
                body: JSON.stringify({ citaID: citaID, estatus: "Aceptada" }),
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Actualizar el estado en la tabla o realizar otras acciones necesarias
                    event.target.disabled = true; // Deshabilitar el botón después de aceptar
                } else {
                    // Manejar errores si es necesario
                    alert("Error al aceptar la cita.");
                }
            });
        } else if (event.target.classList.contains('btn-trasladar')) {
            // Obtener el IDC de la cita desde el atributo data-cita-id
            const citaID = event.target.getAttribute('data-cita-id');
            $('#miModal').modal('show');

            // Adjuntar un evento de clic al botón "Guardar Cambios"
            document.getElementById('guardarCambios').addEventListener('click', function () {
                const doctorID = document.getElementById('doctorSelect').value;
                if (doctorID) {
                    // Realizar una solicitud al servidor para trasladar al paciente
                    $.ajax({
                        method: 'POST',
                        url: '../doctores/herramientas/trasladar_paciente.php',
                        data: {
                            citaID: citaID,
                            doctorID: doctorID
                        },
                        success: function (response) {
                            console.log("Clic en Guardar Cambios");
                            console.log("Respuesta del servidor: " + response);
                            // Puedes agregar más lógica aquí si es necesario
                            $('#miModal').modal('hide');
                        },
                        error: function () {
                            console.log('Error en la solicitud al servidor.');
                            // Puedes manejar errores aquí si es necesario
                        }
                    });
                } else {
                    console.log('Por favor, seleccione un médico antes de guardar los cambios.');
                    // Puedes mostrar mensajes de error aquí si es necesario
                }
            });
        }
    });

    // Agrega este código al final
    $('#miModal').on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
});
