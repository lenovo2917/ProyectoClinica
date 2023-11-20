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
        } else if (event.target.classList.contains("btn-rechazar")) {
            // Obtener el IDC de la cita desde el atributo data-id
            const citaID = event.target.getAttribute("data-id");

            // Realizar una solicitud al servidor para actualizar el estado de la cita
            // Puedes utilizar AJAX o Fetch para esto
            // Ejemplo con Fetch:
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
                    // Actualizar el estado en la tabla o realizar otras acciones necesarias
                    event.target.disabled = true; // Deshabilitar el botón después de aceptar
                } else {
                    // Manejar errores si es necesario
                    alert("Error al aceptar la cita.");
                }
            });
        } else if (event.target.classList.contains("btn-Cancelar")) {
            // Obtener el IDC de la cita desde el atributo data-id
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
                const fechaCita = document.getElementById('fechaCita').value;
        const especialidadCita = document.getElementById('especialidadCita').value;
        const doctorCita = document.getElementById('doctorCita').value;
        const horaCita = document.getElementById('horaCita').value;

        // Mostrar los datos antes de enviar la solicitud
        console.log("Cita ID:", citaID);
        console.log("Fecha de la Cita:", fechaCita);
        console.log("Especialidad de la Cita:", especialidadCita);
        console.log("Doctor de la Cita:", doctorCita);
        console.log("Hora de la Cita:", horaCita);

                if (doctorCita) {
                    // Realizar una solicitud al servidor para trasladar al paciente
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
                            ;// Puedes agregar más lógica aquí si es necesario
                            // $('#miModal').modal('hide')
                            $('.modal-body').html('<p>Cambios realizados</p>'); // Agrega un mensaje en el modal
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


    // Agregar código para el botón "Buscar" y "Borrar filtros"
    const buscarButton = document.getElementById('buscarButton');
    const nombrePacienteInput = document.getElementById('nombrePaciente');
    const nombrePacienteError = document.getElementById('nombrePacienteError');
    const limpiarFiltrosButton = document.getElementById('limpiarFiltrosButton');

    // Agregar un evento de clic al botón "Buscar"
    buscarButton.addEventListener('click', function (event) {
        if (nombrePacienteInput.value.trim() === '') {
            event.preventDefault(); // Evita que el formulario se envíe
            nombrePacienteError.classList.remove('d-none'); // Muestra la alerta
        } else {
            nombrePacienteError.classList.add('d-none'); // Oculta la alerta si el campo no está vacío
        }
    });

    // Agregar un evento de clic al botón "Borrar filtros"
    limpiarFiltrosButton.addEventListener('click', function () {
        // Limpia los valores de los campos de búsqueda
        nombrePacienteInput.value = ''; // Limpia el campo de nombre
        // Envía el formulario para volver a cargar todas las citas sin filtros
        document.querySelector('form').submit();
    });

   
});
