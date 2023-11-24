$(document).ready(function () {
    // Realizar la solicitud AJAX para obtener las citas al cargar la página
    $.ajax({
        url: '../php/obtenerCitasS.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Mostrar datos en la tabla
            mostrarDatos(data);
        },
        error: function () {
            alert('Error al obtener los datos.');
        }
    });
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
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    mostrarDatos(data);
                },
                error: function () {
                   
                    
                }
            });
        } else {
            // Si al menos uno de los campos tiene valor, realiza la búsqueda
            $.ajax({
                url: '../php/obtenerCitasS.php',
                type: 'POST',
                data: { nombre: nombrePaciente, mes: mesCita },
                dataType: 'json',
                success: function (data) {
                    mostrarDatos(data);
                },
                error: function () {
                   
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
                '<td>' + paciente.nombreCompletoP + '</td>' +
                '<td>' + paciente.fechaC + '</td>' +
                '<td>' + paciente.horaC + '</td>' +
                '<td>' + paciente.estatusC + '</td>' +
                '<div class="">'+
                '<td>' +
                '<a href="cancelarCitasS.php?D1='+paciente.nombreCompletoP+'&D2='+paciente.fechaC+
                '&D3='+paciente.horaC+'&D4='+paciente.sintomasC+'&D5='+paciente.descripcionC+'&D6='+paciente.IDP+'&D7='+paciente.IDC+
                '"><input type="button" class="styled-button" value="Eliminar"></a>' +
                '<a href="modificacionCitasS.php?D1='+paciente.nombreCompletoP+'&D2='+paciente.fechaC+
                '&D3='+paciente.horaC+'&D4='+paciente.sintomasC+'&D5='+paciente.descripcionC+'&D6='+paciente.IDP+'&D7='+paciente.IDC+
                '"><input type="button" class="styled-button" value="Modificar">' +
                '<a href="detallesCitasS.php?D1='+paciente.nombreCompletoP+'&D2='+paciente.fechaC+
                '&D3='+paciente.horaC+'&D4='+paciente.sintomasC+'&D5='+paciente.descripcionC+
                '"><input type="button" class="styled-button" value="Detalles">' +
                '</td>' +
                '</div>'+
                '</tr>';

            tbody.append(row);
        });
    }
});
