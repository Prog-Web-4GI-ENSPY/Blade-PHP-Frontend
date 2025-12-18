const slidesbuttons = document.querySelectorAll('input[name="slide"]');
const slides = document.getElementById("slides");
const leftArrows = document.querySelectorAll('.left-arrow');
const rightArrows = document.querySelectorAll('.right-arrow');
const heroBanner = document.querySelector('.hero-banner');

let current = 1;
let nextSlide;
let next;
let autoplayInterval;
let isJumping = false;

// Fonction pour obtenir le slide actif
function getCurrentSlide() {
    for (let i = 0; i < slidesbuttons.length; i++) {
        if (slidesbuttons[i].checked) {
            return i;
        }
    }
}

// Fonction pour aller au slide suivant
function goToNextSlide() {
    if (isJumping) {
        console.log("jumping from clone to original");
        return;
    }
    current = getCurrentSlide();
    console.log(`current : ${current}`);
    next = current + 1;
    if (next===0) {
        nextSlide = document.getElementById("slide4clone");
        console.log("next : slide4clone");
    } else if (next === 5) {
        nextSlide = document.getElementById("slide1clone");
        console.log("next : slide1clone");
    } else {
        nextSlide = document.getElementById(`slide${next}`);
        console.log(`next : slide${next}`);
    }
    nextSlide.checked = true;
    if (next===0) {
        isJumping = true;
        setTimeout(() => {
            slides.style.transition = "none";
            slidesbuttons[4].checked = true;
            slides.offsetHeight;
            slides.style.transition = "all 0.5s ease";
        }, 500);
        console.log("jumped from clone slide 4 to original slide 4");
        isJumping = false;
        next = 4;
    } else if (next===5) {
        isJumping = true;
        setTimeout(() => {
            slides.style.transition = "none";
            slidesbuttons[1].checked = true;
            slides.offsetHeight;
            slides.style.transition = "all 0.5s ease";
        }, 500);
        console.log("jumped from clone slide 1 to original slide 1");
        next = 1;
        isJumping = false;
    }
    current = next;
}

// Gestion des clics sur les flèches droites
rightArrows.forEach((arrow) => {
    arrow.addEventListener('click', () => {
        resetAutoplay();
        console.log("reset");
    });
});

// Gestion des clics sur les flèches gauches
leftArrows.forEach((arrow) => {
    arrow.addEventListener('click', () => {
        resetAutoplay();
        console.log("reset");
    });
});

// Démarrage de l'autoplay
function startAutoplay() {
    stopAutoplay();
    autoplayInterval = setInterval(() => {
        goToNextSlide();
    }, 3000);
}

// Arrêt de l'autoplay
function stopAutoplay() {
    if (autoplayInterval) {
        clearInterval(autoplayInterval);
        autoplayInterval = null;
    }
}

// Réinitialisation de l'autoplay (arrête puis redémarre)
function resetAutoplay() {
    stopAutoplay();
    startAutoplay();
}

// Pause au survol du carousel
heroBanner.addEventListener('mouseenter', () => {
    stopAutoplay();
    console.log("stop");
});

// Reprise quand la souris quitte le carousel
heroBanner.addEventListener('mouseleave', () => {
    startAutoplay();
    console.log("start");
});

// Gestion du changement de visibilité de la page (pause si l'utilisateur change d'onglet)
document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        stopAutoplay();
        console.log("stop");
    } else {
        startAutoplay();
        console.log("start");
    }
});

// Démarrage initial
startAutoplay();