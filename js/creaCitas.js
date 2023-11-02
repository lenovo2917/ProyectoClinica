document.addEventListener("DOMContentLoaded", function () {
    const citaForm = document.getElementById("citaForm");

    citaForm.addEventListener("submit", function (event) {
        const fechaInput = document.getElementById("fecha");
        const horaInput = document.getElementById("hora");
        const sintomasInput = document.getElementById("sintomas");
        const diagnosticoInput = document.getElementById("diagnostico");

        if (new Date(fechaInput.value) < new Date()) {
            alert("La fecha de la cita no puede ser en el pasado.");
            event.preventDefault();
        }

        if (!horaInput.value || !sintomasInput.value || !diagnosticoInput.value) {
            alert("Por favor, complete los campos solicitados.");
            event.preventDefault();
        }

        if(new Date(fechaInput.value) > new Date() && horaInput.value && sintomasInput.value && diagnosticoInput.value){
        event.preventDefault();   
        confirmarEnvio();
        }

    });

    function confirmarEnvio() {
        if (confirm("¿Estás seguro de que deseas realizar esta cita?")) {          
            document.getElementById("citaForm").submit();
        } else {
        }
    }
});

//este main.js es de el navbar
const hamburger = document.querySelector(".hamburger");
const navLinks = document.querySelector(".nav-links");
const links = document.querySelectorAll(".nav-links li");

hamburger.addEventListener('click', ()=>{
   //Animate Links
    navLinks.classList.toggle("open");
    links.forEach(link => {
        link.classList.toggle("fade");
    });

    //Hamburger Animation
    hamburger.classList.toggle("toggle");
});