document.addEventListener("DOMContentLoaded", function () {
    var miFormulario = document.getElementById('miFormulario');
    var fechaInput = document.getElementById('fecha');
    var mensajeError = document.getElementById('mensajeError');

    miFormulario.addEventListener('submit', function (event) {
        event.preventDefault();

        var fechaSeleccionada = fechaInput.value;
        var fechaActual = new Date();
        var fechaLimite = new Date();
        fechaLimite.setDate(fechaLimite.getDate() + 20);

        var fechaSeleccionadaObj = new Date(fechaSeleccionada);

        if (fechaSeleccionadaObj < fechaActual) {
            // La fecha está en el pasado
            mensajeError.innerHTML = '<div class="alert alert-danger" role="alert">No puedes seleccionar una fecha en el pasado.</div>';
        } else if (fechaSeleccionadaObj > fechaLimite) {
            // La fecha es mayor a 20 días a partir de hoy
            mensajeError.innerHTML = '<div class="alert alert-danger" role="alert">No puedes seleccionar una fecha mayor a 20 días desde hoy.</div>';
        } else {
            // La fecha es válida, puedes realizar otras acciones aquí si lo deseas
            mensajeError.innerHTML = ''; // Limpiar el mensaje de error si todo está bien
        }
    });
});
