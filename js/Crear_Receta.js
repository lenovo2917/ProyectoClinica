document.addEventListener("DOMContentLoaded", function () {
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
});

