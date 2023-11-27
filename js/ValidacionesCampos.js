document.addEventListener('DOMContentLoaded', function() {
    'use strict';
  
    var form = document.querySelector('.needs-validation');
  
    form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            // Aquí puedes poner el código para mostrar el modal
        }
  
        form.classList.add('was-validated');
    }, false);
});
