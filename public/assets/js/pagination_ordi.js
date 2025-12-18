// ============================================
// pagination_ordi.js - AVEC INTÉGRATION CART-MANAGER
// ============================================

const allProducts = [
    // Page 1
    { name: "Dell XPS 13", price: 950000, rating: 4.7, brand: "Dell", image: "../assets/images/img_Lap2.jpg" },
    { name: "HP Spectre x360 14", price: 1150000, rating: 4.6, brand: "HP", image: "../assets/images/img_Lap1.jpg" },
    { name: "Lenovo ThinkPad X1", price: 1350000, rating: 4.8, brand: "Lenovo", image: "../assets/images/img_Lap3.jpg" },
    { name: "Dell Inspiron 16", price: 680000, rating: 4.2, brand: "Dell", image: "../assets/images/img_Lap4.jpg" },
    { name: "HP Pavilion 15", price: 590000, rating: 4.1, brand: "HP", image: "../assets/images/img_Lap5.jpg" },
    { name: "Lenovo IdeaPad 3", price: 420000, rating: 3.9, brand: "Lenovo", image: "../assets/images/img_Lap6.jpg" },
    { name: "Dell Latitude 7440", price: 1250000, rating: 4.5, brand: "Dell", image: "../assets/images/img_Lap7.jpg" },
    { name: "HP Envy 17", price: 980000, rating: 4.4, brand: "HP", image: "../assets/images/img_Lap8.jpg" },
    { name: "Lenovo Yoga 7i", price: 890000, rating: 4.3, brand: "Lenovo", image: "../assets/images/img_Lap12.jpg" },
    { name: "Dell G15 Gaming", price: 1150000, rating: 4.6, brand: "Dell", image: "../assets/images/img_Lap13.jpg" },
    { name: "HP Omen 16", price: 1350000, rating: 4.7, brand: "HP", image: "../assets/images/img_Lap14.jpg" },
    { name: "Lenovo Legion 5", price: 1080000, rating: 4.5, brand: "Lenovo", image: "../assets/images/img_Lap15.jpg" },
    { name: "MacBook Air M2", price: 1350000, rating: 4.9, brand: "Apple", image: "../assets/images/img_Lap16.jpg" },
    { name: "ASUS ZenBook 14", price: 980000, rating: 4.5, brand: "ASUS", image: "../assets/images/img_Lap1.jpg" },
    { name: "Acer Swift 3", price: 750000, rating: 4.3, brand: "Acer", image: "../assets/images/img_Lap2.jpg" },
    { name: "Surface Laptop 5", price: 1250000, rating: 4.7, brand: "Microsoft", image: "../assets/images/img_Lap3.jpg" },
    { name: "MSI Modern 15", price: 680000, rating: 4.2, brand: "MSI", image: "../assets/images/img_Lap4.jpg" },
    
    // Page 2
    { name: "MacBook Pro 14", price: 1850000, rating: 5.0, brand: "Apple", image: "../assets/images/img_Lap5.jpg" },
    { name: "Acer Aspire 5", price: 480000, rating: 4.0, brand: "Acer", image: "../assets/images/img_Lap6.jpg" },
    { name: "ASUS Zenbook 14", price: 980000, rating: 4.6, brand: "ASUS", image: "../assets/images/img_Lap7.jpg" },
    { name: "Acer Nitro 5", price: 850000, rating: 4.3, brand: "Acer", image: "../assets/images/img_Lap8.jpg" },
    { name: "ASUS ROG Strix", price: 1550000, rating: 4.8, brand: "ASUS", image: "../assets/images/img_Lap12.jpg" },
    { name: "Apple iMac 24\"", price: 1450000, rating: 4.9, brand: "Apple", image: "../assets/images/img_Lap13.jpg" },
    { name: "Acer Swift 3", price: 620000, rating: 4.1, brand: "Acer", image: "../assets/images/img_Lap14.jpg" },
    { name: "ASUS VivoBook 15", price: 550000, rating: 4.0, brand: "ASUS", image: "../assets/images/img_Lap15.jpg" },
    { name: "MacBook Pro 16", price: 2950000, rating: 5.0, brand: "Apple", image: "../assets/images/img_Lap16.jpg" },
    { name: "Acer Predator", price: 1650000, rating: 4.7, brand: "Acer", image: "../assets/images/img_Lap1.jpg" },
    { name: "ASUS TUF Gaming", price: 980000, rating: 4.4, brand: "ASUS", image: "../assets/images/img_Lap2.jpg" },
    
    // Page 3
    { name: "MSI Katana 15", price: 1050000, rating: 4.5, brand: "MSI", image: "../assets/images/img_Lap3.jpg" },
    { name: "Razer Blade 14", price: 1850000, rating: 4.8, brand: "Razer", image: "../assets/images/img_Lap4.jpg" },
    { name: "Surface Laptop 5", price: 1150000, rating: 4.6, brand: "Microsoft", image: "../assets/images/img_Lap5.jpg" },
    { name: "MSI Stealth 16", price: 1550000, rating: 4.7, brand: "MSI", image: "../assets/images/img_Lap6.jpg" },
    { name: "Razer Blade 16", price: 2450000, rating: 4.9, brand: "Razer", image: "../assets/images/img_Lap7.jpg" },
    { name: "Surface Pro 9", price: 1250000, rating: 4.7, brand: "Microsoft", image: "../assets/images/img_Lap8.jpg" }
];

const bestOffers = [
    { name: "MacBook Pro 16 M3", price: 2950000, rating: 5.0, brand: "Apple", image: "../assets/images/img_Lap12.jpg" },
    { name: "Dell XPS 15", price: 1450000, rating: 4.8, brand: "Dell", image: "../assets/images/img_Lap7.jpg" },
    { name: "ASUS ROG Strix", price: 1550000, rating: 4.8, brand: "ASUS", image: "../assets/images/img_Lap5.jpg" },
    { name: "HP Omen 16", price: 1350000, rating: 4.7, brand: "HP", image: "../assets/images/img_Lap14.jpg" },
    { name: "MacBook Pro 14 M3", price: 1850000, rating: 5.0, brand: "Apple", image: "../assets/images/img_Lap1.jpg" },
    { name: "Lenovo Legion 5", price: 1280000, rating: 4.6, brand: "Lenovo", image: "../assets/images/img_Lap2.jpg" },
    { name: "Acer Predator", price: 1400000, rating: 4.5, brand: "Acer", image: "../assets/images/img_Lap3.jpg" },
    { name: "Surface Pro 9", price: 1150000, rating: 4.7, brand: "Microsoft", image: "../assets/images/img_Lap4.jpg" }
];

const productsPerPage = 8;

// === FONCTION GÉNÉRIQUE D'AFFICHAGE ===
function displayProducts(products, page, gridId) {
    const grid = document.getElementById(gridId);
    if (!grid) return;

    const start = (page - 1) * productsPerPage;
    const end = start + productsPerPage;
    const items = products.slice(start, end);

    grid.innerHTML = '';

    items.forEach((product, i) => {
        const fullStars = Math.floor(product.rating);
        const hasHalf = (product.rating % 1) >= 0.5;
        const emptyStars = 5 - fullStars - (hasHalf ? 1 : 0);

        let badge = 'PREMIUM';
        let badgeClass = 'tag-premium';
        if (product.type === 'NVMe') {
            badge = 'ULTRA RAPIDE';
            badgeClass = 'tag-best-seller';
        } else if (product.type === 'Externe') {
            badge = 'PORTABLE';
            badgeClass = 'tag-new';
        }

        const card = document.createElement('div');
        card.className = 'product-card';
        card.style.animationDelay = `${i * 0.05}s`;

        card.innerHTML = `
            <div class="product-image-wrapper">
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <div class="product-tag ${badgeClass}">${badge}</div>
            </div>
            <div class="product-info">
                <p class="product-brand">${product.brand}</p>
                <h3 class="product-title-card">${product.name}</h3>
                <div class="rating-info">
                    <div class="stars-list">
                        ${'<i class="fas fa-star"></i>'.repeat(fullStars)}
                        ${hasHalf ? '<i class="fas fa-star-half-alt"></i>' : ''}
                        ${'<i class="far fa-star"></i>'.repeat(emptyStars)}
                    </div>
                    <span class="rating-text">(${product.rating})</span>
                </div>
                <div class="product-actions">
                    <span class="product-price">${product.price.toLocaleString()} FCFA</span>
                    <button class="add-to-cart-btn" data-product='${JSON.stringify(product)}'>
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
        `;

        grid.appendChild(card);
    });

    setTimeout(() => {
        grid.style.width = '100%';
    }, 0);

    // Réattacher les événements après affichage
    if (typeof window.attachProductNavigation === 'function') {
        setTimeout(window.attachProductNavigation, 50);
    }

    // IMPORTANT: Réattacher les événements cart-manager
    if (typeof window.initCartManager === 'function') {
        setTimeout(() => {
            // Réinitialiser uniquement les boutons de la grille affichée
            const addButtons = document.querySelectorAll(`#${gridId} .add-to-cart-btn`);
            console.log(`🔄 Réattachement de ${addButtons.length} boutons panier dans #${gridId}`);
            
            addButtons.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    const productCard = this.closest('.product-card');
                    if (!productCard) {
                        console.error('❌ Carte produit non trouvée');
                        return;
                    }
                    
                    // Utiliser cart-manager si disponible
                    if (typeof window.addToCartFromHTML === 'function') {
                        console.log('🛒 Utilisation de addToCartFromHTML');
                        window.addToCartFromHTML(productCard, 1, 'Défaut');
                    } else {
                        console.warn('⚠️ cart-manager.js non chargé');
                    }
                });
            });
        }, 100);
    }
}

// === PAGINATION INDÉPENDANTE ===
let currentPage1 = 1;
let currentPage2 = 1;

const totalPages1 = Math.ceil(allProducts.length / productsPerPage);
const totalPages2 = Math.ceil(bestOffers.length / productsPerPage);

function renderPagination(currentPage, totalPages, containerId, displayFn) {
    const container = document.getElementById(containerId);
    if (!container) return;

    container.innerHTML = '';

    const prev = document.createElement('button');
    prev.className = 'page-btn';
    prev.innerHTML = '<i class="fas fa-chevron-left"></i> Précédent';
    prev.disabled = currentPage === 1;
    prev.onclick = () => { displayFn(currentPage - 1); };
    container.appendChild(prev);

    if (totalPages <= 5) {
        for (let i = 1; i <= totalPages; i++) {
            const btn = document.createElement('button');
            btn.className = i === currentPage ? 'page-num-active' : 'page-num';
            btn.textContent = i;
            btn.onclick = () => { displayFn(i); };
            container.appendChild(btn);
        }
    } else {
        const startPages = [1, 2, 3];
        const endPages = [totalPages - 1, totalPages];
        const allPageNums = [...new Set([...startPages, currentPage, ...endPages])].sort((a, b) => a - b);
        
        allPageNums.forEach((i, idx) => {
            if (idx > 0 && allPageNums[idx] - allPageNums[idx - 1] > 1) {
                const ellipsis = document.createElement('span');
                ellipsis.textContent = '...';
                ellipsis.style.margin = '0 0.5rem';
                container.appendChild(ellipsis);
            }
            
            const btn = document.createElement('button');
            btn.className = i === currentPage ? 'page-num-active' : 'page-num';
            btn.textContent = i;
            btn.onclick = () => { displayFn(i); };
            container.appendChild(btn);
        });
    }

    const next = document.createElement('button');
    next.className = 'page-btn';
    next.innerHTML = 'Suivant <i class="fas fa-chevron-right"></i>';
    next.disabled = currentPage === totalPages;
    next.onclick = () => { displayFn(currentPage + 1); };
    container.appendChild(next);
}

// === FONCTIONS DE MISE À JOUR ===
function updateSection1(page) {
    if (page < 1 || page > totalPages1) return;
    currentPage1 = page;
    displayProducts(allProducts, page, 'grid1');
    renderPagination(page, totalPages1, 'pagin1', updateSection1);
}

function updateSection2(page) {
    if (page < 1 || page > totalPages2) return;
    currentPage2 = page;
    displayProducts(bestOffers, page, 'grid2');
    renderPagination(page, totalPages2, 'pagin2', updateSection2);
}

// Export pour filtre_ordi.js
window.updateSection1 = updateSection1;
window.updateSection2 = updateSection2;

// === INITIALISATION ===
document.addEventListener('DOMContentLoaded', function () {
    updateSection1(1);
    updateSection2(1);
    
    console.log('✅ pagination_ordi.js chargé - Produits disponibles');
    console.log('✅ Intégration cart-manager.js active');
});