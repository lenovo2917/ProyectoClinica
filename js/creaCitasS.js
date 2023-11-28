document.addEventListener("DOMContentLoaded", function () {
    var miFormulario = document.getElementById('citaForm');
    var fechaInput = document.getElementById('fechaPacienteF');
    var mensajeError = document.getElementById('mensajeError');

    miFormulario.addEventListener('submit', function (event) {

        var fechaSeleccionada = fechaInput.value;
        var fechaActual = new Date();
        var fechaLimite = new Date();
        fechaLimite.setDate(fechaLimite.getDate() + 20);

        var fechaSeleccionadaObj = new Date(fechaSeleccionada);

        if (fechaSeleccionadaObj < fechaActual) {
            mensajeError.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            '<i class="fa-solid fa-triangle-exclamation fa-sm" style="color: #7d0003;"></i>' +
            ' Error, seleccione una fecha valida.'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>';
            event.preventDefault();
        } else if (fechaSeleccionadaObj > fechaLimite) {

            
            mensajeError.innerHTML = '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            '<i class="fa-solid fa-triangle-exclamation fa-sm" style="color: #7d0003;"></i>' +
            ' Error, no puede crear una cita mayor a 20 dias.'+
            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
            '</div>';
            event.preventDefault();
        }
    });
});
