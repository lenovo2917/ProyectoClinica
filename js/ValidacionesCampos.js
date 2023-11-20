// JavaScript para mostrar un mensaje de éxito después de enviar el formulario
(function () {
    'use strict'
  
    // Obtén todos los formularios que queremos mejorar
    var forms = document.querySelectorAll('.needs-validation')
  
    // Bucle sobre ellos y evita el envío
    Array.prototype.slice.call(forms)
      .forEach(function (form) {
        form.addEventListener('submit', function (event) {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          } else {
            // Si el formulario es válido, muestra el mensaje de éxito
            var successMessage = document.createElement('div')
            successMessage.className = 'alert alert-success'
            successMessage.role = 'alert'
            successMessage.innerHTML = '¡Cambios guardados con éxito!'
            form.appendChild(successMessage)
          }
  
          form.classList.add('was-validated')
        }, false)
      })
  })()
  