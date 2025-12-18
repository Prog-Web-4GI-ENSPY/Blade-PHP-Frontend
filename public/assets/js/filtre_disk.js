// ============================================
// pagination_filtre_disk.js - VERSION FINALE (MARQUES DISQUES)
// ============================================

document.addEventListener('DOMContentLoaded', () => {
    // --- FILTRES ACTIFS ---
    window.activeFilters = {
        price: null,
        brand: null,
        rating: null
    };

    // --- MARQUES NORMALISÉES (pour comparaison fiable) ---
    const normalizeBrand = (str) => {
        return str.toLowerCase().trim()
            .replace(/\s+/g, ' ')           // un seul espace
            .replace('wd', 'western digital') // WD → Western Digital
            .replace('westerndigital', 'western digital');
    };

    // --- FONCTION DE FILTRAGE ---
    function filterProducts(products) {
        return products.filter(product => {
            let matches = true;

            // --- FILTRE MARQUE ---
            if (matches && activeFilters.brand) {
                const productBrand = normalizeBrand(product.brand);
                const filterBrand = normalizeBrand(activeFilters.brand);
                if (productBrand !== filterBrand) {
                    matches = false;
                }
            }

            // --- FILTRE PRIX ---
            if (matches && activeFilters.price) {
                const price = parseFloat(product.price) || 0;
                const [minStr, maxStr] = activeFilters.price.split('-');
                const min = parseFloat(minStr) || 0;
                const max = maxStr === '+' ? Infinity : parseFloat(maxStr) || Infinity;
                if (price < min || price > max) matches = false;
            }

            // --- FILTRE RATING ---
            if (matches && activeFilters.rating) {
                const minRating = parseFloat(activeFilters.rating);
                const lowerBound = minRating === 5 ? 4.75 : minRating;
                if (product.rating < lowerBound) matches = false;
            }

            return matches;
        });
    }

    // --- APPLICATION DES FILTRES ---
    function applyFilters() {
        const filteredAll = filterProducts(allProducts);
        const filteredBest = filterProducts(bestOffers);

        // Recalculer les pages
        const totalPages1 = Math.ceil(filteredAll.length / productsPerPage);
        const totalPages2 = Math.ceil(filteredBest.length / productsPerPage);

        // Réafficher
        displayProducts(filteredAll, 1, 'grid1');
        renderPagination(1, totalPages1, 'pagin1', (page) => {
            displayProducts(filteredAll, page, 'grid1');
            renderPagination(page, totalPages1, 'pagin1', arguments.callee);
        });

        displayProducts(filteredBest, 1, 'grid2');
        renderPagination(1, totalPages2, 'pagin2', (page) => {
            displayProducts(filteredBest, page, 'grid2');
            renderPagination(page, totalPages2, 'pagin2', arguments.callee);
        });

        // Scroll fluide
        document.querySelector('.products-section')?.scrollIntoView({ behavior: 'smooth' });
    }

    // --- RESET FILTRES ---
    function resetFilters() {
        activeFilters = { price: null, brand: null, rating: null };
        updateSection1(1);
        updateSection2(1);
    }

    // --- ÉVÉNEMENTS FILTRES ---
    document.querySelectorAll('.filter-options-list a').forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const data = link.dataset;

            if (data.price) activeFilters.price = data.price;
            if (data.brand) activeFilters.brand = data.brand;
            if (data.rating) activeFilters.rating = data.rating;

            // Fermer le dropdown
            const checkbox = link.closest('.product-filter-item').querySelector('.filter-radio-input');
            if (checkbox) checkbox.checked = false;

            applyFilters();
        });
    });

    // --- BOUTON "TOUS LES FILTRES" ---
    const allFiltersBtn = document.querySelector('.filter-all-button');
    if (allFiltersBtn) {
        allFiltersBtn.addEventListener('click', (e) => {
            e.preventDefault();
            resetFilters();
        });
    }

    console.log('Filtres disques chargés - Marques : Seagate, WD, Toshiba, Samsung, Crucial, Kingston');
});