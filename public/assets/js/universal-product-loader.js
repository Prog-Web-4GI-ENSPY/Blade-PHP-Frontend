// universal-product-loader.js
class UniversalProductLoader {
    constructor() {
        this.api = window.apiService;
        this.currentCategory = null;
        this.config = {
            productsPerPage: 8,
            defaultImage: 'https://placehold.co/300x200'
        };
        this.gridConfig = null;
        this.isInitialized = false;
    }

    /**
     * Initialise le chargement pour une catégorie
     */
    async init(categoryName, gridConfig = {}, options = {}) {
        console.log(`🎯 UniversalProductLoader - Initialisation pour: "${categoryName}"`);
        
        if (this.isInitialized) {
            console.log('⚠️ Déjà initialisé, rafraîchissement...');
            await this.refresh();
            return;
        }
        
        this.gridConfig = gridConfig;
        this.options = { ...this.config, ...options };
        
        try {
            // 1. Debug: Afficher toutes les catégories disponibles
            await this.showAvailableCategories();
            
            // 2. Trouver la catégorie spécifique
            this.currentCategory = await this.findCategory(categoryName);
            if (!this.currentCategory) {
                console.error(`❌ Catégorie "${categoryName}" non trouvée`);
                return;
            }
            
            // 3. Charger les produits
            await this.loadProductsForAllGrids();
            
            // 4. Initialiser les événements
            this.initEventListeners();
            
            this.isInitialized = true;
            console.log('✅ UniversalProductLoader initialisé avec succès');
            
        } catch (error) {
            console.error('❌ Erreur UniversalProductLoader:', error);
            this.showErrorOnAllGrids(`Erreur: ${error.message}`);
        }
    }

    /**
     * Affiche les catégories disponibles pour débogage
     */
    async showAvailableCategories() {
        try {
            const categories = await this.api.getAllCategories();
            console.log('📊 === CATÉGORIES DISPONIBLES ===');
            categories.forEach(cat => {
                console.log(`  • ${cat.id}: "${cat.name}" (slug: "${cat.slug}")`);
            });
            console.log('================================');
            return categories;
        } catch (error) {
            console.warn('⚠️ Impossible d\'afficher les catégories:', error);
            return [];
        }
    }

    /**
     * Trouve une catégorie par son nom
     */
    async findCategory(categoryName) {
        console.log(`🔍 Recherche catégorie: "${categoryName}"`);
        
        // D'abord essayer avec le nom exact
        let category = await this.api.findCategoryByName(categoryName);
        
        if (!category) {
            console.log('🔄 Essai avec variations...');
            
            // Générer des variations
            const variations = this.generateCategoryVariations(categoryName);
            
            for (const variation of variations) {
                console.log(`  → Essai: "${variation}"`);
                category = await this.api.findCategoryByName(variation);
                if (category) {
                    console.log(`✅ Trouvé avec variation: "${variation}"`);
                    return category;
                }
            }
            
            // Si toujours pas trouvé, chercher manuellement
            const allCategories = await this.api.getAllCategories();
            const searchLower = categoryName.toLowerCase();
            
            // Chercher par inclusion
            category = allCategories.find(cat => {
                const catNameLower = cat.name.toLowerCase();
                const catSlugLower = cat.slug ? cat.slug.toLowerCase() : '';
                
                return catNameLower.includes(searchLower) || 
                       searchLower.includes(catNameLower) ||
                       (catSlugLower && catSlugLower.includes(searchLower));
            });
            
            if (!category && allCategories.length > 0) {
                // Prendre la première catégorie comme fallback
                console.log(`⚠️ Catégorie non trouvée, utilisation de la première catégorie disponible`);
                category = allCategories[0];
            }
        }
        
        if (category) {
            console.log(`✅ Catégorie sélectionnée: "${category.name}" (ID: ${category.id})`);
        }
        
        return category;
    }

    /**
     * Génère des variations de nom de catégorie
     */
    generateCategoryVariations(name) {
        const variations = [];
        const lowerName = name.toLowerCase();
        
        // Variations pour "Casques audio"
        if (lowerName.includes('casque') || lowerName.includes('audio') || lowerName.includes('son')) {
            variations.push(
                'Casques audio',
                'casques audio',
                'Casque audio',
                'casque audio',
                'Audio',
                'audio',
                'Électronique',
                'électronique',
                'Écouteurs',
                'écouteurs'
            );
        }
        
        // Variations pour "Électronique"
        if (lowerName.includes('électronique') || lowerName.includes('electronique')) {
            variations.push(
                'Électronique',
                'électronique',
                'Electronique',
                'electronique',
                'Informatique',
                'informatique',
                'High-tech',
                'high-tech'
            );
        }
        
        // Variations pour "Téléphones"
        if (lowerName.includes('téléphone') || lowerName.includes('telephone')) {
            variations.push(
                'Téléphones portables',
                'téléphones portables',
                'Téléphone portable',
                'téléphone portable',
                'Smartphones',
                'smartphones',
                'Téléphones',
                'téléphones'
            );
        }
        
        // Variations pour "Manettes"
        if (lowerName.includes('manette')) {
            variations.push('Manettes', 'manettes', 'Manette', 'manette');
        }
        
        // Variations pour "Disques durs"
        if (lowerName.includes('disque') || lowerName.includes('dur')) {
            variations.push('Disques durs', 'disques durs', 'Disque dur', 'disque dur');
        }
        
        return [...new Set(variations)]; // Supprimer les doublons
    }

    /**
     * Affiche une erreur quand la catégorie n'est pas trouvée
     */
    async showCategoryError(searchName) {
        try {
            const categories = await this.api.getAllCategories();
            
            const errorHtml = `
                <div class="category-error" style="grid-column: 1 / -1;">
                    <div style="background: linear-gradient(135deg, #fff5f5 0%, #fed7d7 100%); 
                                border: 2px solid #fc8181; border-radius: 12px; padding: 2rem; margin: 2rem 0;">
                        <h3 style="color: #c53030; font-size: 1.5rem; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.75rem;">
                            <i class="fas fa-exclamation-triangle"></i> Catégorie non trouvée
                        </h3>
                        <p style="color: #4a5568; margin-bottom: 1.5rem;">
                            La catégorie <strong>"${searchName}"</strong> n'existe pas.
                        </p>
                        
                        <div style="background: white; border-radius: 8px; padding: 1rem; border: 1px solid #e2e8f0;">
                            <h4 style="color: #4a5568; margin: 0 0 1rem 0;">Catégories disponibles :</h4>
                            ${categories.map(cat => `
                                <div style="display: flex; justify-content: space-between; align-items: center; 
                                            padding: 0.75rem 1rem; border-bottom: 1px solid #edf2f7;">
                                    <span style="font-weight: 600; color: #2d3748;">"${cat.name}"</span>
                                    <span style="color: #718096; font-size: 0.875rem; background: #edf2f7; 
                                            padding: 0.25rem 0.5rem; border-radius: 4px;">
                                        ID: ${cat.id}
                                    </span>
                                </div>
                            `).join('')}
                        </div>
                        
                        <div style="background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%); 
                                    border: 1px solid #81e6d9; border-radius: 8px; padding: 1rem; 
                                    margin-top: 1.5rem; display: flex; align-items: center; gap: 0.75rem; color: #234e52;">
                            <i class="fas fa-lightbulb"></i>
                            <span>Essayez l'un des noms exacts ci-dessus.</span>
                        </div>
                    </div>
                </div>
            `;
            
            this.showErrorOnAllGrids(errorHtml);
            
        } catch (error) {
            this.showErrorOnAllGrids(`Catégorie "${searchName}" non trouvée`);
        }
    }

    /**
     * Charge les produits pour toutes les grilles
     */
    async loadProductsForAllGrids() {
        console.log(`📦 Chargement produits pour "${this.currentCategory.name}"`);
        
        if (!this.gridConfig || Object.keys(this.gridConfig).length === 0) {
            console.warn('⚠️ Aucune configuration de grille définie');
            return;
        }
        
        for (const [gridType, selector] of Object.entries(this.gridConfig)) {
            const gridElement = document.querySelector(selector);
            
            if (!gridElement) {
                console.warn(`⚠️ Grille non trouvée: ${selector}`);
                continue;
            }
            
            await this.loadProductsForGrid(gridElement, gridType);
        }
    }

    /**
     * Charge les produits pour une grille spécifique
     */
    async loadProductsForGrid(gridElement, gridType) {
        console.log(`  → Grille: ${gridType}`);
        
        // Afficher le loader
        this.showLoader(gridElement);
        
        try {
            // Déterminer les filtres
            const filters = {};
            if (gridType.includes('featured') || gridType.includes('vedette')) {
                filters.is_featured = true;
            }
            if (gridType.includes('promo') || gridType.includes('promotion')) {
                filters.has_discount = true;
            }
            
            // Charger les produits
            const response = await this.api.getProductsByCategoryId(
                this.currentCategory.id,
                {
                    filters: filters,
                    limit: this.options.productsPerPage,
                    page: 1
                }
            );
            
            // Vérifier la réponse
            if (response && response.data) {
                this.displayProducts(gridElement, response.data, gridType);
            } else {
                this.showNoProducts(gridElement, gridType);
            }
            
        } catch (error) {
            console.error(`❌ Erreur sur ${gridType}:`, error);
            this.showError(gridElement, `Erreur de chargement: ${error.message}`);
        }
    }

    /**
     * Affiche les produits dans une grille
     */
    displayProducts(gridElement, products, gridType) {
        gridElement.innerHTML = '';
        
        if (!products || products.length === 0) {
            this.showNoProducts(gridElement, gridType);
            return;
        }
        
        console.log(`    ✅ ${products.length} produit(s) affiché(s) dans ${gridType}`);
        
        products.forEach(product => {
            const card = this.createProductCard(product);
            gridElement.appendChild(card);
        });
    }

    /**
     * Crée une carte produit
     */
createProductCard(product) {
    const card = document.createElement('div');
    card.className = 'product-card';
    card.dataset.productId = product.id;
    
    // Formater les données
    const price = this.formatPrice(product.price);
    const oldPrice = product.old_price ? this.formatPrice(product.old_price) : null;
    const discount = product.discount_percent || 0;
    const rating = product.rating || 0;
    const inStock = product.stock > 0;
    const imageUrl = product.image_url || product.image || this.config.defaultImage;
    const productUrl = `/products/${product.id}`; // URL du détail

    // Déterminer le tag
    let tagHtml = '';
    if (discount > 0) {
        tagHtml = `<div class="product-tag tag-promo">-${discount}%</div>`;
    } else if (product.is_featured) {
        tagHtml = `<div class="product-tag tag-best-seller">TOP VENTE</div>`;
    } else if (product.is_new) {
        tagHtml = `<div class="product-tag tag-new">NOUVEAU</div>`;
    }
    
    // CORRECTION : Ne pas mettre tout dans un seul lien
   card.innerHTML = `
        <div class="product-image-wrapper">
            <a href="${productUrl}" class="product-image-link">
                <img src="${imageUrl}" alt="${product.name}" class="product-image" 
                     onerror="this.src='${this.config.defaultImage}'">
            </a>
            ${tagHtml}
        </div>
        
        <div class="product-info">
            <a href="${productUrl}" class="product-title-link">
                <p class="product-brand">${product.brand || 'Marque'}</p>
                <h3 class="product-title-card">${this.truncateText(product.name, 50)}</h3>
            </a>
            
            <div class="rating-info">
                <div class="stars-list">${this.createStars(rating)}</div>
                <span class="rating-text">(${rating.toFixed(1)})</span>
            </div>
            
            <div class="product-actions">
                <div class="price-info">
                    ${oldPrice ? `<span class="old-price">${oldPrice}</span>` : ''}
                    <span class="product-price">${price}</span>
                </div>
                <button class="add-to-cart-btn" data-product-id="${product.id}" 
                        ${!inStock ? 'disabled' : ''}
                        title="${!inStock ? 'Rupture de stock' : 'Ajouter au panier'}">
                    <i class="fas fa-shopping-cart"></i>
                </button>
            </div>
            
            <div class="product-stock ${inStock ? 'in-stock' : 'out-of-stock'}">
                <i class="fas ${inStock ? 'fa-check-circle' : 'fa-times-circle'}"></i>
                ${inStock ? 'En stock' : 'Rupture de stock'}
            </div>
        </div>
    `;
    
    return card;
}

    /**
     * Affiche un message "pas de produits"
     */
    showNoProducts(gridElement, gridType) {
        const typeLabel = gridType.includes('featured') ? 'en vedette' : 
                         gridType.includes('promo') ? 'en promotion' : 
                         '';
        
        gridElement.innerHTML = `
            <div class="no-products" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-box-open fa-3x" style="color: #9ca3af; margin-bottom: 20px;"></i>
                <h3 style="color: #374151; margin-bottom: 10px;">Aucun produit ${typeLabel}</h3>
                <p style="color: #6b7280;">
                    Aucun produit ${typeLabel ? typeLabel + ' ' : ''}dans la catégorie 
                    <strong>"${this.currentCategory.name}"</strong>.
                </p>
            </div>
        `;
    }

    /**
     * Initialise les événements
     */
    initEventListeners() {
        // Gestion du clic sur les boutons "ajouter au panier"
        document.addEventListener('click', async (e) => {
            const addToCartBtn = e.target.closest('.add-to-cart-btn');
            
            if (addToCartBtn && !addToCartBtn.disabled) {
                e.preventDefault();
                e.stopPropagation();
                
                const productId = addToCartBtn.dataset.productId;
                
                // Animation visuelle
                addToCartBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                addToCartBtn.disabled = true;
                
                try {
                    await this.addToCart(productId);
                    
                    // Animation de succès
                    addToCartBtn.innerHTML = '<i class="fas fa-check"></i>';
                    addToCartBtn.style.backgroundColor = '#10b981';
                    addToCartBtn.style.borderColor = '#10b981';
                    
                    setTimeout(() => {
                        addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i>';
                        addToCartBtn.style.backgroundColor = '';
                        addToCartBtn.style.borderColor = '';
                        addToCartBtn.disabled = false;
                    }, 1500);
                    
                } catch (error) {
                    // Animation d'erreur
                    addToCartBtn.innerHTML = '<i class="fas fa-exclamation"></i>';
                    addToCartBtn.style.backgroundColor = '#ef4444';
                    addToCartBtn.style.borderColor = '#ef4444';
                    
                    setTimeout(() => {
                        addToCartBtn.innerHTML = '<i class="fas fa-shopping-cart"></i>';
                        addToCartBtn.style.backgroundColor = '';
                        addToCartBtn.style.borderColor = '';
                        addToCartBtn.disabled = false;
                    }, 1500);
                    
                    console.error('Erreur ajout panier:', error);
                }
            }
        });
    }

    /**
     * Méthodes utilitaires
     */
    formatPrice(price) {
        if (!price && price !== 0) return 'Prix N/A';
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'XOF',
            minimumFractionDigits: 0
        }).format(price);
    }

    createStars(rating) {
        let stars = '';
        for (let i = 1; i <= 5; i++) {
            if (i <= Math.floor(rating)) {
                stars += '<i class="fas fa-star"></i>';
            } else if (i === Math.ceil(rating) && rating % 1 >= 0.5) {
                stars += '<i class="fas fa-star-half-alt"></i>';
            } else {
                stars += '<i class="far fa-star"></i>';
            }
        }
        return stars;
    }

    truncateText(text, maxLength) {
        if (!text) return '';
        if (text.length <= maxLength) return text;
        return text.substring(0, maxLength) + '...';
    }

    showLoader(element) {
        element.innerHTML = `
            <div class="loader" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <div class="spinner">
                    <i class="fas fa-spinner fa-spin fa-3x" style="color: #3b82f6;"></i>
                </div>
                <p style="color: #4b5563; margin-top: 20px; font-size: 1.1rem;">Chargement des produits...</p>
            </div>
        `;
    }

    showError(element, message) {
        element.innerHTML = `
            <div class="error" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-exclamation-triangle fa-3x" style="color: #dc2626; margin-bottom: 20px;"></i>
                <p style="color: #374151; margin-bottom: 20px; font-size: 1.1rem;">${message}</p>
                <button class="retry-btn" onclick="location.reload()" 
                        style="background-color: #1e40af; color: white; border: none; padding: 0.75rem 1.5rem; 
                               border-radius: 0.5rem; cursor: pointer; font-weight: 500;">
                    <i class="fas fa-redo"></i> Réessayer
                </button>
            </div>
        `;
    }

    showErrorOnAllGrids(message) {
        if (!this.gridConfig) return;
        
        Object.values(this.gridConfig).forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                element.innerHTML = `
                    <div class="global-error" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                        ${message}
                    </div>
                `;
            }
        });
    }

    /**
     * Actions
     */
   async addToCart(productId) {
    try {
        if (window.cartManager) {
            await window.cartManager.addToCart(productId, 1);
        } else {
            // Fallback à l'API directe
            await this.api.addToCart(productId, 1);
            this.showNotification('Produit ajouté au panier', 'success');
        }
    } catch (error) {
        this.showNotification('Erreur: ' + error.message, 'error');
    }
}

    viewProduct(productId) {
        window.location.href = `/products/${productId}`;
    }

    showNotification(message, type = 'info') {
        // Créer le style si nécessaire
        if (!document.getElementById('notification-styles')) {
            const style = document.createElement('style');
            style.id = 'notification-styles';
            style.textContent = `
                .universal-notification {
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    padding: 15px 20px;
                    background: #059669;
                    color: white;
                    border-radius: 8px;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                    z-index: 10000;
                    transform: translateX(120%);
                    transition: transform 0.3s ease;
                    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
                    min-width: 300px;
                }
                
                .universal-notification.show {
                    transform: translateX(0);
                }
                
                .universal-notification.error {
                    background: #dc2626;
                }
                
                .universal-notification.info {
                    background: #3b82f6;
                }
            `;
            document.head.appendChild(style);
        }
        
        const notification = document.createElement('div');
        notification.className = `universal-notification ${type}`;
        notification.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check' : 'exclamation'}-circle"></i>
            <span>${message}</span>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => notification.classList.add('show'), 10);
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }

    /**
     * Rafraîchir
     */
    async refresh() {
        if (this.currentCategory && this.gridConfig) {
            console.log('🔄 Actualisation des produits...');
            await this.loadProductsForAllGrids();
        }
    }
}

// Instance globale
window.productLoader = new UniversalProductLoader();