// public/js/accueil.js - Carrousel d'accueil réactif (Desktop & Mobile)
document.addEventListener('DOMContentLoaded', function () {
    const track = document.querySelector('.carousel-track');
    if (!track) return;

    const slides = Array.from(track.children);
    if (slides.length === 0) return;

    const dots = document.querySelectorAll('.carousel-indicators .dot');

    // Clone de la première diapositive pour transition infinie fluide
    const firstSlideClone = slides[0].cloneNode(true);
    track.appendChild(firstSlideClone);

    let currentIndex = 0;
    let slideInterval = null;

    function getSlideHeight() {
        return slides[0].getBoundingClientRect().height;
    }

    function updateDots() {
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === (currentIndex % slides.length));
        });
    }

    function slide() {
        currentIndex++;
        const currentHeight = getSlideHeight();
        track.style.transition = 'transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        track.style.transform = `translateY(-${currentIndex * currentHeight}px)`;

        if (currentIndex === slides.length) {
            // Arrivé au clone : bascule instantanée au premier slide sans transition visible
            setTimeout(() => {
                track.style.transition = 'none';
                track.style.transform = 'translateY(0)';
                currentIndex = 0;
                updateDots();
            }, 800);
        } else {
            updateDots();
        }
    }

    // Réajuster la position lors du redimensionnement de l'écran (changement d'orientation sur mobile)
    window.addEventListener('resize', () => {
        const currentHeight = getSlideHeight();
        track.style.transition = 'none';
        track.style.transform = `translateY(-${currentIndex * currentHeight}px)`;
    });

    // Clic sur les indicateurs
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            const currentHeight = getSlideHeight();
            track.style.transition = 'transform 0.6s ease';
            track.style.transform = `translateY(-${currentIndex * currentHeight}px)`;
            updateDots();
            resetInterval();
        });
    });

    function startInterval() {
        slideInterval = setInterval(slide, 3500);
    }

    function resetInterval() {
        clearInterval(slideInterval);
        startInterval();
    }

    startInterval();
    updateDots();
});
