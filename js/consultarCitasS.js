$(document).ready(function () {
    $.ajax({
        url: '../php/obtenerCitasS.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            mostrarDatos(data);
        },
        error: function () {
            alert('Error al obtener los datos.');
        }
    });

    function mostrarDatos(data) {
        var tbody = $('#tbodyPacientes');

        $.each(data, function (index, paciente) {
            var row = '<tr>' +
                '<td>' + paciente.nombreCompletoP + '</td>' +
                '<td>' + paciente.fechaC + '</td>' +
                '<td>' + paciente.horaC + '</td>' +
                '<td>' + paciente.estatus + '</td>' +
                '<td class="text-center">' +
                '<input type="button" class="" value="Aceptar">' +
                '<input type="button" class="" value="Rechazar">' +
                '<input type="button" class="" value="Trasladar">' +
                '</td>' +
                '</tr>';

            tbody.append(row);
        });
    }
});
