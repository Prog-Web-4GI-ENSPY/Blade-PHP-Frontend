document.addEventListener('DOMContentLoaded', () => {
    const productCards = document.querySelectorAll('#products-for-you-grid .product-card');
    const filterDropdownLinks = document.querySelectorAll('.tag-buttons-group .dropdown-content a');
    const allFiltersButton = document.querySelector('.filter-button.primary-filter');
    const filterNone = document.getElementById('none'); 
    
    // State object to hold the currently active filters
    let activeFilters = {
        price: null,
        brand: null,
        rating: null
    };

    /**
     * Applies the filters to all product cards.
     */
    const applyFilters = () => {
        let matchingCards = [];
        
        productCards.forEach(card => {
            let matches = true;

            const brand = card.dataset.brand ? card.dataset.brand.toLowerCase() : '';
            const price = parseFloat(card.dataset.priceRaw) || 0;
            const rating = parseFloat(card.dataset.ratingRaw) || 0;

            // 1. Brand Filtering (Case-insensitive partial match)
            if (activeFilters.brand) {
                const filterBrandNormalized = activeFilters.brand.toLowerCase();
                if (!brand.includes(filterBrandNormalized)) {
                    matches = false;
                }
            }

            // 2. Price Filtering (Range check)
            if (matches && activeFilters.price) {
                const [minStr, maxStr] = activeFilters.price.split('-');
                const minPrice = parseFloat(minStr);
                const maxPrice = maxStr === '+' ? Infinity : parseFloat(maxStr);

                if (price < minPrice || price > maxPrice) {
                    matches = false;
                }
            }

            // 3. Rating Filtering (Strict range logic)
            if (matches && activeFilters.rating) {
                const minRating = parseFloat(activeFilters.rating);

                // Define the strict rating boundaries based on the input
                let lowerBound, upperBound;
                
                if (minRating === 5) {
                    lowerBound = 4.75;
                    upperBound = 5.1; // Effectively filters up to 5.0
                } else if (minRating === 4.5) {
                    lowerBound = 4.25;
                    upperBound = 4.75; 
                } else {
                    lowerBound = minRating;
                    upperBound = minRating + 0.5; // e.g., 4 -> 4.5 (exclusive of 4.5)
                }
                
                if (rating < lowerBound || rating >= upperBound) {
                    matches = false;
                }
            }
            
            // Collect matching cards
            if (matches) {
                matchingCards.push(card);
                card.classList.remove('filtered-out');
            } else {
                card.classList.add('filtered-out');
            }
            
            // Hide all cards initially; visibility is handled below
            card.style.display = 'none';
        });
        
        // --- Display Logic ---
        // Only show the first 10 matching cards (as per the first script's original limit)
        matchingCards.slice(0, 10).forEach(card => {
            card.style.display = '';
        });

        // Handle "No Results" message
        const productGrid = document.getElementById('products-for-you-grid');
        let noResultsMessage = productGrid.querySelector('.no-results-message');
        
        if (matchingCards.length === 0) {
            if (!noResultsMessage) {
                noResultsMessage = document.createElement('p');
                noResultsMessage.classList.add('no-results-message');
                noResultsMessage.textContent = "No products.";
                // Append it to the grid container
                productGrid.appendChild(noResultsMessage);
            }
            noResultsMessage.style.display = '';
        } else {
            if (noResultsMessage) {
                noResultsMessage.style.display = 'none';
            }
        }
    };

    /**
     * Resets all filters and shows all product cards.
     */
    const resetFilters = () => {
        activeFilters = { price: null, brand: null, rating: null };
        productCards.forEach(card => {
            card.style.display = ''; // Show all
            card.classList.remove('filtered-out');
        });
        
        const noResultsMessage = document.querySelector('#products-for-you-grid .no-results-message');
        if (noResultsMessage) {
            noResultsMessage.style.display = 'none';
        }

        // Reset the dropdown toggle state
        filterNone.checked = true; 
    };

    // --- Event Listeners ---

    // 1. Dropdown Filter Links
    filterDropdownLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();

            // Set the active filter based on the clicked link's data attributes
            const dataAttributes = e.currentTarget.dataset;
            
            // Only one filter type (price, brand, or rating) is active at a time
            activeFilters.price = dataAttributes.price || null;
            activeFilters.brand = dataAttributes.brand || null;
            activeFilters.rating = dataAttributes.rating || null;
            
            applyFilters();

            // Close the dropdown after clicking (assuming 'none' is the radio/checkbox input)
            filterNone.checked = true;
        });
    });

    // 2. "All Filters" Button (Reset)
    allFiltersButton.addEventListener('click', () => {
        resetFilters();
    });
    
    // 3. Optional: Close dropdown on outside click
    document.addEventListener('click', (e) => {
        // Check if the click target or any ancestor is part of the filter UI
        const isClickInsideFilter = e.target.closest('.filter-dropdown') || 
                                    e.target.closest('.tag-buttons-group') ||
                                    e.target.closest('.filter-button');
        
        if (!isClickInsideFilter) {
            filterNone.checked = true;
        }
    });
});