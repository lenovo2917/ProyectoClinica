
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
// Script para mostrar ventana emergente al hacer clic en "Crear Receta"
const btnCrearReceta = document.getElementById("btnCrearReceta");
const modal = document.getElementById("modal");
const close = document.getElementById("close");
const nombre = document.getElementById("nombre");
const apellidoPaterno = document.getElementById("apellidoPaterno");
const apellidoMaterno = document.getElementById("apellidoMaterno");
const fecha = document.getElementById("fecha");
const diagnostico = document.getElementById("diagnostico");
const medicamento = document.getElementById("medicamento");
const instrucciones = document.getElementById("instrucciones");
const recetaContent = document.getElementById("recetaContent");

btnCrearReceta.addEventListener("click", (event) => {
    event.preventDefault();
    modal.style.display = "block";

    const recetaMedica = `
<div class="row">
        <div class="col-lg-2">
            <img src="/Clinica_Tachirito/Logo/LOGO_CLINICA_TACHIRITO.png" alt="Logo del médico" width="150" height="150">
        </div>
        <div class="col-lg-10">
            <h3>Receta Medica</h3>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-5">
            <p>Información del Doctor:</p>
        </div>
        <div class="col-lg-5">
            <p>Lugar de la Clínica:</p>
        </div>
        <div class="col-lg-1">
<button id="print" class="btn btn-custom btn-round" style="margin-right: 10px;">
    <i class="fas fa-print"></i>
</button>
</div>
<div class="col-lg-1">
<button id="download" class="btn btn-custom btn-round">
    <i class="fas fa-download"></i>
</button>

</div>
    </div>
<table>
<tr>
    <td>Fecha de Elaboración:</td>
    <td>${fecha.value}</td>
</tr>
</table>
<table>
<tr>
    <td>Nombre:</td>
    <td>${nombre.value}</td>
</tr>
<tr>
    <td>Apellido Paterno:</td>
    <td>${apellidoPaterno.value}</td>
</tr>
<tr>
    <td>Apellido Materno:</td>
    <td>${apellidoMaterno.value}</td>
</tr>
<tr>
    <td>Diagnóstico:</td>
    <td>${diagnostico.value}</td>
</tr>
<tr>
    <td>Medicamento Recetado:</td>
    <td>${medicamento.value}</td>
</tr>
<tr>
    <td>Instrucciones de Uso:</td>
    <td>${instrucciones.value}</td>
</tr>
</table>
<p>Favor de tomar el tratamiento completo.</p>
<div class="doctor-signature">
<p>Firma del Doctor:</p>
<div style="border-bottom: 2px solid #5f5f5f; width: 30%; margin-top: 30px;"
                                        class="signature-line"></div>
                                    </div>
<div class="row" style="margin-top: 20px;">
    <div class="col-lg-4">

        <button id="addToRecord" class="btn btn-custom" style="margin-right: 10px;">
            <i class="fas fa-plus"></i> Agregar a expediente
        </button>
    </div>
</div>
`;

    recetaContent.innerHTML = recetaMedica;

     close.addEventListener("click", () => {
    modal.style.display = "none";
});

window.addEventListener("click", (event) => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
});

    // Agregar event listeners para los nuevos botones
    const addToRecordBtn = document.getElementById("addToRecord");
    const printBtn = document.getElementById("print");
    const downloadBtn = document.getElementById("download");

    // Agrega un controlador de eventos al botón "Agregar al expediente"
    document.getElementById("addToRecord").addEventListener("click", function () {
        // Muestra los botones de impresión y descarga cuando se hace clic en "Agregar al expediente"
        document.getElementById("print").style.display = "inline-block";
        document.getElementById("download").style.display = "inline-block";
    });

});


