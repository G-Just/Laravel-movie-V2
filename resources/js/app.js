import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

// Search bar for rating field, and finding similar movie options
const input = document.getElementById("movieOptionSearch");
const selections = document.getElementsByClassName("movieOption");

input.addEventListener("input", () => {
    [...selections].forEach((selection) => {
        if (selection.id.toLowerCase().includes(input.value)) {
            selection.classList.remove("hidden");
        } else {
            selection.classList.add("hidden");
        }
    });
});
