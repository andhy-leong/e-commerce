const track = document.querySelector('.carousel-track');
const slides = Array.from(track.children);
const dots = document.querySelectorAll('.dot');
const slideHeight = slides[0].getBoundingClientRect().height;

// Clone the first slide and append it to the end for seamless looping
const firstSlideClone = slides[0].cloneNode(true);
track.appendChild(firstSlideClone);

let currentIndex = 0;

function updateDots() {
  dots.forEach((dot, index) => {
    dot.classList.toggle('active', index === currentIndex);
  });
}

function slide() {
  currentIndex++;
  track.style.transition = 'transform 1s ease-in-out';
  track.style.transform = `translateY(-${currentIndex * slideHeight}px)`;

  // When reaching the cloned slide, reset position
  if (currentIndex === slides.length) {
    setTimeout(() => {
      track.style.transition = 'none'; // Disable transition for instant reset
      track.style.transform = 'translateY(0)';
      currentIndex = 0; // Reset index to the first slide
      updateDots(); // Ensure dots are updated after reset
    }, 1000); // Match transition duration (1 second)
  } else {
    updateDots(); // Update dots normally during the slide
  }
}

// Slide every 3 seconds
setInterval(slide, 3000);

// Initialize dots for the first slide
updateDots();
