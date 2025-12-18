//Navigation
function attachNavigationEvents() {
    const productCards = document.querySelectorAll('.product-card');

    productCards.forEach(card => {
        // Éviter de dupliquer les événements
        if (card.dataset.navigationAttached) return;
        card.dataset.navigationAttached = 'true';

        card.style.cursor = 'pointer';

        card.addEventListener('click', function(e) {
            // Ne pas déclencher si on clique sur le bouton panier
            if (e.target.closest('.btn-outline')) {
                return;
            }

            e.preventDefault();

            // Extraire les informations du produit
            const title = this.querySelector('.product-title')?.textContent.trim() || '';
            const priceText = this.querySelector('.product-price')?.textContent.trim() || '';
            const ratingText = this.querySelector('.product-rating')?.textContent.trim() || '';
            const image = this.querySelector('.product-image')?.src || '';
            const brand = this.querySelector('.product-image')?.alt || ''; // Marque depuis l'attribut alt

            // Extraire la note numérique depuis le texte entre parenthèses
            // Ex: "(4.2)" -> "4.2"
            const ratingMatch = ratingText.match(/\(([\d.]+)\)/);
            const rating = ratingMatch ? ratingMatch[1] : '0';

            // Compter le nombre d'étoiles pleines
            const fullStars = this.querySelectorAll('.product-rating .fa-star:not(.fa-regular):not(.fa-star-half-stroke)').length;
            const halfStars = this.querySelectorAll('.product-rating .fa-star-half-stroke').length;
            const stars = fullStars + (halfStars > 0 ? 0.5 : 0);

            const productInfo = {
                brand: brand,
                title: title,
                price: priceText,
                rating: rating,
                image: image,
                stars: Math.round(stars)
            };

            console.log('Produit sélectionné:', productInfo);

            // Stocker dans sessionStorage
            sessionStorage.setItem('selectedProduct', JSON.stringify(productInfo));

            // Déterminer la page de détails selon la page actuelle
            const currentPage = window.location.pathname.split('/').pop();
            let detailPagePath;

            if (currentPage.includes('tel')) {
                detailPagePath = 'product_tel_details.html';
            } else if (currentPage.includes('cam')) {
                detailPagePath = 'product_cam_details.html';
            } else {
                detailPagePath = 'product_details.html'; // Par défaut
            }

            window.location.href = detailPagePath;
        });
    });
}

// Attacher les événements au chargement initial
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(attachNavigationEvents, 500);
});

//On est sur la page détails et on récupère les données
window.addEventListener('load', function() {
    // Vérifier si on est sur la page de détails
    if (window.location.pathname.includes('product_tel_details.html') ||
        window.location.pathname.includes('product-details')) {

        console.log('Page de détails détectée');

        const productData = sessionStorage.getItem('selectedProduct');

        if (productData) {
            const product = JSON.parse(productData);
            console.log('Données du produit récupérées:', product);

            // Mettre à jour le titre
            const productName = document.querySelector('.product.name');
            if (productName && product.title) {
                productName.textContent = product.title;
            }

            // Mettre à jour le prix
            const price = document.querySelector('.price');
            if (price && product.price) {
                price.textContent = product.price;
            }

            // Mettre à jour la notation (texte)
            const ratingText = document.querySelector('.rating-text');
            if (ratingText && product.rating) {
                ratingText.textContent = `Rating : ${product.rating}`;
            }

            // Mettre à jour les étoiles
            const starsContainer = document.querySelector('.stars');
            if (starsContainer && product.stars) {
                let starsHTML = '';
                const fullStars = Math.floor(product.stars);
                const hasHalfStar = product.stars % 1 !== 0;
                const emptyStars = 5 - Math.ceil(product.stars);

                for (let i = 0; i < fullStars; i++) {
                    starsHTML += '<i class="fa-solid fa-star"></i>';
                }
                if (hasHalfStar) {
                    starsHTML += '<i class="fa-solid fa-star-half-stroke"></i>';
                }
                for (let i = 0; i < emptyStars; i++) {
                    starsHTML += '<i class="fa-regular fa-star"></i>';
                }
                starsHTML += ' Stars';

                starsContainer.innerHTML = starsHTML;
            }

            // Mettre à jour l'image principale
            const mainImage = document.querySelector('.main-image');
            if (mainImage && product.image) {
                mainImage.src = product.image;
                mainImage.alt = product.brand;
            }

            // Mettre à jour les miniatures (garder les mêmes images pour l'instant)
            const thumbnails = document.querySelectorAll('.thumbnails img');
            thumbnails.forEach((thumb, index) => {
                if (product.image) {
                    thumb.src = product.image;
                    thumb.alt = `${product.brand} ${index + 1}`;
                }
            });

            // Mettre à jour la description
            const description = document.querySelector('.product.description');
            if (description && product.title) {
                // Générer une description basique
                description.textContent = `${product.title} - Un excellent smartphone avec des performances remarquables et un design moderne.`;
            }

            // Mettre à jour le titre de la page
            document.title = `Telephones | Shopcart / ${product.title}`;

            console.log('✅ Mise à jour de la page de détails terminée');

        } else {
            console.log('❌ Aucune donnée produit trouvée dans sessionStorage');
        }
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnails img');
    const mainImage = document.querySelector('.main-image');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('thumbnail-active'));
            this.classList.add('thumbnail-active');

            if (mainImage) {
                mainImage.src = this.src;
            }
        });
    });
});

//Couleurs
document.addEventListener('DOMContentLoaded', function() {
    const colorBtns = document.querySelectorAll('.color-btn, .color-btn-active');

    colorBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            colorBtns.forEach(b => {
                b.classList.remove('color-btn-active');
                b.classList.add('color-btn');
            });

            this.classList.remove('color-btn');
            this.classList.add('color-btn-active');
        });
    });
});

//Quantité
document.addEventListener('DOMContentLoaded', function() {
    const qtyInput = document.querySelector('.qty-input');
    const qtyBtns = document.querySelectorAll('.qty-btn');

    qtyBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();

            if (!qtyInput) return;

            let currentQuantity = parseInt(qtyInput.value) || 1;

            if (this.textContent === '+') {
                currentQuantity++;
            } else if (this.textContent === '-' && currentQuantity > 1) {
                currentQuantity--;
            }

            qtyInput.value = currentQuantity;
        });
    });
});



//Notification pour marquer l'ajout
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: ${type === 'success' ? '#10b981' : '#3b82f6'};
        color: white;
        padding: 15px 25px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 10000;
        animation: slideIn 0.3s ease;
        font-weight: 500;
    `;
    notification.textContent = message;

    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(400px);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        @keyframes slideOut {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(400px);
                opacity: 0;
            }
        }
    `;
    if (!document.querySelector('style[data-notification-style]')) {
        style.setAttribute('data-notification-style', 'true');
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => {
            if (notification.parentNode) {
                document.body.removeChild(notification);
            }
        }, 300);
    }, 3000);
}


