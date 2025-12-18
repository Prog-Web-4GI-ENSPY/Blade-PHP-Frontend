document.addEventListener('DOMContentLoaded', () => {
    // Configuration de base pour la pagination (peut être ajustée)
    const PRODUCTS_PER_PAGE = 8;
    const TOTAL_PAGES = 3; // Basé sur le nombre de boutons dans le HTML

    // Liste des grilles et de leurs conteneurs de pagination, y compris la CIBLE DE DÉFILEMENT
    const gridConfigs = [
        { gridId: 'products-for-you-grid', scrollTargetId: 'title-for-you', paginationId: 'pagination-for-you', currentPage: 1 },
        { gridId: 'best-sellers-grid', scrollTargetId: 'title-best-sellers', paginationId: 'pagination-best-sellers', currentPage: 1 },
        { gridId: 'promotion-grid', scrollTargetId: 'title-promotion', paginationId: 'pagination-promotion', currentPage: 1 }
    ];

    /**
     * Cache le ou affiche les cartes de produits pour la page donnée.
     * @param {string} gridId L'ID du conteneur de la grille de produits.
     * @param {number} pageNumber Le numéro de la page à afficher (1-based).
     */
    function updateGrid(gridId, pageNumber) {
        const grid = document.getElementById(gridId);
        if (!grid) return;

        const productCards = Array.from(grid.querySelectorAll('.product-card'));
        const startIndex = (pageNumber - 1) * PRODUCTS_PER_PAGE;
        const endIndex = pageNumber * PRODUCTS_PER_PAGE;

        productCards.forEach((card, index) => {
            if (index >= startIndex && index < endIndex) {
                card.style.display = 'block'; // Afficher
            } else {
                card.style.display = 'none'; // Cacher
            }
        });
    }

    /**
     * Met à jour l'interface utilisateur de la pagination (boutons actif/désactivé).
     * @param {string} paginationId L'ID du conteneur de pagination.
     * @param {number} currentPage Le numéro de la page actuelle.
     */
    function updatePaginationUI(paginationId, currentPage) {
        const paginationContainer = document.getElementById(paginationId);
        if (!paginationContainer) return;

        const prevBtn = paginationContainer.querySelector('[data-direction="prev"]');
        const nextBtn = paginationContainer.querySelector('[data-direction="next"]');
        const pageNumBtns = paginationContainer.querySelectorAll('.page-num, .page-num-active');

        // Mettre à jour les boutons Précédent/Suivant
        if (prevBtn) {
            prevBtn.disabled = currentPage === 1;
        }
        if (nextBtn) {
            nextBtn.disabled = currentPage === TOTAL_PAGES;
        }

        // Mettre à jour les numéros de page actifs
        pageNumBtns.forEach(btn => {
            const page = parseInt(btn.getAttribute('data-page'));
            if (page === currentPage) {
                btn.classList.add('page-num-active');
                btn.classList.remove('page-num');
            } else {
                btn.classList.add('page-num');
                btn.classList.remove('page-num-active');
            }
        });
    }

    /**
     * Initialise et gère les événements de clic sur la pagination.
     */
    function initPagination() {
        // Initialiser l'affichage de chaque grille à la première page
        gridConfigs.forEach(config => {
            updateGrid(config.gridId, config.currentPage);
            updatePaginationUI(config.paginationId, config.currentPage);
        });

        // Ajouter des écouteurs d'événements à tous les boutons de pagination
        document.querySelectorAll('.pagination button').forEach(button => {
            button.addEventListener('click', function() {
                const gridId = this.getAttribute('data-grid-id');
                if (!gridId) return;

                const config = gridConfigs.find(c => c.gridId === gridId);
                if (!config) return;

                const direction = this.getAttribute('data-direction');
                let newPage = config.currentPage;

                if (direction === 'prev' && newPage > 1) {
                    newPage--;
                } else if (direction === 'next' && newPage < TOTAL_PAGES) {
                    newPage++;
                } else if (this.classList.contains('page-num') || this.classList.contains('page-num-active')) {
                    const pageNum = parseInt(this.getAttribute('data-page'));
                    if (!isNaN(pageNum)) {
                        newPage = pageNum;
                    }
                } else {
                    return;
                }

                // Appliquer les changements si la page a changé
                if (newPage !== config.currentPage) {
                    config.currentPage = newPage;
                    updateGrid(config.gridId, config.currentPage);
                    updatePaginationUI(config.paginationId, config.currentPage);
                    
                    // CORRECTION: Faire défiler vers le titre de la section pour une meilleure visibilité.
                    document.getElementById(config.scrollTargetId)?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    initPagination();
});