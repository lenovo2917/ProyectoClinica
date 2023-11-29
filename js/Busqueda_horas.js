document.addEventListener("DOMContentLoaded", function () {
    // Manejar el primer formulario
    manejarFormulario("fechaCita", "hora", "../php/Horas_disponibles.php");

    // Manejar el segundo formulario
    manejarFormulario("fechaPacienteF", "horaPacienteF", "../php/Horas_disponiblesSe.php");

    // Función para manejar los eventos del formulario
    function manejarFormulario(idFecha, idHora, paginaPHP) {
        var fechaInput = document.getElementById(idFecha);
        var horaSelect = document.getElementById(idHora);

        if (fechaInput && horaSelect) {
            // Evento de cambio en la fecha
            fechaInput.addEventListener("change", function () {
                cargarHorasDisponibles(fechaInput, horaSelect, paginaPHP);
            });
        } else {
            console.error("Elementos no encontrados para el manejo del formulario.");
        }
    }

    // Función para cargar las horas disponibles mediante AJAX
    function cargarHorasDisponibles(fechaInput, horaSelect, paginaPHP) {
        // Obtener la fecha seleccionada
        var fechaSeleccionada = fechaInput.value;

        // Mostrar mensaje en la consola
        console.log("Fecha seleccionada:", fechaSeleccionada);

        // Realizar la solicitud AJAX para obtener las horas disponibles
        var xhr = new XMLHttpRequest();
        xhr.open("GET", paginaPHP + "?fecha=" + fechaSeleccionada, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                // Mostrar mensaje en la consola
                console.log("Respuesta del servidor:", xhr.responseText);

                if (xhr.status === 200) {
                    // Limpiar y cargar las nuevas opciones en el select de horas
                    horaSelect.innerHTML = xhr.responseText;
                } else {
                    // Mostrar mensaje en la consola si hay un problema con la solicitud
                    console.error("Error en la solicitud AJAX:", xhr.status, xhr.statusText);
                }
            }
        };

        // Enviar la solicitud AJAX
        xhr.send();
    }
});
