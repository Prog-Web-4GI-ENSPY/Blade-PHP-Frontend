<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Détails Produit - Shopcart</title>
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/products_casque.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    
    <!-- Scripts -->
    <script src="{{ asset('assets/js/api-service.js') }}" defer></script>
    <script src="{{ asset('assets/js/universal-product-loader.js') }}" defer></script>
    <script src="{{ asset('assets/js/cart-manager.js') }}" defer></script>
    
    <!-- Script d'initialisation -->
    <script>
    document.addEventListener('DOMContentLoaded', async function() {
        console.log('🚀 Initialisation de la page détail produit...');
        
        // Récupérer l'ID du produit depuis l'URL
        const pathParts = window.location.pathname.split('/');
        const productId = pathParts[pathParts.length - 1];
        
        console.log('🆔 ID Produit:', productId);
        
        if (!productId || isNaN(productId)) {
            showError('ID produit invalide');
            return;
        }
        
        // Attendre que les services soient prêts
        await waitForService('apiService');
        await waitForService('cartManager');
        
        try {
            // 1. Charger les détails du produit
            await loadProductDetails(productId);
            
            // 2. Charger les recommandations
            await loadRecommendations();
            
            // 3. Initialiser les interactions
            initProductInteractions(productId);
            
        } catch (error) {
            console.error('❌ Erreur initialisation:', error);
            showError('Impossible de charger le produit');
        }
    });
    
    // Fonction pour charger les détails du produit
    async function loadProductDetails(productId) {
        console.log(`📦 Chargement des détails pour produit ${productId}...`);
        
        try {
            const response = await window.apiService.getProduct(productId);
            
            if (!response || !response.data) {
                throw new Error('Données produit non disponibles');
            }
            
            const product = response.data;
            console.log('✅ Produit chargé:', product.name);
            
            // Mettre à jour le titre de la page
            document.title = `${product.name} - Shopcart`;
            
            // Mettre à jour les éléments de la page
            updateProductElements(product);
            
        } catch (error) {
            console.error('❌ Erreur chargement produit:', error);
            throw error;
        }
    }
    
    // Fonction pour mettre à jour les éléments de la page
    function updateProductElements(product) {
        // Mettre à jour les éléments avec les données
        const elements = {
            'product-title': product.name,
            'product-subtitle': product.description || '',
            'product-price': formatPrice(product.price),
            'product-old-price': product.old_price ? formatPrice(product.old_price) : '',
            'main-image': product.image_url || product.image || '/assets/images/placeholder.jpg'
        };
        
        // Mettre à jour chaque élément
        for (const [elementId, value] of Object.entries(elements)) {
            const element = document.getElementById(elementId);
            if (element) {
                if (elementId === 'main-image') {
                    element.src = value;
                    element.alt = product.name;
                } else if (elementId === 'product-old-price') {
                    if (value) {
                        element.innerHTML = `<del>${value}</del>`;
                        element.style.display = 'inline';
                    } else {
                        element.style.display = 'none';
                    }
                } else {
                    element.textContent = value;
                }
            }
        }
        
        // Mettre à jour les attributs data
        const addToCartBtn = document.getElementById('btn-add-to-cart');
        if (addToCartBtn) {
            addToCartBtn.dataset.productId = product.id;
        }
        
        const buyNowBtn = document.getElementById('btn-buy-now');
        if (buyNowBtn) {
            buyNowBtn.dataset.productId = product.id;
        }
        
        // Mettre à jour le stock
        updateStockStatus(product.stock_quantity || 0);
    }
    
    // Fonction pour charger les recommandations
    async function loadRecommendations() {
        console.log('🔄 Chargement des recommandations...');
        
        if (!window.productLoader) {
            console.warn('⚠️ productLoader non disponible');
            return;
        }
        
        try {
            const gridConfig = {
                bestSellers: '#best-sellers-grid',
                forYou: '#products-for-you-grid'
            };
            
            // Essayer différentes catégories
            const categoryNames = ['Électronique', 'Casques audio', 'Audio'];
            
            for (const categoryName of categoryNames) {
                try {
                    const category = await window.apiService.findCategoryByName(categoryName);
                    
                    if (category) {
                        await window.productLoader.init(category.name, gridConfig, {
                            productsPerPage: 4
                        });
                        console.log(`✅ Recommandations chargées avec "${category.name}"`);
                        break;
                    }
                } catch (error) {
                    console.warn(`⚠️ Erreur avec "${categoryName}":`, error.message);
                    continue;
                }
            }
            
        } catch (error) {
            console.error('❌ Erreur chargement recommandations:', error);
        }
    }
    
    // Fonction pour initialiser les interactions
    function initProductInteractions(productId) {
        console.log('🎨 Initialisation des interactions...');
        
        // 1. Gestion des quantités
        const minusBtn = document.querySelector('.quantity-btn:first-child');
        const plusBtn = document.querySelector('.quantity-btn:last-child');
        const quantityDisplay = document.querySelector('.quantity-display');
        
        if (minusBtn && plusBtn && quantityDisplay) {
            minusBtn.addEventListener('click', function() {
                let quantity = parseInt(quantityDisplay.textContent);
                if (quantity > 1) {
                    quantity--;
                    quantityDisplay.textContent = quantity;
                }
            });
            
            plusBtn.addEventListener('click', function() {
                let quantity = parseInt(quantityDisplay.textContent);
                if (quantity < 10) {
                    quantity++;
                    quantityDisplay.textContent = quantity;
                }
            });
        }
        
        // 2. Bouton "Ajouter au panier"
        const addBtn = document.getElementById('btn-add-to-cart');
        if (addBtn) {
            addBtn.addEventListener('click', async function() {
                const quantity = parseInt(document.querySelector('.quantity-display').textContent) || 1;
                
                if (window.cartManager) {
                    try {
                        // Animation du bouton
                        const originalHTML = addBtn.innerHTML;
                        addBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Ajout...';
                        addBtn.disabled = true;
                        
                        await window.cartManager.addToCart(productId, quantity);
                        
                        // Réinitialiser le bouton
                        setTimeout(() => {
                            addBtn.innerHTML = originalHTML;
                            addBtn.disabled = false;
                        }, 1000);
                        
                    } catch (error) {
                        console.error('❌ Erreur ajout panier:', error);
                        alert('Erreur: ' + error.message);
                    }
                }
            });
        }
        
        // 3. Bouton "Acheter maintenant"
        const buyBtn = document.getElementById('btn-buy-now');
        if (buyBtn) {
            buyBtn.addEventListener('click', async function() {
                const quantity = parseInt(document.querySelector('.quantity-display').textContent) || 1;
                
                if (window.cartManager) {
                    try {
                        await window.cartManager.addToCart(productId, quantity);
                        
                        // Rediriger vers le panier
                        window.location.href = '/panier';
                        
                    } catch (error) {
                        console.error('❌ Erreur achat:', error);
                        alert('Erreur: ' + error.message);
                    }
                }
            });
        }
        
        // 4. Changement d'image sur miniatures
        const thumbnails = document.querySelectorAll('.thumbnail');
        const mainImage = document.getElementById('main-image');
        
        if (thumbnails.length > 0 && mainImage) {
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
                    thumbnails.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    const img = this.querySelector('img');
                    if (img && img.dataset.image) {
                        mainImage.src = img.dataset.image;
                    }
                });
            });
        }
        
        // 5. Sélection de couleur
        const colorOptions = document.querySelectorAll('.color-option');
        const selectedColorText = document.getElementById('selected-color');
        
        if (colorOptions.length > 0) {
            colorOptions.forEach(option => {
                option.addEventListener('click', function() {
                    colorOptions.forEach(o => o.classList.remove('active'));
                    this.classList.add('active');
                    
                    if (selectedColorText) {
                        const color = this.getAttribute('data-color') || 'Couleur';
                        selectedColorText.textContent = color;
                    }
                });
            });
        }
    }
    
    // Fonction pour mettre à jour le statut du stock
    function updateStockStatus(stockQuantity) {
        const stockElement = document.getElementById('product-stock');
        const addToCartBtn = document.getElementById('btn-add-to-cart');
        const buyNowBtn = document.getElementById('btn-buy-now');
        
        if (!stockElement) return;
        
        const isInStock = stockQuantity > 0;
        
        if (isInStock) {
            stockElement.innerHTML = `
                <i class="fas fa-check-circle"></i>
                En stock (${stockQuantity} disponible${stockQuantity > 1 ? 's' : ''})
            `;
            stockElement.className = 'product-stock in-stock';
            
            if (addToCartBtn) addToCartBtn.disabled = false;
            if (buyNowBtn) buyNowBtn.disabled = false;
        } else {
            stockElement.innerHTML = `
                <i class="fas fa-times-circle"></i>
                Rupture de stock
            `;
            stockElement.className = 'product-stock out-of-stock';
            
            if (addToCartBtn) addToCartBtn.disabled = true;
            if (buyNowBtn) buyNowBtn.disabled = true;
        }
    }
    
    // Fonctions utilitaires
    function waitForService(serviceName) {
        return new Promise(resolve => {
            const checkService = setInterval(() => {
                if (window[serviceName]) {
                    clearInterval(checkService);
                    resolve();
                }
            }, 100);
        });
    }
    
    function formatPrice(price) {
        if (!price && price !== 0) return 'Prix N/A';
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'XOF',
            minimumFractionDigits: 0
        }).format(price);
    }
    
    function showError(message) {
        const container = document.querySelector('.product-detail-container');
        if (container) {
            container.innerHTML = `
                <div style="text-align: center; padding: 60px 20px; grid-column: 1 / -1;">
                    <i class="fas fa-exclamation-triangle fa-3x" style="color: #dc2626;"></i>
                    <h2>Erreur</h2>
                    <p>${message}</p>
                    <a href="{{ route('catalogue') }}" class="btn-continue-shopping" style="margin-top: 20px;">
                        <i class="fas fa-arrow-left"></i>
                        Retour au catalogue
                    </a>
                </div>
            `;
        }
    }
    </script>
    
    <style>
    .product-stock {
        padding: 0.5rem;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        margin: 1rem 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .product-stock.in-stock {
        background-color: #dcfce7;
        color: #059669;
    }
    
    .product-stock.out-of-stock {
        background-color: #fee2e2;
        color: #dc2626;
    }
    
    .old-price {
        display: inline-block;
        margin-right: 0.5rem;
        color: #9ca3af;
    }
    </style>
</head>
@extends('layouts.app')

@section('title', 'Détails Produit - Shopcart')

@section('content')
<main class="main-content-container">
    
    <!-- Section détail produit -->
    <div class="product-detail-container">
        <div class="product-detail-flex">
            <!-- Images produit -->
            <div class="product-detail-left">
                <div class="image-gallery-box">
                    <div class="main-product-image">
                        <img id="main-image" src="/assets/images/placeholder.jpg" alt="Produit">
                    </div>
                    <div class="thumbnail-row">
                        <div class="thumbnail active">
                            <img src="/assets/images/placeholder-thumb.jpg" alt="Miniature" 
                                 data-image="/assets/images/placeholder.jpg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations produit -->
            <div class="product-detail-right">
                <div class="product-info-box">
                    <div class="new-tag-wrapper">
                        <span class="new-tag">Nouveau</span>
                    </div>
                    <h1 id="product-title" class="product-title">Chargement...</h1>
                    <p id="product-subtitle" class="product-subtitle"></p>
                    
                    <div class="rating-info">
                        <div class="stars-list">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <span class="rating-text">4.7 (738 avis)</span>
                    </div>

                    <div class="price-info">
                        <span id="product-old-price" class="old-price" style="display: none;"></span>
                        <span id="product-price" class="main-price">Chargement...</span>
                        <span class="tax-info">TTC</span>
                    </div>
                    
                    <!-- Statut du stock -->
                    <div id="product-stock" class="product-stock">
                        <i class="fas fa-spinner fa-spin"></i>
                        Vérification du stock...
                    </div>

                    <div class="color-selection-area">
                        <h3 class="color-selection-title">Choisissez une couleur</h3>
                        <div class="color-options-row">
                            <div class="color-option active" style="background-color: #E91E63;" data-color="Rose"></div>
                            <div class="color-option" style="background-color: #4FC3F7;" data-color="Bleu"></div>
                            <div class="color-option" style="background-color: #4CAF50;" data-color="Vert"></div>
                            <div class="color-option" style="background-color: #8BC34A;" data-color="Vert clair"></div>
                        </div>
                        <span class="selected-color-text">Couleur sélectionnée: <span id="selected-color">Rose</span></span>
                    </div>

                    <div class="quantity-cart-area">
                        <div class="quantity-control">
                            <span class="quantity-label">Quantité:</span>
                            <div class="quantity-buttons-wrapper">
                                <button class="quantity-btn">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span class="quantity-display">1</span>
                                <button class="quantity-btn">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons-row">
                        <button id="btn-buy-now" class="btn-buy">
                            <i class="fas fa-bolt icon-margin"></i>
                            Acheter maintenant
                        </button>
                        <button id="btn-add-to-cart" class="btn-add">
                            <i class="fas fa-shopping-cart icon-margin"></i>
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Section: Best Sellers -->
    <section class="products-section">
        <h2 class="section-title" id="title-best-sellers">
            <span class="gradient-blue-purple">Best Sellers</span>
        </h2>
        <p class="section-subtitle">Nos meilleures ventes</p>
        <div class="products-grid" id="best-sellers-grid">
            <div class="loader" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-spinner fa-spin fa-2x" style="color: #3b82f6;"></i>
                <p>Chargement des recommandations...</p>
            </div>
        </div>
    </section>
    
    <!-- Pagination Best Sellers -->
    <div class="pagination" id="pagination-best-sellers">
        <button class="page-btn" disabled data-direction="prev" data-grid-id="best-sellers-grid">
            <i class="fas fa-chevron-left"></i> Précédent
        </button>
        <button class="page-num-active" data-page="1" data-grid-id="best-sellers-grid">1</button>
        <button class="page-btn" data-direction="next" data-grid-id="best-sellers-grid">
            Suivant <i class="fas fa-chevron-right"></i>
        </button>
    </div>
    
    <div class="progress-bar-row">
        <hr class="progress-bar-segment-1">
        <hr class="progress-bar-segment-2">
        <hr class="progress-bar-segment-3">
    </div>
    
    <!-- Section: Produits pour vous -->
    <section class="products-section">
        <h2 class="section-title" id="title-for-you">
            <span class="gradient-blue-purple">Produits pour vous</span>
        </h2>
        <p class="section-subtitle">Sélection basée sur vos préférences</p>
        <div class="products-grid" id="products-for-you-grid">
            <div class="loader" style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-spinner fa-spin fa-2x" style="color: #3b82f6;"></i>
                <p>Chargement des suggestions...</p>
            </div>
        </div>
    </section>
    
    <!-- Pagination Produits pour vous -->
    <div class="pagination" id="pagination-for-you">
        <button class="page-btn" disabled data-direction="prev" data-grid-id="products-for-you-grid">
            <i class="fas fa-chevron-left"></i> Précédent
        </button>
        <button class="page-num-active" data-page="1" data-grid-id="products-for-you-grid">1</button>
        <button class="page-btn" data-direction="next" data-grid-id="products-for-you-grid">
            Suivant <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</main>
@endsection