document.addEventListener('DOMContentLoaded', function() {
  'use strict'

  var forms = document.querySelectorAll('.needs-validation')

  Array.prototype.slice.call(forms)
      .forEach(function (form) {
          form.addEventListener('submit', function (event) {
              event.preventDefault(); // Esta línea previene la recarga de la página
              if (!form.checkValidity()) {
                  event.stopPropagation()
              } else {
                  // Aquí puedes poner el código para mostrar el modal
              }

              form.classList.add('was-validated')
          }, false)
      })
});
