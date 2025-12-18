document.addEventListener('DOMContentLoaded', () => {
    const carouselContainer = document.querySelector('.carousel-container');
    const slidesContainer = document.querySelector('.slides');
    const slides = document.querySelectorAll('.slides .slide:not(.slide-clone)');
    const totalSlides = slides.length; 
    
    // Total des slides incluant les clones (4 originales + 2 clones = 6)
    const totalContentSlides = totalSlides + 2; 

    // Index actuel (commence à 1 pour être sur la première vraie slide)
    let currentSlideIndex = 1; 
    let isTransitioning = false;
    let autoSlideInterval;

    if (!slidesContainer) return;

    // Calcul de la largeur de chaque slide (supposée être 100% du conteneur)
    const slideWidth = carouselContainer.clientWidth;

    /**
     * Déplace le conteneur des slides à la position de l'index donné.
     * @param {number} index L'index à atteindre (0 pour le premier clone, 1 pour la vraie slide 1, etc.)
     * @param {boolean} smooth Détermine si la transition doit être animée (true) ou instantanée (false).
     */
    function goToSlide(index, smooth = true) {
        if (isTransitioning && smooth) return;

        // Met à jour l'index pour la logique de contrôle
        currentSlideIndex = index;
        
        // La position de départ (index 0) est le clone de la dernière slide.
        // La première vraie slide est à l'index 1.
        const offset = -(index * slideWidth);

        slidesContainer.style.transition = smooth ? 'transform 0.5s ease-in-out' : 'none';
        slidesContainer.style.transform = `translateX(${offset}px)`;

        if (smooth) {
            isTransitioning = true;
        } else {
            isTransitioning = false;
        }
        
        // Mettre à jour les points de navigation (dots)
        updateDots(index);
    }

    /**
     * Met à jour l'état des points de navigation (dots)
     * @param {number} index L'index de la slide courante (doit être 1-4)
     */
    function updateDots(index) {
        // L'index des slides de contenu réel est entre 1 et totalSlides (4)
        let realIndex = index;
        if (index === 0) realIndex = totalSlides;
        if (index === totalSlides + 1) realIndex = 1;

        const dots = document.querySelectorAll('.banner-dots .dot');
        dots.forEach((dot, i) => {
            // Les dots sont indexés de 0 (pour slide 1) à 3 (pour slide 4)
            if (i + 1 === realIndex) {
                dot.checked = true;
            } else {
                dot.checked = false;
            }
        });
    }

    /**
     * Logique de Saut Instantané (Infinite Loop)
     * Gère le retour du clone à la vraie slide après la fin de la transition.
     */
    slidesContainer.addEventListener('transitionend', () => {
        isTransitioning = false;

        // Cas 1: Atteint le clone de la Slide 4 (index 0) -> Saute à la vraie Slide 4 (index 4)
        if (currentSlideIndex === 0) {
            goToSlide(totalSlides, false); 
        } 
        // Cas 2: Atteint le clone de la Slide 1 (index totalContentSlides - 1) -> Saute à la vraie Slide 1 (index 1)
        else if (currentSlideIndex === totalContentSlides - 1) {
            goToSlide(1, false);
        }
    });

    /**
     * Configuration des clics sur les flèches du carrousel.
     */
    document.querySelectorAll('.slide label').forEach(label => {
        label.addEventListener('click', (e) => {
            e.preventDefault();
            
            // On détermine la slide CIBLE à partir de l'attribut 'for' du label
            const targetId = label.getAttribute('for');
            let targetIndex;
            
            switch (targetId) {
                case 'slide1': targetIndex = 1; break;
                case 'slide2': targetIndex = 2; break;
                case 'slide3': targetIndex = 3; break;
                case 'slide4': targetIndex = 4; break;
                default: return;
            }
            
            // Pour les flèches du clone:
            if (label.closest('.slide-clone')) {
                // Si la flèche droite du clone de slide4 pointe vers slide1 (index 1)
                if (label.classList.contains('right-arrow') && currentSlideIndex === 0) {
                     targetIndex = 1; 
                }
                // Si la flèche gauche du clone de slide1 pointe vers slide4 (index 4)
                if (label.classList.contains('left-arrow') && currentSlideIndex === totalContentSlides - 1) {
                    targetIndex = 4;
                }
            } else {
                // Pour les slides originales, la cible est déjà correcte
            }

            // On incrémente ou décrémente l'index actuel pour simuler le mouvement
            let nextIndex = currentSlideIndex;
            if (label.classList.contains('right-arrow')) {
                nextIndex = currentSlideIndex + 1;
            } else if (label.classList.contains('left-arrow')) {
                nextIndex = currentSlideIndex - 1;
            }
            
            // Assurer que l'index reste dans les limites de l'index visuel (0 à 5)
            if (nextIndex >= 0 && nextIndex < totalContentSlides) {
                goToSlide(nextIndex);
                resetAutoSlide();
            }
        });
    });

    /**
     * Logique de défilement automatique
     */
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            // Si on est sur la dernière slide de contenu réel (4), la prochaine est le clone de la slide 1 (index 5)
            const nextIndex = currentSlideIndex === totalSlides ? totalSlides + 1 : currentSlideIndex + 1;
            goToSlide(nextIndex);
        }, 5000); // 5 secondes
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }
    
    // Initialisation
    goToSlide(1, false); // Positionne sur la première vraie slide (saut de la position du clone de slide 4)
    startAutoSlide();
});