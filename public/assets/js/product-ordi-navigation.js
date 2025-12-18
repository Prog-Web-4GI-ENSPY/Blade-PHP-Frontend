// ============================================
// product-ordi-navigation.js - VERSION SIMPLIFIÉE
// UNIQUEMENT pour products_ordi.html (page listing)
// NE GÈRE QUE les clics sur cartes produits
// ============================================

// Ne s'exécute PAS sur la page détail
if (window.location.pathname.includes('product_ordi-detail.html')) {
    console.log('⏩ Page détail détectée, product-ordi-navigation.js désactivé');
} else {
    let isUpdating = false;
    let observer = null;

    // Fonction principale : attache les clics sur les cartes produits
    function attachProductNavigation() {
        if (isUpdating) return;
        isUpdating = true;

        try {
            const productCards = document.querySelectorAll('.product-card');
            console.log('🔗 Attachement navigation sur', productCards.length, 'cartes');

            productCards.forEach(card => {
                // Nettoyer les anciens événements
                const handler = card._clickHandler;
                if (handler) {
                    card.removeEventListener('click', handler);
                }

                const handleClick = function (e) {
                    if (e.target.closest('.add-to-cart-btn')) return;
                    e.preventDefault();

                    let productInfo = {};

                    // 1. Priorité : data-product
                    const dataProduct = this.getAttribute('data-product');
                    if (dataProduct) {
                        try {
                            productInfo = JSON.parse(dataProduct);
                        } catch (err) {
                            console.error('Erreur data-product:', err);
                        }
                    }

                    // 2. Sinon : extraire du DOM
                    if (!productInfo.title) {
                        productInfo = {
                            brand: this.querySelector('.product-brand')?.textContent.trim() || '',
                            title: this.querySelector('.product-title-card')?.textContent.trim() || '',
                            price: this.querySelector('.product-price')?.textContent.trim() || '',
                            rating: this.querySelector('.rating-text')?.textContent.trim() || '',
                            image: this.querySelector('.product-image')?.src || '',
                            tag: this.querySelector('.product-tag')?.textContent.trim() || 'PREMIUM',
                            stars: Array.from(this.querySelectorAll('.stars-list i'))
                                .filter(i => i.classList.contains('fas') && !i.classList.contains('fa-star-half-alt')).length
                        };
                    }

                    console.log('🖱️ Clic produit:', productInfo.title);
                    sessionStorage.setItem('selectedProduct', JSON.stringify(productInfo));
                    window.location.href = 'product_ordi-detail.html';
                };

                // Stocker pour nettoyage futur
                card._clickHandler = handleClick;
                card.addEventListener('click', handleClick);
                card.style.cursor = 'pointer';
            });
        } finally {
            setTimeout(() => { isUpdating = false; }, 100);
        }
    }

    // Exporter pour pagination_ordi.js
    window.attachProductNavigation = attachProductNavigation;

    // Initialisation + Observation des grilles
    document.addEventListener('DOMContentLoaded', function () {
        console.log('🚀 product-ordi-navigation.js - Initialisation (page listing)');
        attachProductNavigation();

        // Observer les deux grilles (grid1, grid2)
        const grids = ['grid1', 'grid2'].map(id => document.getElementById(id)).filter(Boolean);

        if (grids.length > 0 && !observer) {
            observer = new MutationObserver(function (mutations) {
                let shouldUpdate = false;
                mutations.forEach(mutation => {
                    if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                        shouldUpdate = true;
                    }
                });

                if (shouldUpdate && !isUpdating) {
                    observer.disconnect();
                    setTimeout(() => {
                        attachProductNavigation();
                        grids.forEach(grid => observer.observe(grid, { childList: true, subtree: true }));
                    }, 50);
                }
            });

            grids.forEach(grid => {
                observer.observe(grid, { childList: true, subtree: true });
            });
            console.log('👀 Observer activé sur', grids.length, 'grilles');
        }
    });

    console.log('✅ product-ordi-navigation.js chargé (PAGE LISTING uniquement)');
}