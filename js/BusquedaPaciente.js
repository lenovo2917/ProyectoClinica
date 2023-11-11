document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('.btn-custom').addEventListener('click', function () {
        var nombrePaciente = document.getElementById('nombrePaciente').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', './herramientas/busquedaPaciente.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4) {
                if (xhr.status == 200) {
                    try {
                        console.log(xhr.responseText);
                        var respuesta = JSON.parse(xhr.responseText);

                        if (respuesta.error) {
                            console.error('Error en la respuesta del servidor:', respuesta.error);
                        } else {
                            document.getElementById('nombreAut').innerHTML = respuesta.data.nombre;
                            document.getElementById('edadAut').innerHTML = calcularEdad(respuesta.data.fecha);
                            document.getElementById('tipoSangreAut').innerHTML = respuesta.data.tipoSangre;
                            document.getElementById('alergiasAut').innerHTML = respuesta.data.alergias;
                          }
                    } catch (error) {
                        console.error('Error al parsear la respuesta JSON:', error);
                    }
                } else {
                    console.error('Error en la solicitud. Código de estado:', xhr.status);
                }
            }
        };

        xhr.send('buscar=true&nombrePaciente=' + encodeURIComponent(nombrePaciente));
    });
});

// Función para calcular la edad a partir de la fecha de nacimiento
function calcularEdad(fechaNacimiento) {
    // Lógica para calcular la edad (puedes implementar esto según tus necesidades)
    // Aquí un ejemplo simple
    var fechaNac = new Date(fechaNacimiento);
    var hoy = new Date();
    var edad = hoy.getFullYear() - fechaNac.getFullYear();
    var mes = hoy.getMonth() - fechaNac.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
        edad--;
    }

    return edad;
}
