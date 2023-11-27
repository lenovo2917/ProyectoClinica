// Función para mostrar alertas dentro del modal
function showAlertInModal(message, alertType) {
    // Definir el contenedor de alertas dentro del modal
    var alertContainer = $('#alertContainerInModal');

    // Crear el elemento de alerta
    var alertElement = $('<div class="alert alert-dismissible fade show" role="alert"></div>');
    alertElement.addClass('alert-' + alertType);
    alertElement.text(message);

    // Agregar el botón de cierre
    var closeButton = $('<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>');
    alertElement.append(closeButton);

    // Agregar la alerta al contenedor dentro del modal
    alertContainer.append(alertElement);

    // Desvanecer automáticamente después de 3 segundos
    setTimeout(function () {
        alertElement.alert('close');
    }, 3000);
}

// Evento que se ejecuta cuando se cierra el modal
$('#exampleModalToggle').on('hidden.bs.modal', function () {
    // Recarga la página al cerrar el modal
    location.reload();
});

$(document).ready(function () {
    // Selecciona el formulario específico por su ID
    var form = document.getElementById('recetaForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault(); // Evita que la página se recargue
        event.stopPropagation();

        if (!form.checkValidity()) {
            // Si el formulario no es válido, no hagas nada más
        } else {
            // Llena el modal con los datos solo si el formulario es válido
            showRecetaModal();
        }

        form.classList.add('was-validated');
    }, false);

    // Función para mostrar el modal
// Función para mostrar el modal
function showRecetaModal() {
    // Captura los datos del formulario
    var nombre = $('#nombre').val();
    var fecha = $('#fecha').val();
    var diagnostico = $('#diagnostico').val();
    var medicamento = $('#medicamento').val();
    var intruccionUsoR = $('#intruccionUsoR').val();

    // Muestra el modal solo si todos los campos están llenos
    if (nombre && fecha && diagnostico && medicamento && intruccionUsoR) {
        // Llena el modal con los datos
        $('#datosReceta').html(`
            <table class="table">
                <tr><td>Nombre:</td><td>${nombre}</td></tr>
                <tr><td>Fecha:</td><td>${fecha}</td></tr>
                <tr><td>Diagnóstico:</td><td>${diagnostico}</td></tr>
                <tr><td>Medicamento:</td><td>${medicamento}</td></tr>
                <tr><td>Instrucciones de Uso:</td><td>${intruccionUsoR}</td></tr>
            </table>
        `);

        // Muestra el modal
        $('#exampleModalToggle').modal('show');
    }
}


    // Variable para almacenar el ID de la cita seleccionada
    var IDC;

    // Cuando se hace clic en una cita del menú desplegable
    $('#citasDropdown').on('click', 'a', function () {
        // Captura el ID de la cita
        IDC = $(this).data('idc');

        // Muestra el ID de la cita en la consola
        console.log('ID de la cita seleccionada:', IDC);
    });

    // Cuando se haga clic en el botón "Agregar al expediente"...
    $('#agregarExpediente').on('click', function () {
        // Asegúrate de que el ID de la cita seleccionada esté disponible aquí
        if (IDC !== undefined) {
            // Agrega el ID de la cita al formulario antes de enviar la solicitud AJAX
            $('#recetaForm').append('<input type="hidden" name="IDC" value="' + IDC + '">');

            // Hace una solicitud AJAX directamente
            $.ajax({
                url: '../doctores/herramientas/InsertaR.php',
                type: 'post',
                data: $('#recetaForm').serialize(), // Envía todo el formulario, incluyendo el nuevo campo oculto
                success: function (response) {
                    console.log(response); // Registra la respuesta para ver su contenido

                    var data = JSON.parse(response);

                    if (data.success) {
                        showAlertInModal('Receta creada exitosamente', 'success');
                    $('#agregarExpediente').hide();
                    $('#descargar, #imprimir').show();
                    } else {
                        showAlertInModal('Error: ' + data.message, 'danger');
                    }
                },
                error: function () {
                    // Aquí puedes agregar código para manejar errores, como mostrar un mensaje de error
                    alert('Error en la solicitud AJAX.');
                }
            });
        } else {
            // Muestra un mensaje de alerta si no se ha seleccionado ninguna cita
            alert('Por favor, selecciona una cita antes de agregar al expediente.');
        }
    });
});