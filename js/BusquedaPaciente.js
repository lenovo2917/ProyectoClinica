function mostrarReceta(receta) {
    var areaTextoReceta = document.getElementById('areaTextoReceta');

    if (receta) {
        // Construir la tabla con los datos de la receta
        var tablaReceta = '<table class="table table-bordered" style="max-width: 100%;">';
        tablaReceta += '<tr><th>ID Expediente</th><th>ID Paciente</th><th>Nombre Paciente</th><th>Fecha Receta</th><th>Medicamento</th><th>Instrucciones</th><th>ID Doctor</th><th>Nombre Doctor</th><th>Especialidad Doctor</th><th>Fecha Cita</th><th>Diagnóstico</th></tr>';
        tablaReceta += '<tr>';
        tablaReceta += '<td class="d-none d-sm-table-cell">' + receta.idE + '</td>';
        tablaReceta += '<td class="d-none d-sm-table-cell">' + receta.IDP + '</td>';
        tablaReceta += '<td>' + receta.NombreCompletoP + '</td>';
        tablaReceta += '<td>' + receta.fechaR + '</td>';
        tablaReceta += '<td>' + receta.medicamentoR + '</td>';
        tablaReceta += '<td>' + receta.intruccionUsoR + '</td>';
        tablaReceta += '<td class="d-none d-sm-table-cell">' + receta.IDDoctor + '</td>';
        tablaReceta += '<td>' + receta.NombreDoctor + '</td>';
        tablaReceta += '<td>' + receta.EspecialidadDoctor + '</td>';
        tablaReceta += '<td>' + receta.fechaCita + '</td>';
        tablaReceta += '<td>' + receta.diagnosticoC + '</td>';
        tablaReceta += '</tr>';
        tablaReceta += '</table>';

        // Establecer el contenido de la tabla en el área correspondiente
        // Añadir la clase table-responsive
        areaTextoReceta.innerHTML = '<div class="table-responsive">' + tablaReceta + '</div>';

    } else {
        areaTextoReceta.innerHTML = 'No se encontraron datos de receta.';
    }
}

// Función para visualizar la receta médica
function verNota(idReceta) {
    var xhrReceta = new XMLHttpRequest();
    xhrReceta.open('POST', '../doctores/herramientas/verReceta.php', true);
    xhrReceta.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhrReceta.onreadystatechange = function () {
        if (xhrReceta.readyState == 4) {
            if (xhrReceta.status == 200) {
                try {
                    console.log(xhrReceta.responseText);
                    var respuestaReceta = JSON.parse(xhrReceta.responseText);

                    if (respuestaReceta.error) {
                        console.error('Error en la respuesta del servidor (Ver Receta):', respuestaReceta.error);
                    } else {
                        // Actualizar la sección de Receta Medica con la información de la receta
                        mostrarReceta(respuestaReceta.data);
                    }
                } catch (error) {
                    console.error('Error al parsear la respuesta JSON (Ver Receta):', error);
                }
            } else {
                console.error('Error en la solicitud. Código de estado (Ver Receta):', xhrReceta.status);
            }
        }
    };

    xhrReceta.send('idReceta=' + encodeURIComponent(idReceta));
}

document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('searchForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        console.log("Formulario enviado");

        if (form.checkValidity()) {
            var nombrePaciente = document.getElementById('nombrePaciente').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../doctores/herramientas/busquedaPaciente.php', true);
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
                                // Actualizar la información del paciente
                                actualizarDatosPaciente(respuesta.data);
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
        } else {
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    });
});

function actualizarDatosPaciente(data) {
    var nombreAutElement = document.getElementById('nombreAut');
    var edadAutElement = document.getElementById('edadAut');
    var tipoSangreAutElement = document.getElementById('tipoSangreAut');
    var alergiasAutElement = document.getElementById('alergiasAut');

    // Deshabilitar elementos si el paciente está inactivo
    if (data.estado === 'Inactivo') {
        nombreAutElement.setAttribute('readonly', 'true');
        edadAutElement.setAttribute('readonly', 'true');
        tipoSangreAutElement.setAttribute('readonly', 'true');
        alergiasAutElement.setAttribute('readonly', 'true');
    } else {
        // Habilitar los elementos si el paciente no está inactivo
        nombreAutElement.removeAttribute('readonly');
        edadAutElement.removeAttribute('readonly');
        tipoSangreAutElement.removeAttribute('readonly');
        alergiasAutElement.removeAttribute('readonly');
    }


    // Actualizar valores
    nombreAutElement.innerHTML = data.nombre;
    edadAutElement.innerHTML = calcularEdad(data.fecha);
    tipoSangreAutElement.innerHTML = data.tipoSangre;
    alergiasAutElement.innerHTML = data.alergias;

    // Llamada a la función para actualizar la tabla con las recetas
    actualizarTablaRecetas(data.nombre, data.estado);
}

function calcularEdad(fechaNacimiento) {
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
function actualizarTablaRecetas(nombrePaciente, estadoPaciente) {
    var xhrRecetas = new XMLHttpRequest();
    xhrRecetas.open('POST', '../doctores/herramientas/busquedaRecetas.php', true);
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
                        actualizarTablaInformacionAdicional(respuestaRecetas.data, estadoPaciente);
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

// Función para actualizar la tabla de recetas en la sección de información adicional
function actualizarTablaInformacionAdicional(data, estadoPaciente) {
    var cuerpoTabla = document.getElementById('cuerpoTablaInformacionAdicional');

    // Limpiar el cuerpo de la tabla antes de agregar nuevas filas
    cuerpoTabla.innerHTML = '';

    // Iterar sobre los datos de las recetas y agregar filas a la tabla
    data.forEach(function (receta) {
        var fila = document.createElement('tr');
        fila.innerHTML =
            '<td>' + receta.FechaReceta + '</td>' +
            '<td>' + receta.Diagnostico + '</td>' +
            '<td>' + receta.Medicamento + '</td>' +
            '<td>' + receta.InstruccionUso + '</td>' +
            '<td><button class="btn btn-custom" onclick="verNota(' + receta.idR + ')" ' + (estadoPaciente === 'Inactivo' ? 'disabled' : '') + '>Ver Nota</button></td>';

        cuerpoTabla.appendChild(fila);
    });
}
