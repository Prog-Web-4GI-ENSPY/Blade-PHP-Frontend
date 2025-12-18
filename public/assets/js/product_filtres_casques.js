document.addEventListener('DOMContentLoaded', () => {
    const productCards = document.querySelectorAll('#products-for-you-grid .product-card');
    const filterDropdownLinks = document.querySelectorAll('.tag-buttons-group .dropdown-content a');
    const allFiltersButton = document.querySelector('.filter-button.primary-filter');
    const filterNone = document.getElementById('none');

    let activeFilters = {
        price: null,
        brand: null,
        rating: null
    };

    const applyFilters = () => {
        let matchingCards = [];
        
        productCards.forEach(card => {
            let matches = true;

            const brand = card.dataset.brand ? card.dataset.brand.toLowerCase() : '';
            const price = parseFloat(card.dataset.priceRaw) || 0;
            const rating = parseFloat(card.dataset.ratingRaw) || 0;

            if (activeFilters.brand) {
                const filterBrandNormalized = activeFilters.brand.toLowerCase();
                if (!brand.includes(filterBrandNormalized)) {
                    matches = false;
                }
            }

            if (matches && activeFilters.price) {
                const [minStr, maxStr] = activeFilters.price.split('-');
                const minPrice = parseFloat(minStr);
                const maxPrice = maxStr === '+' ? Infinity : parseFloat(maxStr);

                if (price < minPrice || price > maxPrice) {
                    matches = false;
                }
            }

            if (matches && activeFilters.rating) {
                const minRating = parseFloat(activeFilters.rating);
                let lowerBound, upperBound;
                
                if (minRating === 5) {
                    lowerBound = 4.75;
                    upperBound = 5.1;
                } else if (minRating === 4.5) {
                    lowerBound = 4.25;
                    upperBound = 4.75;
                } else {
                    lowerBound = minRating;
                    upperBound = minRating + 0.5;
                }
                
                if (rating < lowerBound || rating >= upperBound) {
                    matches = false;
                }
            }
            
            if (matches) {
                matchingCards.push(card);
                card.style.display = 'none'; 
                card.classList.remove('filtered-out');
            } else {
                card.style.display = 'none';
                card.classList.add('filtered-out');
            }
        });
        
        matchingCards.slice(0, 10).forEach(card => {
            card.style.display = '';
        });
    };

    const resetFilters = () => {
        activeFilters = { price: null, brand: null, rating: null };
        productCards.forEach(card => {
            card.style.display = ''; 
            card.classList.remove('filtered-out');
        });
        filterNone.checked = true;
    };

    filterDropdownLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const dataAttributes = e.currentTarget.dataset;
            activeFilters.price = dataAttributes.price || null;
            activeFilters.brand = dataAttributes.brand || null;
            activeFilters.rating = dataAttributes.rating || null;
            applyFilters();
            filterNone.checked = true;
        });
    });

    allFiltersButton.addEventListener('click', () => {
        resetFilters();
    });
});
