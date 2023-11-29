document.addEventListener("DOMContentLoaded", function () {
    var fechaInput = document.getElementById("fechaCita");
    var horaSelect = document.getElementById("hora");

    // Evento de cambio en la fecha
    fechaInput.addEventListener("change", cargarHorasDisponibles);

    // Función para cargar las horas disponibles mediante AJAX
    function cargarHorasDisponibles() {
        // Obtener la fecha seleccionada
        var fechaSeleccionada = fechaInput.value;

        // Mostrar mensaje en la consola
        console.log("Fecha seleccionada:", fechaSeleccionada);

        // Realizar la solicitud AJAX para obtener las horas disponibles de los médicos generales
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../php/Horas_disponibles.php?fecha=" + fechaSeleccionada, true);

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