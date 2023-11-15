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
var idR;
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
// Modificar la función actualizarTablaInformacionAdicional
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
            '<td><button class="btn btn-custom" onclick="verNota(' + receta.idR + ')">Ver Nota</button></td>';

        cuerpoTabla.appendChild(fila);
    });
}
function verNota(idR) {
    // Almacenar el idR en la variable global
    idRActual = idR;

    console.log('Clic en "Ver Nota" para la receta con idR:', idR);

    $.ajax({
        url: './herramientas/obtenerNota.php',
        method: 'POST',
        data: { idR: idR },
        success: function (data) {
            // Mostrar la nota en un cuadro de texto editable
            
            $('#notaCompleta').val(data.notaConsulta);
            $('#Diagnostico').val(data.Diagnostico);
            $('#Medicamento').val(data.medicamento);
        },
        error: function (error) {
            console.error('Error al obtener la nota:', error);
        }
    });
}
function guardarCambios() {
    // Utilizar la variable global idRActual en lugar de idR
    var nuevaNota = document.getElementById('notaCompleta').value;
    var nuevoDiagnostico = document.getElementById('Diagnostico').value;
    var nuevoMedicamento = document.getElementById('Medicamento').value;

    // Enviar la nueva nota al servidor para actualizar la base de datos
    $.ajax({
        url: './herramientas/guardarCambiosNota.php',
        method: 'POST',
        data: { 
            idR: idRActual, 
            notaConsulta: nuevaNota,
            Diagnostico: nuevoDiagnostico,
            medicamento: nuevoMedicamento
        }, 
        success: function (data) {
            // Manejar la respuesta del servidor
            if (data.success) {
                // Mostrar mensaje de éxito
                alert('Cambios guardados con éxito');
            } else {
                // Manejar error si es necesario
                console.error('Error al guardar cambios:', data.error);
            }
        },
        error: function (xhr, status, error) {
            console.error('Error al guardar cambios:', error);
        }
    });
}
