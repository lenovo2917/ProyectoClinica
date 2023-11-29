document.addEventListener("DOMContentLoaded", function () {
    // Función para configurar las restricciones de fecha
    function configurarRestriccionesFecha(idCampoFecha) {
        // Obtener el campo de fecha por su ID
        var fechaInput = document.getElementById(idCampoFecha);

        // Verificar si el campo de fecha existe antes de agregar las restricciones
        if (fechaInput) {
            // Obtener la fecha actual
            var fechaActual = new Date();

            // Calcular la fecha mínima (actual)
            var fechaMinima = fechaActual.toISOString().split('T')[0];

            // Calcular la fecha máxima (20 días en el futuro)
            var fechaMaxima = new Date();
            fechaMaxima.setDate(fechaActual.getDate() + 20);
            var fechaMaximaStr = fechaMaxima.toISOString().split('T')[0];

            // Establecer los atributos min y max en el elemento de entrada de fecha
            fechaInput.setAttribute("min", fechaMinima);
            fechaInput.setAttribute("max", fechaMaximaStr);
        }
    }

    // Configurar restricciones de fecha para el formulario con ID "fechaCita"
    configurarRestriccionesFecha("fechaCita");

    // Configurar restricciones de fecha para el formulario con ID "fechaPacienteF"
    configurarRestriccionesFecha("fechaPacienteF");
});
