// ============================================
// pagination_filtre_ordi.js - VERSION CORRIGÉE & OPTIMISÉE 2025
// Gestion des filtres intégrée à la pagination pour ordinateurs
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    // Variables globales pour les filtres actifs (cumulatifs)
    window.activeFilters = JSON.parse(sessionStorage.getItem('activeFiltersOrdi')) || {
        price: null,    // e.g., "0-500000"
        brand: null,    // e.g., "dell"
        rating: null    // e.g., "4" pour >=4
    };

    // Sélecteurs pour les éléments de filtres
    const filterLinks = document.querySelectorAll('.filter-options-list a');
    const allFiltersButton = document.querySelector('.filter-all-button');

    // Normalisation des marques (insensible à la casse, espaces)
    const normalizeBrand = (str) => str.toLowerCase().trim().replace(/\s+/g, ' ');

    // Fonction de filtrage optimisée (inchangée, car correcte)
    function filterProducts(products) {
        return products.filter(product => {
            let matches = true;

            // Filtre Marque
            if (activeFilters.brand) {
                const productBrand = normalizeBrand(product.brand);
                const filterBrand = normalizeBrand(activeFilters.brand);
                if (productBrand !== filterBrand) {
                    matches = false;
                }
            }

            // Filtre Prix (robuste avec logs pour debug)
            if (matches && activeFilters.price) {
                const price = parseFloat(product.price) || 0;
                const [minStr, maxStr] = activeFilters.price.split('-');
                const min = parseFloat(minStr) || 0;
                const max = maxStr === '+' ? Infinity : (parseFloat(maxStr) || Infinity);
                if (price < min || price > max) {
                    matches = false;
                    console.debug(`Produit exclu par prix: ${product.name} (${price}) vs [${min}-${max}]`); // Debug
                }
            }

            // Filtre Rating
            if (matches && activeFilters.rating) {
                const minRating = parseFloat(activeFilters.rating);
                const lowerBound = minRating === 5 ? 4.75 : minRating;
                if (product.rating < lowerBound) {
                    matches = false;
                }
            }

            return matches;
        });
    }

    // Callback nommé pour pagination (fix arguments.callee)
    function createPaginationCallback(filteredProducts, gridId, paginId) {
        const totalPages = Math.ceil(filteredProducts.length / productsPerPage);
        return function updatePage(page) {
            if (page < 1 || page > totalPages) return;
            displayProducts(filteredProducts, page, gridId);
            renderPagination(page, totalPages, paginId, this); // 'this' = même callback
        };
    }

    // Appliquer les filtres et re-rendre (avec feedback)
    function applyFilters() {
        try {
            const filteredAll = filterProducts(allProducts || []); // Fallback si allProducts manquant
            const filteredBest = filterProducts(bestOffers || []); // Fallback si bestOffers manquant

            // Sauvegarder état
            sessionStorage.setItem('activeFiltersOrdi', JSON.stringify(activeFilters));

            // Recalcul pagination
            const totalPages1 = Math.ceil(filteredAll.length / (window.productsPerPage || 12));
            const totalPages2 = Math.ceil(filteredBest.length / (window.productsPerPage || 12));

            // Re-rendre sections (page 1)
            displayProducts(filteredAll, 1, 'grid1');
            const callback1 = createPaginationCallback(filteredAll, 'grid1', 'pagin1');
            renderPagination(1, totalPages1, 'pagin1', callback1);

            displayProducts(filteredBest, 1, 'grid2');
            const callback2 = createPaginationCallback(filteredBest, 'grid2', 'pagin2');
            renderPagination(1, totalPages2, 'pagin2', callback2);

            // Feedback visuel (ajoute un élément HTML si absent)
            let counterEl = document.querySelector('.filter-counter');
            if (!counterEl) {
                counterEl = document.createElement('div');
                counterEl.className = 'filter-counter';
                counterEl.style.cssText = 'text-align: center; margin: 1rem 0; font-weight: 600; color: #1e40af;';
                document.querySelector('.product-filters-bar')?.after(counterEl);
            }
            counterEl.textContent = `${filteredAll.length + filteredBest.length} produits trouvés`;

            // Réattacher navigation (clics cartes)
            if (typeof window.attachProductNavigation === 'function') {
                setTimeout(window.attachProductNavigation, 50);
            }

            // Scroll vers résultats
            document.querySelector('.products-section')?.scrollIntoView({ behavior: 'smooth' });

            console.log(`✅ Filtres appliqués: ${filteredAll.length} (tous) + ${filteredBest.length} (offres)`);
        } catch (err) {
            console.error('Erreur applyFilters:', err);
        }
    }

    // Reset des filtres (avec clear sessionStorage)
    function resetFilters() {
        window.activeFilters = { price: null, brand: null, rating: null };
        sessionStorage.removeItem('activeFiltersOrdi');
        const counterEl = document.querySelector('.filter-counter');
        if (counterEl) counterEl.remove();
        updateSection1(1);
        updateSection2(1);
        console.log('🔄 Filtres reset');
    }

    // Événements sur liens filtres (avec debug)
    filterLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const data = link.dataset;
            console.debug('Filtre cliqué:', data); // Debug pour vérifier data-price

            if (data.price) {
                activeFilters.price = data.price;
                console.debug(`Prix filtre: ${data.price}`);
            }
            if (data.brand) activeFilters.brand = data.brand;
            if (data.rating) activeFilters.rating = data.rating;

            // Fermer dropdown (robuste)
            const parentItem = link.closest('.product-filter-item');
            const checkbox = parentItem?.querySelector('.filter-radio-input');
            if (checkbox) checkbox.checked = false;

            applyFilters();
        });
    });

    // Événement reset
    if (allFiltersButton) {
        allFiltersButton.addEventListener('click', (e) => {
            e.preventDefault();
            resetFilters();
        });
    }

    // Appliquer filtres au chargement (si état persistant)
    if (Object.values(activeFilters).some(v => v !== null)) {
        setTimeout(applyFilters, 100); // Délai pour que pagination_ordi.js charge allProducts
    }

    console.log('✅ pagination_filtre_ordi.js chargé - Filtres prêts pour ordinateurs (debug activé)');
});