document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('buscarPaciente').addEventListener("click", function () {
        // Obtener el valor del input de nombrePaciente
        var nombrePaciente = document.querySelector('[name="nombrePaciente"]').value;

        // Hacer una solicitud AJAX al archivo PHP para buscar al paciente
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../php/buscarPacienteS.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var respuesta = JSON.parse(xhr.responseText);

                // Verificar si se encontró al paciente
                if (respuesta.hasOwnProperty('mensaje')) {
                    alert(respuesta.mensaje); // Mostrar mensaje si el paciente no se encontró
                } else {
                    // Llenar los campos del formulario con los datos del paciente
                    document.querySelector('[name="nombrePacienteResultado"]').value = respuesta.nombre;
                    document.getElementById('curpResultado').value = respuesta.curp;
                    document.getElementById('edadResultado').value = respuesta.edad;
                    document.getElementById('sintomasResultado').value = respuesta.sintomas;
                    document.getElementById('alergiasResultado').value = respuesta.alergias;
                    document.getElementById('tipoSangreResultado').value = respuesta.tipo_sangre;
                }
            }
        };

        // Enviar la solicitud con el nombre del paciente
        xhr.send("nombrePaciente=" + encodeURIComponent(nombrePaciente));
    });
});
