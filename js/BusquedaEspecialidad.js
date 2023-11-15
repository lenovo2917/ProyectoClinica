document.addEventListener("DOMContentLoaded", function () {
    // Obtener las opciones de especialidades al cargar la página
    obtenerEspecialidades();

    // Obtener referencia a los elementos del formulario
    var fechaInput = document.getElementById("fechaCita");
    var especialidadSelect = document.getElementById("especialidadCita");
    var horaSelect = document.getElementById("horaCita");

    // Evento de cambio en la fecha o especialidad
    fechaInput.addEventListener("change", cargarHorasDisponibles);
    especialidadSelect.addEventListener("change", cargarHorasDisponibles);

    // Función para obtener las especialidades mediante AJAX
    function obtenerEspecialidades() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../doctores/herramientas/obtener_especialidades.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                especialidadSelect.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }

    // Función para cargar las horas disponibles mediante AJAX
    function cargarHorasDisponibles() {
        // Obtener valores seleccionados
        var fechaSeleccionada = fechaInput.value;
        var especialidadSeleccionada = especialidadSelect.value;

        // Realizar la solicitud AJAX para obtener las horas disponibles
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../doctores/herramientas/obtener_horas_disponibles.php?fecha=" + fechaSeleccionada + "&especialidad=" + especialidadSeleccionada, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Limpiar y cargar las nuevas opciones en el select de horas
                horaSelect.innerHTML = xhr.responseText;
                console.log("Horas disponibles cargadas correctamente:", xhr.responseText);

            }
        };

        xhr.send();
    }
});

