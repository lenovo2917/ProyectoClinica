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
                    location.reload(); // Recargar la página después de aceptar
                } else {
                    alert("Error al aceptar la cita.");
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
                    location.reload(); // Recargar la página después de rechazar
                } else {
                    alert("Error al rechazar la cita.");
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
                    location.reload(); // Recargar la página después de cancelar
                } else {
                    alert("Error al cancelar la cita.");
                }
            });
        } else if (event.target.classList.contains('btn-trasladar')) {
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
});
