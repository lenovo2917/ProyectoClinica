
// Script para abrir y seleccionar especialidades
document.getElementById("abrirEspecialidades").addEventListener("click", function () {
    document.getElementById("cuadroEspecialidades").style.display = "block";
});

const opcionesEspecialidad = document.querySelectorAll(".opcion-especialidad");
opcionesEspecialidad.forEach(function (opcion) {
    opcion.addEventListener("click", function () {
        const especialidad = opcion.getAttribute("data-especialidad");
        document.getElementById("especialidadCita").value = especialidad;
        document.getElementById("cuadroEspecialidades").style.display = "none";
    });
});

document.addEventListener("click", function (event) {
    if (event.target.id !== "abrirEspecialidades") {
        document.getElementById("cuadroEspecialidades").style.display = "none";
    }
});

// Script para manejar pestañas
const tabLinks = document.querySelectorAll(".nav-link");
const tabPanes = document.querySelectorAll(".tab-pane");

tabLinks.forEach(link => {
    link.addEventListener("click", () => {
        tabPanes.forEach(pane => {
            pane.classList.remove("show", "active");
        });

        const targetPaneId = link.getAttribute("href").replace("#", "");
        const targetPane = document.getElementById(targetPaneId);
        targetPane.classList.add("show", "active");
    });
});


