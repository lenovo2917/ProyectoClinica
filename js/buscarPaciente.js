document.addEventListener("DOMContentLoaded", function () {
    // Obtener el botón y el formulario
    var buscarPButton = document.getElementById('buscarP');
    var nombrePacienteInput = document.querySelector('[name="nombrePaciente"]');

    // Agregar un event listener al botón de búsqueda
    buscarPButton.addEventListener("click", function () {
        // Obtener el valor del nombre del paciente
        var nombrePaciente = nombrePacienteInput.value;

        // Realizar la lógica de búsqueda aquí
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/buscarPacienteS.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log(xhr.responseText); // Imprimir la respuesta en la consola
                var respuesta = JSON.parse(xhr.responseText);

                // Verificar si se encontró al paciente
                if (respuesta.hasOwnProperty('mensaje')) {
                    var mensajeContainer = document.getElementById('mensajeError');
                    mensajeContainer.innerHTML = '<div class="alert alert-warning" role="alert">' + respuesta.mensaje + '</div>';
                    alert(respuesta.mensaje); // Mostrar mensaje si el paciente no se encontró
                } else {
                    // Llenar los campos del formulario con los datos del paciente
                    document.getElementById('nombrePacienteF').value = respuesta.NombreCompletoP;
                    document.getElementById('curpPacienteF').value = respuesta.CURPP;
                    document.getElementById('alergiasPacienteF').value = respuesta.alergiasP;
                    document.getElementById('sangrePacienteF').value = respuesta.tipoSangreP;
                    // Otros campos de acuerdo a tu estructura de tabla
                    // ...
                }
            }
        };

        // Enviar la solicitud con el nombre del paciente
        xhr.send("nombrePaciente=" + encodeURIComponent(nombrePaciente));
    });
});
