import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener("DOMContentLoaded", () => {
    const observerOptions = {
        root: null,
        rootMargin: "0px",
        threshold: 0.15 // Triggers when 15% of the section is visible
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Add the animation class when entering viewport
                entry.target.classList.add("reveal-active");
                // Optional: Unobserve if you only want the animation to run once
                observer.unobserve(entry.target); 
            }
        });
    }, observerOptions);

    // Track all target elements
    document.querySelectorAll(".reveal, .reveal-up, .reveal-left, .reveal-right").forEach(el => {
        revealObserver.observe(el);
    });
});