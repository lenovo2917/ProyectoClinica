
document.addEventListener("DOMContentLoaded", function () {
    var fechaCitaInput = document.getElementById("fechaCita");

    // Obtener la fecha actual
    var fechaActual = new Date();

    // Calcular la fecha mínima (actual)
    var fechaMinima = fechaActual.toISOString().split('T')[0];

    // Calcular la fecha máxima (20 días en el futuro)
    var fechaMaxima = new Date();
    fechaMaxima.setDate(fechaActual.getDate() + 20);
    var fechaMaximaStr = fechaMaxima.toISOString().split('T')[0];

    // Establecer los atributos min y max en el elemento de entrada de fecha
    fechaCitaInput.setAttribute("min", fechaMinima);
    fechaCitaInput.setAttribute("max", fechaMaximaStr);
});
