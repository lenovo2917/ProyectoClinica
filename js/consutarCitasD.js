
document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener("click", function(event) {
        if (event.target.classList.contains("btn-aceptar")) {
            const citaID = event.target.getAttribute("data-id");
        
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
                    event.target.disabled = true;
                    localStorage.setItem('alert', 'success'); // Almacenar el tipo de alerta
                    location.reload(); // Recargar la página después de aceptar
                } else {
                    localStorage.setItem('alert', 'error'); // Almacenar el tipo de alerta
                    location.reload(); // Recargar la página después de aceptar
                }
            });
        } else if (event.target.classList.contains("btn-rechazar")) {
            const citaID = event.target.getAttribute("data-id");
        
            fetch("../doctores/herramientas/actualizar_cita.php", {
                method: "POST",
                body: JSON.stringify({ citaID: citaID, estatus: "rechazada" }),
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    event.target.disabled = true;
                    localStorage.setItem('alert', 'rejected'); // Almacenar el tipo de alerta
                    location.reload(); // Recargar la página después de rechazar
                } else {
                    localStorage.setItem('alert', 'error'); // Almacenar el tipo de alerta
                    location.reload(); // Recargar la página después de rechazar
                }
            });
        } else if (event.target.classList.contains("btn-Cancelar")) {
            const citaID = event.target.getAttribute("data-id");
        
            fetch("../doctores/herramientas/actualizar_cita.php", {
                method: "POST",
                body: JSON.stringify({ citaID: citaID, estatus: "Cancelada" }),
                headers: {
                    "Content-Type": "application/json"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    event.target.disabled = true;
                    localStorage.setItem('alert', 'cancelled'); // Almacenar el tipo de alerta
                    location.reload(); // Recargar la página después de cancelar
                } else {
                    localStorage.setItem('alert', 'error'); // Almacenar el tipo de alerta
                    location.reload(); // Recargar la página después de cancelar
                }
            });
        }else if (event.target.classList.contains('btn-trasladar')) {
            const citaID = event.target.getAttribute('data-cita-id');
            $('#miModal').modal('show');

            document.getElementById('miFormulario').addEventListener('submit', function (event) {
                event.preventDefault();

                const fechaCita = document.getElementById('fechaCita').value;
                const especialidadCita = document.getElementById('especialidadCita').value;
                const doctorCita = document.getElementById('doctorCita').value;
                const horaCita = document.getElementById('horaCita').value;

                if (doctorCita) {
                    $.ajax({
                        method: 'POST',
                        url: '../doctores/herramientas/trasladar_paciente.php',
                        data: {
                            citaID: citaID,
                            fechaCita: fechaCita,
                            especialidadCita: especialidadCita,
                            doctorCita: doctorCita,
                            horaCita: horaCita
                        },
                        success: function (response) {
                            console.log("Clic en Guardar Cambios");
                            console.log("Respuesta del servidor: " + response);
                            $('.modal-body').html(`
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <strong>¡Paciente trasladado correctamente!</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `);
                        },                        
                        error: function () {
                            $('.modal-body').html(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error al Trasladar, intente nuevamente.</strong> 
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                        }
                    });
                }
            });
        }
    });
  // Al cargar la página
var alertType = localStorage.getItem('alert'); // Obtener el tipo de alerta
if (alertType) {
    var alertMessage;
    var alertColor;
    if (alertType === 'success') {
        alertMessage = '¡Éxito! La cita ha sido aceptada.';
        alertColor = 'success';
    } else if (alertType === 'rejected') {
        alertMessage = 'La cita ha sido rechazada con éxito.';
        alertColor = 'warning';
    } else if (alertType === 'cancelled') {
        alertMessage = 'La cita ha sido cancelada con éxito.';
        alertColor = 'danger';
    } else if (alertType === 'error') {
        alertMessage = 'Error! Hubo un error al procesar la cita.';
        alertColor = 'danger';
    }
    $('.alerta').append(`
        <div class="alert alert-${alertColor} alert-dismissible fade show" role="alert">
            <strong>${alertMessage}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);
    localStorage.removeItem('alert'); // Eliminar el tipo de alerta del almacenamiento local
}



    const nombrePacienteInput = document.getElementById('nombrePaciente');
    const limpiarFiltrosButton = document.getElementById('limpiarFiltrosButton');

    limpiarFiltrosButton.addEventListener('click', function () {
        nombrePacienteInput.value = '';
        document.querySelector('form').submit();
    });

    $('#miModal').on('hidden.bs.modal', function () {
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
    // Evento que se ejecuta cuando se cierra el modal de trasladar
$('#miModal').on('hidden.bs.modal', function () {
    // Recarga la página al cerrar el modal de trasladar
    location.reload();
});
});
