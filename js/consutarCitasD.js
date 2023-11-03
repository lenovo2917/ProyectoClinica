  // Agregar un evento de clic a los botones "Aceptar" por su clase
  document.addEventListener("click", function(event) {
    if (event.target.classList.contains("btn-aceptar")) {
        // Obtener el IDC de la cita desde el atributo data-id
        const citaID = event.target.getAttribute("data-id");

        // Realizar una solicitud al servidor para actualizar el estado de la cita
        // Puedes utilizar AJAX o Fetch para esto
        // Ejemplo con Fetch:
        fetch("../doctores/herramientas/actualizar_cita.php", {
            method: "POST",
            body: JSON.stringify({ citaID: citaID, estatus: "Aceptada" }),
            headers: {
                "Content-Type": "application/json"
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el estado en la tabla o realizar otras acciones necesarias
                event.target.disabled = true; // Deshabilitar el botón después de aceptar
            } else {
                // Manejar errores si es necesario
                alert("Error al aceptar la cita.");
            }
        });
    }
});
