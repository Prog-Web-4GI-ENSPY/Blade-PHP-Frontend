// ============================================
// pagination_disk.js - AVEC INTÉGRATION CART-MANAGER
// ============================================

const allProducts = [
    // === HDDs INTERNES (Haute capacité, usage professionnel) ===
    { name: "Seagate Barracuda 2TB", price: 50000, rating: 4.5, brand: "Seagate", type: "HDD", capacity: "2TB", image: "../assets/images/img_disk1.png" },
    { name: "WD Blue 1TB", price: 35000, rating: 4.4, brand: "Western Digital", type: "HDD", capacity: "1TB", image: "../assets/images/img_disk2.png" },
    { name: "Toshiba P300 3TB", price: 70000, rating: 4.3, brand: "Toshiba", type: "HDD", capacity: "3TB", image: "../assets/images/img_disk12.png" },
    { name: "Seagate IronWolf 8TB NAS", price: 150000, rating: 4.7, brand: "Seagate", type: "HDD", capacity: "8TB", image: "../assets/images/img_disk5.png" },
    { name: "WD Red Pro 4TB NAS", price: 110000, rating: 4.8, brand: "Western Digital", type: "HDD", capacity: "4TB", image: "../assets/images/img_disk10.png" },
    { name: "Toshiba X300 6TB", price: 120000, rating: 4.5, brand: "Toshiba", type: "HDD", capacity: "6TB", image: "../assets/images/img_disk8.png" },
    { name: "Seagate SkyHawk 6TB Surveillance", price: 130000, rating: 4.7, brand: "Seagate", type: "HDD", capacity: "6TB", image: "../assets/images/img_disk13.png" },
    { name: "WD Purple 8TB Surveillance", price: 160000, rating: 4.6, brand: "Western Digital", type: "HDD", capacity: "8TB", image: "../assets/images/img_disk14.png" },
    { name: "Toshiba N300 14TB NAS", price: 280000, rating: 4.9, brand: "Toshiba", type: "HDD", capacity: "14TB", image: "../assets/images/img_disk16.png" },
    { name: "Seagate Exos X20 20TB Enterprise", price: 450000, rating: 4.8, brand: "Seagate", type: "HDD", capacity: "20TB", image: "../assets/images/img_disk2.png" },
    { name: "WD Gold 16TB Enterprise", price: 380000, rating: 4.8, brand: "Western Digital", type: "HDD", capacity: "16TB", image: "../assets/images/img_disk6.png" },
    { name: "Toshiba MG08 22TB Enterprise", price: 520000, rating: 4.9, brand: "Toshiba", type: "HDD", capacity: "22TB", image: "../assets/images/img_disk1.png" },
    { name: "Seagate BarraCuda Pro 14TB", price: 320000, rating: 4.7, brand: "Seagate", type: "HDD", capacity: "14TB", image: "../assets/images/img_disk9.png" },
    { name: "WD Black 6TB Performance", price: 140000, rating: 4.7, brand: "Western Digital", type: "HDD", capacity: "6TB", image: "../assets/images/img_disk9.png" },
    { name: "Toshiba X300 PRO 20TB", price: 420000, rating: 4.6, brand: "Toshiba", type: "HDD", capacity: "20TB", image: "../assets/images/img_disk11.png" },
    { name: "Seagate FireCuda 2TB Hybrid SSHD", price: 95000, rating: 4.5, brand: "Seagate", type: "Hybrid", capacity: "2TB", image: "../assets/images/img_disk1.png" },
    { name: "WD Blue 8TB", price: 150000, rating: 4.4, brand: "Western Digital", type: "HDD", capacity: "8TB", image: "../assets/images/img_disk10.png" },
    { name: "Toshiba MQ04 1TB Laptop", price: 38000, rating: 4.2, brand: "Toshiba", type: "HDD", capacity: "1TB", image: "../assets/images/img_disk8.png" },
    { name: "Seagate Archive 24TB", price: 550000, rating: 4.5, brand: "Seagate", type: "HDD", capacity: "24TB", image: "../assets/images/img_disk5.png" },
    { name: "WD Red Plus 6TB", price: 130000, rating: 4.5, brand: "Western Digital", type: "HDD", capacity: "6TB", image: "../assets/images/img_disk13.png" },

    // === SSDs SATA (Performance moyenne, prix abordable) ===
    { name: "Samsung 870 EVO 1TB", price: 65000, rating: 4.8, brand: "Samsung", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk1.png" },
    { name: "Crucial MX500 2TB", price: 130000, rating: 4.7, brand: "Crucial", type: "SSD", capacity: "2TB", image: "../assets/images/img_disk2.png" },
    { name: "Samsung 870 QVO 4TB", price: 280000, rating: 4.5, brand: "Samsung", type: "SSD", capacity: "4TB", image: "../assets/images/img_disk8.png" },
    { name: "Crucial BX500 1TB", price: 48000, rating: 4.3, brand: "Crucial", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk3.png" },
    { name: "Samsung 860 EVO 1TB", price: 70000, rating: 4.8, brand: "Samsung", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk7.png" },
    { name: "Kingston A400 960GB", price: 52000, rating: 4.2, brand: "Kingston", type: "SSD", capacity: "960GB", image: "../assets/images/img_disk5.png" },
    { name: "WD Blue SA510 1TB", price: 58000, rating: 4.6, brand: "Western Digital", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk3.png" },
    { name: "Crucial MX500 1TB", price: 62000, rating: 4.6, brand: "Crucial", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Samsung 870 EVO 4TB", price: 320000, rating: 4.8, brand: "Samsung", type: "SSD", capacity: "4TB", image: "../assets/images/img_disk2.png" },
    { name: "Kingston KC600 2TB", price: 140000, rating: 4.5, brand: "Kingston", type: "SSD", capacity: "2TB", image: "../assets/images/img_disk7.png" },

    // === SSDs NVMe (Performance extrême) ===
    { name: "Samsung 970 EVO Plus 500GB", price: 68000, rating: 4.8, brand: "Samsung", type: "NVMe", capacity: "500GB", image: "../assets/images/img_disk3.png" },
    { name: "WD Black SN850X 1TB", price: 95000, rating: 4.9, brand: "Western Digital", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Samsung 980 PRO 2TB", price: 220000, rating: 4.9, brand: "Samsung", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk11.png" },
    { name: "Crucial P3 1TB PCIe 3.0", price: 48000, rating: 4.4, brand: "Crucial", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk9.png" },
    { name: "Samsung 990 PRO 2TB PCIe 4.0", price: 240000, rating: 4.9, brand: "Samsung", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk4.png" },
    { name: "WD Black SN850 1TB", price: 88000, rating: 4.9, brand: "Western Digital", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Kingston KC3000 1TB", price: 75000, rating: 4.6, brand: "Kingston", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk7.png" },
    { name: "Crucial T700 1TB PCIe 5.0", price: 120000, rating: 4.8, brand: "Crucial", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk5.png" },
    { name: "WD Black SN7100 2TB", price: 170000, rating: 4.7, brand: "Western Digital", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk4.png" },
    { name: "Samsung 970 EVO Plus 2TB", price: 180000, rating: 4.8, brand: "Samsung", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk11.png" },
    { name: "Corsair MP600 Pro 4TB", price: 380000, rating: 4.8, brand: "Corsair", type: "NVMe", capacity: "4TB", image: "../assets/images/img_disk9.png" },
    { name: "Sabrent Rocket 4 Plus 2TB", price: 210000, rating: 4.9, brand: "Sabrent", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk10.png" },
    { name: "TeamGroup MP44 1TB", price: 58000, rating: 4.5, brand: "TeamGroup", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk11.png" },
    { name: "Lexar NM800 Pro 2TB", price: 165000, rating: 4.7, brand: "Lexar", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk12.png" },
    { name: "ADATA Legend 960 1TB", price: 72000, rating: 4.6, brand: "ADATA", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk13.png" },
    { name: "MSI Spatium M480 2TB", price: 185000, rating: 4.7, brand: "MSI", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk7.png" },
    { name: "Gigabyte Aorus Gen4 1TB", price: 68000, rating: 4.6, brand: "Gigabyte", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk8.png" },
    { name: "SK Hynix Gold P31 1TB", price: 70000, rating: 4.8, brand: "SK Hynix", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Seagate FireCuda 530 2TB", price: 190000, rating: 4.8, brand: "Seagate", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk15.png" },
    { name: "Kingston Fury Renegade 2TB", price: 230000, rating: 4.9, brand: "Kingston", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk5.png" },

    // === DISQUES EXTERNES (Portabilité + Stockage) ===
    { name: "Toshiba Canvio Basics 4TB", price: 85000, rating: 4.6, brand: "Toshiba", type: "Externe", capacity: "4TB", image: "../assets/images/img_disk4.png" },
    { name: "Seagate Expansion 10TB", price: 240000, rating: 4.6, brand: "Seagate", type: "Externe", capacity: "10TB", image: "../assets/images/img_disk9.png" },
    { name: "WD My Passport 5TB", price: 120000, rating: 4.9, brand: "Western Digital", type: "Externe", capacity: "5TB", image: "../assets/images/img_disk2.png" },
    { name: "Samsung T7 1TB Portable SSD", price: 125000, rating: 4.9, brand: "Samsung", type: "Externe", capacity: "1TB", image: "../assets/images/img_disk3.png" },
    { name: "Toshiba Canvio Advance 2TB", price: 68000, rating: 4.4, brand: "Toshiba", type: "Externe", capacity: "2TB", image: "../assets/images/img_disk4.png" },
    { name: "Seagate Backup Plus 5TB", price: 110000, rating: 4.6, brand: "Seagate", type: "Externe", capacity: "5TB", image: "../assets/images/img_disk5.png" },
    { name: "WD Elements 12TB", price: 280000, rating: 4.7, brand: "Western Digital", type: "Externe", capacity: "12TB", image: "../assets/images/img_disk6.png" },
    { name: "Samsung T5 500GB Portable SSD", price: 78000, rating: 4.7, brand: "Samsung", type: "Externe", capacity: "500GB", image: "../assets/images/img_disk7.png" },
    { name: "Seagate One Touch 4TB", price: 88000, rating: 4.5, brand: "Seagate", type: "Externe", capacity: "4TB", image: "../assets/images/img_disk11.png" },
    { name: "WD My Book 12TB", price: 260000, rating: 4.6, brand: "Western Digital", type: "Externe", capacity: "12TB", image: "../assets/images/img_disk12.png" },
    { name: "Toshiba Canvio Ready 3TB", price: 72000, rating: 4.4, brand: "Toshiba", type: "Externe", capacity: "3TB", image: "../assets/images/img_disk13.png" },
    { name: "Seagate Expansion Portable 5TB", price: 105000, rating: 4.5, brand: "Seagate", type: "Externe", capacity: "5TB", image: "../assets/images/img_disk14.png" },
    { name: "WD Elements 8TB", price: 160000, rating: 4.4, brand: "Western Digital", type: "Externe", capacity: "8TB", image: "../assets/images/img_disk15.png" },
    { name: "Samsung T9 4TB Portable SSD", price: 380000, rating: 4.8, brand: "Samsung", type: "Externe", capacity: "4TB", image: "../assets/images/img_disk11.png" },
    { name: "SanDisk Extreme Portable 2TB", price: 180000, rating: 4.7, brand: "SanDisk", type: "Externe", capacity: "2TB", image: "../assets/images/img_disk6.png" },
    { name: "LaCie Rugged Mini 5TB", price: 210000, rating: 4.7, brand: "LaCie", type: "Externe", capacity: "5TB", image: "../assets/images/img_disk9.png" },
    { name: "Transcend StoreJet 25M3C 4TB", price: 98000, rating: 4.5, brand: "Transcend", type: "Externe", capacity: "4TB", image: "../assets/images/img_disk7.png" },
    { name: "G-DRIVE PROJECT 18TB", price: 420000, rating: 4.8, brand: "G-Technology", type: "Externe", capacity: "18TB", image: "../assets/images/img_disk8.png" },
    { name: "ADATA SC685 512GB Portable SSD", price: 45000, rating: 4.3, brand: "ADATA", type: "Externe", capacity: "512GB", image: "../assets/images/img_disk10.png" },
    { name: "Crucial X8 1TB Portable SSD", price: 95000, rating: 4.7, brand: "Crucial", type: "Externe", capacity: "1TB", image: "../assets/images/img_disk5.png" },

    // === PRODUITS SPÉCIALISÉS (Enterprise, Gaming) ===
    { name: "Seagate Exos X18 18TB Enterprise", price: 420000, rating: 4.8, brand: "Seagate", type: "HDD", capacity: "18TB", image: "../assets/images/img_disk2.png" },
    { name: "WD Ultrastar DC HC550 36TB", price: 850000, rating: 4.9, brand: "Western Digital", type: "HDD", capacity: "36TB", image: "../assets/images/img_disk3.png" },
    { name: "Toshiba MG10 18TB Enterprise", price: 410000, rating: 4.8, brand: "Toshiba", type: "HDD", capacity: "18TB", image: "../assets/images/img_disk4.png" },
    { name: "Samsung PM9A3 960GB Enterprise", price: 140000, rating: 4.9, brand: "Samsung", type: "NVMe", capacity: "960GB", image: "../assets/images/img_disk2.png" },
    { name: "WD Red SA500 2TB NAS SSD", price: 150000, rating: 4.7, brand: "Western Digital", type: "SSD", capacity: "2TB", image: "../assets/images/img_disk1.png" },
    { name: "Seagate IronWolf Pro 18TB NAS", price: 380000, rating: 4.8, brand: "Seagate", type: "HDD", capacity: "18TB", image: "../assets/images/img_disk12.png" },
    { name: "Crucial P5 Plus 2TB Gaming", price: 185000, rating: 4.8, brand: "Crucial", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk3.png" },
    { name: "SanDisk Extreme Pro 1TB Portable", price: 105000, rating: 4.7, brand: "SanDisk", type: "Externe", capacity: "1TB", image: "../assets/images/img_disk4.png" },
    { name: "PNY CS3140 4TB", price: 310000, rating: 4.5, brand: "PNY", type: "NVMe", capacity: "4TB", image: "../assets/images/img_disk14.png" },
    { name: "Toshiba OCZ RD400 500GB", price: 55000, rating: 4.4, brand: "Toshiba", type: "NVMe", capacity: "500GB", image: "../assets/images/img_disk16.png" },
    { name: "iStorage DiskAshur DT2 14TB Secure", price: 320000, rating: 4.6, brand: "iStorage", type: "Externe", capacity: "14TB", image: "../assets/images/img_disk6.png" }
];

const bestOffers = [
    // Sélection de 20 produits en promotion (-10 à -25%)
    { name: "Samsung 970 EVO Plus 500GB", price: 57800, rating: 4.8, brand: "Samsung", type: "NVMe", capacity: "500GB", image: "../assets/images/img_disk3.png" },
    { name: "WD Black SN850X 1TB", price: 80750, rating: 4.9, brand: "Western Digital", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Samsung 870 EVO 1TB", price: 55250, rating: 4.8, brand: "Samsung", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk1.png" },
    { name: "Seagate IronWolf 8TB NAS", price: 127500, rating: 4.7, brand: "Seagate", type: "HDD", capacity: "8TB", image: "../assets/images/img_disk5.png" },
    { name: "Crucial MX500 2TB", price: 110500, rating: 4.7, brand: "Crucial", type: "SSD", capacity: "2TB", image: "../assets/images/img_disk2.png" },
    { name: "WD My Passport 5TB", price: 102000, rating: 4.9, brand: "Western Digital", type: "Externe", capacity: "5TB", image: "../assets/images/img_disk2.png" },
    { name: "Samsung T7 1TB Portable", price: 106250, rating: 4.9, brand: "Samsung", type: "Externe", capacity: "1TB", image: "../assets/images/img_disk3.png" },
    { name: "Toshiba Canvio Basics 4TB", price: 72250, rating: 4.6, brand: "Toshiba", type: "Externe", capacity: "4TB", image: "../assets/images/img_disk4.png" },
    { name: "Samsung 980 PRO 2TB", price: 187000, rating: 4.9, brand: "Samsung", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk11.png" },
    { name: "WD Red Pro 4TB NAS", price: 93500, rating: 4.8, brand: "Western Digital", type: "HDD", capacity: "4TB", image: "../assets/images/img_disk10.png" },
    { name: "Seagate Expansion 10TB", price: 204000, rating: 4.6, brand: "Seagate", type: "Externe", capacity: "10TB", image: "../assets/images/img_disk9.png" },
    { name: "Crucial P3 1TB PCIe 3.0", price: 40800, rating: 4.4, brand: "Crucial", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk9.png" },
    { name: "Kingston KC3000 1TB", price: 63750, rating: 4.6, brand: "Kingston", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk7.png" },
    { name: "WD Blue 1TB HDD", price: 29750, rating: 4.4, brand: "Western Digital", type: "HDD", capacity: "1TB", image: "../assets/images/img_disk2.png" },
    { name: "Seagate Barracuda 2TB", price: 42500, rating: 4.5, brand: "Seagate", type: "HDD", capacity: "2TB", image: "../assets/images/img_disk1.png" },
    { name: "Samsung T5 500GB Portable", price: 66300, rating: 4.7, brand: "Samsung", type: "Externe", capacity: "500GB", image: "../assets/images/img_disk7.png" },
    { name: "Toshiba X300 6TB", price: 102000, rating: 4.5, brand: "Toshiba", type: "HDD", capacity: "6TB", image: "../assets/images/img_disk8.png" },
    { name: "WD Black SN850 1TB", price: 74800, rating: 4.9, brand: "Western Digital", type: "NVMe", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Crucial MX500 1TB", price: 52700, rating: 4.6, brand: "Crucial", type: "SSD", capacity: "1TB", image: "../assets/images/img_disk6.png" },
    { name: "Seagate FireCuda 530 2TB", price: 161500, rating: 4.8, brand: "Seagate", type: "NVMe", capacity: "2TB", image: "../assets/images/img_disk15.png" }
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

// Export pour filtre_disk.js
window.updateSection1 = updateSection1;
window.updateSection2 = updateSection2;

// === INITIALISATION ===
document.addEventListener('DOMContentLoaded', function () {
    updateSection1(1);
    updateSection2(1);
    
    console.log('✅ pagination_disk.js chargé - Produits disponibles');
    console.log('✅ Intégration cart-manager.js active');
});