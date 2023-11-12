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

                            // Llamada a la función para actualizar la tabla con las recetas
                            actualizarTablaRecetas(nombrePaciente);
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

// Función para actualizar la tabla de recetas en la sección de información adicional
function actualizarTablaRecetas(nombrePaciente) {
    var xhrRecetas = new XMLHttpRequest();
    xhrRecetas.open('POST', './herramientas/busquedaRecetas.php', true);
    xhrRecetas.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhrRecetas.onreadystatechange = function () {
        if (xhrRecetas.readyState == 4) {
            if (xhrRecetas.status == 200) {
                try {
                    console.log(xhrRecetas.responseText);
                    var respuestaRecetas = JSON.parse(xhrRecetas.responseText);

                    if (respuestaRecetas.error) {
                        console.error('Error en la respuesta del servidor:', respuestaRecetas.error);
                    } else {
                        // Actualizar la tabla con las recetas
                        actualizarTablaInformacionAdicional(respuestaRecetas.data);
                    }
                } catch (error) {
                    console.error('Error al parsear la respuesta JSON:', error);
                }
            } else {
                console.error('Error en la solicitud. Código de estado:', xhrRecetas.status);
            }
        }
    };

    xhrRecetas.send('nombrePaciente=' + encodeURIComponent(nombrePaciente));
}

// Función para actualizar la tabla de información adicional con las recetas obtenidas
function actualizarTablaInformacionAdicional(data) {
    var cuerpoTabla = document.getElementById('cuerpoTablaInformacionAdicional');

    // Limpiar el cuerpo de la tabla antes de agregar nuevas filas
    cuerpoTabla.innerHTML = '';

    // Iterar sobre los datos de las recetas y agregar filas a la tabla
    data.forEach(function (receta) {
        var fila = document.createElement('tr');
        fila.innerHTML = 
            '<td>' + receta.FechaReceta + '</td>' +
            '<td>' + receta.Diagnostico + '</td>' +
            '<td>' + receta.NotasMedicas + '</td>' +
            '<td>' + receta.InstruccionUso + '</td>' +
            '<td><button class="btn btn-custom">Ver Nota</button></td>';

        cuerpoTabla.appendChild(fila);
    });
}
