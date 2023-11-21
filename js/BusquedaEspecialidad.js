document.addEventListener("DOMContentLoaded", function () {
    // Obtener referencia al elemento select de doctores
    var doctorSelect = document.getElementById("doctorCita");
    var fechaInput = document.getElementById("fechaCita");
    var especialidadSelect = document.getElementById("especialidadCita");
    var horaSelect = document.getElementById("horaCita");

    // Evento de cambio en la fecha
    fechaInput.addEventListener("change", function () {
        obtenerEspecialidades();
       
    });

    // Evento de cambio en la especialidad
    especialidadSelect.addEventListener("change", obtenerDoctores);

    // Evento de cambio en el doctor
    doctorSelect.addEventListener("change", cargarHorasDisponibles);

    // Función para obtener las especialidades mediante AJAX
    function obtenerEspecialidades() {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../doctores/herramientas/obtener_especialidades.php", true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                especialidadSelect.innerHTML = xhr.responseText;

                // Llamar a la función para obtener los nombres de los doctores
                obtenerDoctores();
            }
        };

        xhr.send();
    }

    // Nueva función para obtener los nombres de los doctores
    function obtenerDoctores() {
        var especialidadSeleccionada = especialidadSelect.value;

        // Realizar la solicitud AJAX para obtener los nombres de los doctores
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../doctores/herramientas/obtener_doctores.php?especialidad=" + especialidadSeleccionada, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Limpiar y cargar las nuevas opciones en el select de doctores
                doctorSelect.innerHTML = xhr.responseText;

                cargarHorasDisponibles();
            }
        };

        xhr.send();
    }

    // Función para cargar las horas disponibles mediante AJAX
    function cargarHorasDisponibles() {
        // Obtener valores seleccionados
        var fechaSeleccionada = fechaInput.value;
        var especialidadSeleccionada = especialidadSelect.value;
        var doctorSeleccionado = doctorSelect.value;

        // Realizar la solicitud AJAX para obtener las horas disponibles
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "../doctores/herramientas/obtener_horas_disponibles.php?fecha=" + fechaSeleccionada + "&especialidad=" + especialidadSeleccionada + "&doctor=" + doctorSeleccionado, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Limpiar y cargar las nuevas opciones en el select de horas
                horaSelect.innerHTML = xhr.responseText;
            }
        };

        xhr.send();
    }
});
