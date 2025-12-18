/* ==============================================================
   pagination-detail-ordi.js - VERSION FINALE CORRIGÉE
   - Miniatures visibles et fonctionnelles
   - Quantité incrémente de 1 (pas 2)
   - Aucun conflit d'événements
   ============================================================== */

// Protection contre double exécution
if (window._detailPageInitialized) {
    console.warn('⚠️ Script déjà initialisé, arrêt pour éviter conflits');
} else {
    window._detailPageInitialized = true;

    document.addEventListener('DOMContentLoaded', () => {
        // Vérifier qu'on est bien sur la page détail
        if (!window.location.pathname.includes('product_ordi-detail.html')) {
            console.log('⏩ Pas sur page détail, skip');
            return;
        }

        console.log('🚀 Initialisation page détail...');
        let isNavigating = false;

        /* =================================================
           1. CHARGEMENT DU PRODUIT ACTUEL
           ================================================= */
        const currentProductData = sessionStorage.getItem('selectedProduct');
        let product = null;

        if (currentProductData) {
            try {
                product = JSON.parse(currentProductData);
                console.log('📦 Produit chargé:', product.title);

                // Mettre à jour les éléments de la page
                const titleEl = document.querySelector('.product-title');
                const subtitleEl = document.querySelector('.product-subtitle');
                const priceEl = document.querySelector('.main-price');
                const tagEl = document.querySelector('.new-tag');
                
                if (titleEl) {
                    document.title = `${product.title} | Shopcart`;
                    titleEl.textContent = product.title;
                }
                if (subtitleEl) subtitleEl.textContent = product.subtitle || `${product.brand} - Performance et fiabilité`;
                if (priceEl) priceEl.textContent = product.price;
                if (tagEl) tagEl.textContent = product.tag || 'PREMIUM';
                
                // Étoiles
                const starsDisplay = document.querySelector('.stars-list');
                if (starsDisplay && product.stars) {
                    let starsHTML = '';
                    for (let i = 0; i < 5; i++) {
                        starsHTML += i < product.stars ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                    }
                    starsDisplay.innerHTML = starsHTML;
                }
                
                // Note
                const ratingEl = document.querySelector('.rating-text');
                if (ratingEl && product.rating) {
                    ratingEl.textContent = product.rating;
                }
            } catch (e) {
                console.error("❌ Erreur chargement produit:", e);
            }
        }

        /* =================================================
           2. GALERIE D'IMAGES - CORRECTION COMPLÈTE
           ================================================= */
        const mainImg = document.getElementById('main-image');
        const thumbnailContainer = document.querySelector('.thumbnail-row');

        if (mainImg && thumbnailContainer && product) {
            console.log('🖼️ Configuration galerie images...');
            
            // Images de la galerie (4 vues différentes)
            const gallery = [
                product.image,
                "../assets/images/img_Lap2.jpg",
                "../assets/images/img_Lap3.jpg",
                "../assets/images/img_Lap4.jpg"
            ];

            // VIDER le container avant de recréer
            thumbnailContainer.innerHTML = '';
            
            // Créer les 4 miniatures
            gallery.forEach((imgSrc, index) => {
                const thumbDiv = document.createElement('div');
                thumbDiv.className = 'thumbnail';
                if (index === 0) thumbDiv.classList.add('active');

                const img = document.createElement('img');
                img.src = imgSrc;
                img.alt = `Vue ${index + 1} du produit`;
                img.dataset.image = imgSrc;
                img.loading = 'lazy';

                // Style inline pour forcer l'affichage
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';

                thumbDiv.appendChild(img);
                thumbnailContainer.appendChild(thumbDiv);
            });

            console.log('✅ Miniatures créées:', gallery.length);

            // Image principale
            mainImg.src = gallery[0];
            mainImg.alt = product.title;

            // === GESTION DU CLIC SUR MINIATURES ===
            thumbnailContainer.addEventListener('click', function (e) {
                const thumb = e.target.closest('.thumbnail');
                if (!thumb) return;

                console.log('🖱️ Clic sur miniature');

                // Mettre à jour active
                this.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
                thumb.classList.add('active');

                const img = thumb.querySelector('img');
                const newSrc = img?.dataset.image || img?.src;
                
                if (!newSrc || newSrc === mainImg.src) return;

                // Changement d'image avec animation
                mainImg.style.opacity = '0.5';
                mainImg.style.transition = 'opacity 0.3s';
                
                const preloader = new Image();
                preloader.onload = () => {
                    mainImg.src = newSrc;
                    mainImg.alt = img?.alt || product.title;
                    mainImg.style.opacity = '1';
                };
                preloader.onerror = () => {
                    console.warn('⚠️ Erreur chargement image:', newSrc);
                    mainImg.style.opacity = '1';
                };
                preloader.src = newSrc;
            });
        }

        /* =================================================
           3. GESTION DES COULEURS
           ================================================= */
        const colorOptions = document.querySelectorAll('.color-option');
        console.log('🎨 Options couleur trouvées:', colorOptions.length);

        colorOptions.forEach(option => {
            option.addEventListener('click', function () {
                colorOptions.forEach(o => o.classList.remove('active'));
                this.classList.add('active');
                
                const color = this.getAttribute('data-color');
                const selectedEl = document.querySelector('#selected-color');
                if (color && selectedEl) {
                    selectedEl.textContent = color;
                    console.log('🎨 Couleur sélectionnée:', color);
                }
            });
        });

        /* =================================================
           4. GESTION DE LA QUANTITÉ - FIX DÉFINITIF
           ================================================= */
        const quantityBtns = document.querySelectorAll('.quantity-btn');
        const display = document.querySelector('.quantity-display');

        console.log('🔢 Boutons quantité trouvés:', quantityBtns.length);
        console.log('🔢 Display quantité:', display ? 'OK' : 'MANQUANT');

        if (display && quantityBtns.length > 0) {
            // IMPORTANT: Utiliser une seule fois addEventListener
            quantityBtns.forEach((btn, btnIndex) => {
                // Supprimer tout event listener précédent
                const newBtn = btn.cloneNode(true);
                btn.parentNode.replaceChild(newBtn, btn);

                // Attacher le nouvel event
                newBtn.addEventListener('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    const currentQty = parseInt(display.textContent) || 1;
                    const isPlus = this.querySelector('i')?.classList.contains('fa-plus');

                    let newQty = currentQty;
                    if (isPlus) {
                        newQty = currentQty + 1;
                        console.log('➕ Plus cliqué:', currentQty, '→', newQty);
                    } else if (currentQty > 1) {
                        newQty = currentQty - 1;
                        console.log('➖ Moins cliqué:', currentQty, '→', newQty);
                    }

                    // Mettre à jour l'affichage
                    display.textContent = newQty;

                    // Animation
                    display.style.transform = 'scale(1.3)';
                    display.style.transition = 'transform 0.2s';
                    setTimeout(() => {
                        display.style.transform = 'scale(1)';
                    }, 200);
                }, { once: false, passive: false });
            });
            
            console.log('✅ Contrôles quantité initialisés');
        } else {
            console.error('❌ Impossible d\'initialiser les contrôles de quantité');
        }

        /* =================================================
           5. BOUTON AJOUT AU PANIER
           ================================================= */
        const addToCartBtn = document.querySelector('.btn-add');
        if (addToCartBtn) {
            // Nettoyer tout écouteur existant (évite doublon)
            const newBtn = addToCartBtn.cloneNode(true);
            addToCartBtn.parentNode.replaceChild(newBtn, addToCartBtn);

            newBtn.addEventListener('click', function (e) {
                e.preventDefault();
                e.stopPropagation();

                if (!product) {
                    showNotification('Produit non chargé', 'error');
                    return;
                }

                const quantity = parseInt(document.querySelector('.quantity-display')?.textContent) || 1;
                const colorEl = document.querySelector('.color-option.active');
                const color = colorEl?.getAttribute('data-color') || 'Défaut';

                console.log('Ajout panier (détail):', { title: product.title, quantity, color });

                // Utiliser cart-manager.js directement
                if (typeof window.addToCartFromHTML === 'function') {
                    const tempProductEl = document.createElement('div');
                    tempProductEl.innerHTML = `
                        <h1 class="product-title">${product.title}</h1>
                        <p class="product-brand">${product.brand}</p>
                        <span class="product-price">${product.price}</span>
                        <img class="main-image" src="${product.image}" alt="${product.title}">
                        <div class="rating-text">${product.rating || '0'}</div>
                    `;
                    window.addToCartFromHTML(tempProductEl, quantity, color);
                } else {
                    // Fallback (ne devrait jamais arriver)
                    addToCart({ title: product.title, price: product.price, image: product.image, brand: product.brand, quantity, color });
                }
            });
            console.log('Bouton principal "Ajouter" corrigé (double clic évité)');
        }

        /* =================================================
           6. PRODUITS SIMILAIRES
           ================================================= */
        const similarProducts = [
        { name: "Dell XPS 15", price: 1250000, rating: 4.8, brand: "Dell", image: "../assets/images/img_Lap1.jpg" },
        { name: "HP Spectre x360 16", price: 1450000, rating: 4.7, brand: "HP", image: "../assets/images/img_Lap2.jpg" },
        { name: "Lenovo ThinkPad X1 Carbon", price: 1550000, rating: 4.9, brand: "Lenovo", image: "../assets/images/img_Lap3.jpg" },
        { name: "Dell Inspiron 14", price: 580000, rating: 4.3, brand: "Dell", image: "../assets/images/img_Lap4.jpg" },
        { name: "HP Pavilion x360", price: 690000, rating: 4.4, brand: "HP", image: "../assets/images/img_Lap5.jpg" },
        { name: "Lenovo IdeaPad 5", price: 520000, rating: 4.2, brand: "Lenovo", image: "../assets/images/img_Lap6.jpg" },
        { name: "Dell Latitude 5540", price: 1050000, rating: 4.6, brand: "Dell", image: "../assets/images/img_Lap7.jpg" },
        { name: "HP Envy x360 15", price: 880000, rating: 4.5, brand: "HP", image: "../assets/images/img_Lap8.jpg" },
        { name: "Lenovo Yoga 9i", price: 980000, rating: 4.7, brand: "Lenovo", image: "../assets/images/img_Lap12.jpg" },
        { name: "Dell Alienware m15", price: 1850000, rating: 4.8, brand: "Dell", image: "../assets/images/img_Lap13.jpg" },
        { name: "HP Omen 15", price: 1250000, rating: 4.6, brand: "HP", image: "../assets/images/img_Lap14.jpg" },
        { name: "Lenovo Legion 7", price: 1480000, rating: 4.7, brand: "Lenovo", image: "../assets/images/img_Lap15.jpg" },
        { name: "Dell Precision 5560", price: 1650000, rating: 4.8, brand: "Dell", image: "../assets/images/img_Lap16.jpg" },
        { name: "HP ZBook Fury 17", price: 1950000, rating: 4.9, brand: "HP", image: "../assets/images/img_Lap1.jpg" },
        { name: "Lenovo ThinkPad P15", price: 1750000, rating: 4.8, brand: "Lenovo", image: "../assets/images/img_Lap2.jpg" },
        { name: "Dell Vostro 14", price: 480000, rating: 4.1, brand: "Dell", image: "../assets/images/img_Lap3.jpg" },
        { name: "Dell XPS 17", price: 1850000, rating: 4.9, brand: "Dell", image: "../assets/images/img_Lap4.jpg" },
        { name: "HP Spectre 13", price: 1150000, rating: 4.6, brand: "HP", image: "../assets/images/img_Lap5.jpg" },
        { name: "Lenovo ThinkPad E14", price: 650000, rating: 4.4, brand: "Lenovo", image: "../assets/images/img_Lap6.jpg" },
        { name: "Dell Inspiron 15", price: 620000, rating: 4.2, brand: "Dell", image: "../assets/images/img_Lap7.jpg" },
        { name: "HP Pavilion 14", price: 550000, rating: 4.3, brand: "HP", image: "../assets/images/img_Lap8.jpg" },
        { name: "Lenovo IdeaPad Flex 5", price: 680000, rating: 4.5, brand: "Lenovo", image: "../assets/images/img_Lap12.jpg" },
        { name: "Dell G16 Gaming", price: 1350000, rating: 4.7, brand: "Dell", image: "../assets/images/img_Lap13.jpg" },
        { name: "HP Victus 16", price: 1050000, rating: 4.6, brand: "HP", image: "../assets/images/img_Lap14.jpg" },
        { name: "Lenovo Legion Slim 5", price: 1180000, rating: 4.7, brand: "Lenovo", image: "../assets/images/img_Lap15.jpg" },
        { name: "Dell Latitude 9440", price: 1450000, rating: 4.8, brand: "Dell", image: "../assets/images/img_Lap16.jpg" },
        { name: "HP EliteBook 845", price: 1250000, rating: 4.7, brand: "HP", image: "../assets/images/img_Lap1.jpg" },
        { name: "Lenovo ThinkPad T14", price: 950000, rating: 4.6, brand: "Lenovo", image: "../assets/images/img_Lap2.jpg" },
        { name: "Dell Vostro 16", price: 720000, rating: 4.4, brand: "Dell", image: "../assets/images/img_Lap3.jpg" },
        { name: "HP ProBook 450", price: 680000, rating: 4.5, brand: "HP", image: "../assets/images/img_Lap4.jpg" },
        { name: "Lenovo V15", price: 450000, rating: 4.2, brand: "Lenovo", image: "../assets/images/img_Lap5.jpg" },
        { name: "Dell Inspiron 13", price: 850000, rating: 4.6, brand: "Dell", image: "../assets/images/img_Lap6.jpg" }
    ];

        const productsPerPage = 8;
        let currentSimilarPage = 1;
        const totalSimilarPages = Math.ceil(similarProducts.length / productsPerPage);

                function displayProducts(page) {
            const grid = document.getElementById('similar-grid');
            if (!grid) return;

            const start = (page - 1) * productsPerPage;
            const end = start + productsPerPage;
            const items = similarProducts.slice(start, end);

            grid.innerHTML = '';

            items.forEach((prod, i) => {
                const fullStars = Math.floor(prod.rating);
                const hasHalf = (prod.rating % 1) >= 0.5;
                const emptyStars = 5 - fullStars - (hasHalf ? 1 : 0);

                const card = document.createElement('div');
                card.className = 'product-card similar-card';
                card.style.cursor = 'pointer';
                card.style.animationDelay = `${i * 0.05}s`;

                card.onclick = (e) => {
                    if (e.target.closest('.add-to-cart-btn')) return;
                    if (isNavigating) return;
                    isNavigating = true;

                    sessionStorage.setItem('selectedProduct', JSON.stringify({
                        title: prod.name,
                        price: `${prod.price.toLocaleString()} FCFA`,
                        image: prod.image,
                        subtitle: `${prod.brand} - ${prod.rating} étoiles`,
                        brand: prod.brand,
                        rating: `(${prod.rating})`,
                        tag: 'PREMIUM',
                        stars: Math.floor(prod.rating)
                    }));
                    window.location.reload();
                };

                card.innerHTML = `
                    <div class="product-image-wrapper">
                        <img src="${prod.image}" alt="${prod.name}" class="product-image">
                        <div class="product-tag tag-premium">PREMIUM</div>
                    </div>
                    <div class="product-info">
                        <p class="product-brand">${prod.brand}</p>
                        <h3 class="product-title-card">${prod.name}</h3>
                        <div class="rating-info">
                            <div class="stars-list">
                                ${'<i class="fas fa-star"></i>'.repeat(fullStars)}
                                ${hasHalf ? '<i class="fas fa-star-half-alt"></i>' : ''}
                                ${'<i class="far fa-star"></i>'.repeat(emptyStars)}
                            </div>
                            <span class="rating-text">(${prod.rating})</span>
                        </div>
                        <div class="product-actions">
                            <span class="product-price">${prod.price.toLocaleString()} FCFA</span>
                            <button class="add-to-cart-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                `;

                grid.appendChild(card);
            });

            // === AJOUT CRITIQUE : Attacher les écouteurs APRÈS insertion DOM ===
            setTimeout(() => {
                document.querySelectorAll('#similar-grid .add-to-cart-btn').forEach(btn => {
                    // Nettoyer les anciens écouteurs
                    const newBtn = btn.cloneNode(true);
                    btn.parentNode.replaceChild(newBtn, btn);

                    newBtn.addEventListener('click', function (e) {
                        e.preventDefault();
                        e.stopPropagation();

                        const card = this.closest('.product-card');
                        if (!card) return;

                        const title = card.querySelector('.product-title-card')?.textContent.trim();
                        const brand = card.querySelector('.product-brand')?.textContent.trim();
                        const priceText = card.querySelector('.product-price')?.textContent.trim();
                        const image = card.querySelector('.product-image')?.src;

                        if (!title || !priceText) return;

                        // Utilise cart-manager.js si disponible
                        if (typeof window.addToCartFromHTML === 'function') {
                            const tempEl = document.createElement('div');
                            tempEl.innerHTML = `
                                <h3 class="product-title-card">${title}</h3>
                                <p class="product-brand">${brand}</p>
                                <span class="product-price">${priceText}</span>
                                <img class="product-image" src="${image}" alt="${title}">
                            `;
                            window.addToCartFromHTML(tempEl, 1, 'Défaut');
                        }
                    });
                });
            }, 0);
        }

        function renderPagination(page) {
            const container = document.getElementById('similar-pagin');
            if (!container) return;

            container.innerHTML = '';

            const prev = document.createElement('button');
            prev.className = 'page-btn';
            prev.textContent = 'Précédent';
            prev.disabled = page === 1;
            prev.onclick = () => updatePage(page - 1, true);
            container.appendChild(prev);

            for (let i = 1; i <= totalSimilarPages; i++) {
                const btn = document.createElement('button');
                btn.className = i === page ? 'page-num-active' : 'page-num';
                btn.textContent = i;
                btn.onclick = () => updatePage(i, true);
                container.appendChild(btn);
            }

            const next = document.createElement('button');
            next.className = 'page-btn';
            next.textContent = 'Suivant';
            next.disabled = page === totalSimilarPages;
            next.onclick = () => updatePage(page + 1, true);
            container.appendChild(next);
        }

        function updatePage(page, shouldScroll = false) {
            if (page < 1 || page > totalSimilarPages) return;
            currentSimilarPage = page;
            displayProducts(page);
            renderPagination(page);
            
            // Scroll uniquement si demandé (pas au chargement initial)
            if (shouldScroll) {
                const section = document.querySelector('.products-section');
                if (section) {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            }
        }
        
        // Premier chargement SANS scroll
        updatePage(1, false);
        
        // Scroll vers le haut de la page au chargement
        window.scrollTo({ top: 0, behavior: 'instant' });
        console.log('✅ Produits similaires initialisés');
        console.log('✅ Page détail complètement chargée');
    });
}

/* =================================================
   INTÉGRATION AVEC CART-MANAGER.JS
   ================================================= */
// Utiliser les fonctions de cart-manager.js si disponibles
// Sinon, fallback vers fonctions locales

function addToCart(product) {
    console.log('🛒 addToCart appelé:', product.title, 'qty:', product.quantity);

    // Si cart-manager.js est chargé, utiliser sa fonction
    if (typeof window.addToCartFromHTML === 'function') {
        console.log('✅ Utilisation de cart-manager.js');
        
        // Créer un élément temporaire avec les infos du produit
        const tempElement = document.createElement('div');
        tempElement.innerHTML = `
            <h3 class="product-title-card">${product.title}</h3>
            <p class="product-brand">${product.brand}</p>
            <span class="product-price">${product.price}</span>
            <img class="product-image" src="${product.image}" alt="${product.title}">
            <span class="rating-text">(${product.rating || '0'})</span>
        `;
        
        window.addToCartFromHTML(tempElement, product.quantity, product.color || 'Défaut');
        return;
    }

    // Fallback: méthode locale (ancien système)
    console.log('⚠️ cart-manager.js non disponible, utilisation méthode locale');
    
    let cart = [];
    try {
        cart = JSON.parse(localStorage.getItem('cart') || '[]');
        if (!Array.isArray(cart)) cart = [];
    } catch (err) {
        console.error('❌ Erreur lecture panier:', err);
        cart = [];
    }

    const existing = cart.find(item =>
        item.title === product.title &&
        item.image === product.image &&
        item.color === product.color
    );

    if (existing) {
        existing.quantity = (existing.quantity || 0) + (product.quantity || 0);
        console.log('📦 Produit existant mis à jour, qty:', existing.quantity);
    } else {
        product.quantity = Number(product.quantity) || 1;
        cart.push(product);
        console.log('✨ Nouveau produit ajouté, qty:', product.quantity);
    }

    localStorage.setItem('cart', JSON.stringify(cart));
    
    // Utiliser la notification de cart-manager si disponible
    if (typeof window.showNotification === 'function') {
        window.showNotification(`+${product.quantity} × ${product.title}`, 'success');
    } else {
        showNotificationLocal(`+${product.quantity} × ${product.title}`, 'success');
    }
    
    updateCartCount();
}

function updateCartCount() {
    // Utiliser la fonction de cart-manager si disponible
    if (typeof window.updateCartBadge === 'function') {
        window.updateCartBadge();
        return;
    }

    // Fallback local
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    const total = cart.reduce((sum, item) => sum + (Number(item.quantity) || 0), 0);

    const countEl = document.querySelector('.cart-count');
    if (countEl) {
        countEl.textContent = total;
        countEl.style.transform = 'scale(1.4)';
        setTimeout(() => countEl.style.transform = 'scale(1)', 200);
    }
}

function showNotificationLocal(message, type = 'success') {
    const colors = { success: '#10b981', info: '#3b82f6' };

    const notif = document.createElement('div');
    notif.style.cssText = `
        position: fixed; top: 100px; right: 20px; 
        background: ${colors[type]}; color: white; 
        padding: 14px 24px; border-radius: 8px; 
        box-shadow: 0 4px 12px rgba(0,0,0,0.15); 
        z-index: 10000; animation: slideIn 0.3s ease; 
        font-weight: 500; font-size: 0.9rem; max-width: 300px;
    `;
    notif.textContent = message;
    document.body.appendChild(notif);

    setTimeout(() => {
        notif.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notif.remove(), 300);
    }, 2000);
}

// Animations CSS
if (!document.getElementById('cart-notif-style')) {
    const style = document.createElement('style');
    style.id = 'cart-notif-style';
    style.textContent = `
        @keyframes slideIn { 
            from { transform: translateX(100%); opacity: 0; } 
            to { transform: translateX(0); opacity: 1; } 
        }
        @keyframes slideOut { 
            from { transform: translateX(0); opacity: 1; } 
            to { transform: translateX(100%); opacity: 0; } 
        }
    `;
    document.head.appendChild(style);
}