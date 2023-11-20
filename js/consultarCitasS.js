$(document).ready(function () {
    // Llama a buscarCitas cuando el valor del campo de nombre cambia
    $('#nombrePaciente').on('input', function () {
        buscarCitas();
    });

    // Llama a buscarCitas cuando el valor del campo de mes cambia
    $('#mesCita').on('change', function () {
        buscarCitas();
    });

    // Función para buscar citas
    function buscarCitas() {
        var nombrePaciente = $('#nombrePaciente').val();
        var mesCita = $('#mesCita').val();

        // Verifica si ambos campos están vacíos
        if (nombrePaciente === '' && mesCita === '') {
            // Si ambos están vacíos, consulta todas las citas
            $.ajax({
                url: '../php/obtenerCitasS.php',
                type: 'GET', // Cambiado a GET
                dataType: 'json',
                success: function (data) {
                    mostrarDatos(data);
                },
                error: function () {
                    alert('Error al obtener los datos.');
                }
            });
        } else {
            // Si al menos uno de los campos tiene valor, realiza la búsqueda
            $.ajax({
                url: '../php/obtenerCitasS.php',
                type: 'GET',
                data: { nombre: nombrePaciente, mes: mesCita },
                dataType: 'json',
                success: function (data) {
                    mostrarDatos(data);
                },
                error: function () {
                    alert('Error al obtener los datos.');
                }
            });
        }
    }

    // Mostrar datos (como antes)
    function mostrarDatos(data) {
        var tbody = $('#tbodyPacientes');
        tbody.empty(); // Limpiar contenido existente antes de agregar nuevos datos

        $.each(data, function (index, paciente) {
            var row = '<tr>' +
                '<td>' + paciente.NombreCompletoP + '</td>' +
                '<td>' + paciente.fechaC + '</td>' +
                '<td>' + paciente.horaC + '</td>' +
                '<td>' + paciente.estatus + '</td>' +
                '<td class="text-center">' +
                '<input type="button" class="styled-button" value="Aceptar">' +
                '<input type="button" class="styled-button" value="Rechazar">' +
                '<input type="button" class="styled-button" value="Trasladar">' +
                '</td>' +
                '</tr>';

            tbody.append(row);
        });
    }
});
