import "./bootstrap";
import Alpine from "alpinejs";
import Swiper from "swiper/bundle";
import "swiper/css/bundle";

window.Alpine = Alpine;
Alpine.start();

document.addEventListener("DOMContentLoaded", function () {
    // Initialize Swiper
    const swiper = new Swiper(".swiper", {
        direction: "horizontal", // You can change to "vertical" if needed
        loop: true,
        autoplay: {
            delay: 3000, // Auto-slide every 3 seconds
            disableOnInteraction: false, // Keeps autoplay running after interaction
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        scrollbar: {
            el: ".swiper-scrollbar",
            draggable: true,
        },
    });

    // Mobile Menu Toggle
    const menuButton = document.getElementById("mobile-menu-button");
    const mobileMenu = document.getElementById("mobile-menu");

    if (menuButton && mobileMenu) {
        menuButton.addEventListener("click", function () {
            mobileMenu.classList.toggle("hidden");
        });
    }
});
