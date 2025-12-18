document.addEventListener('DOMContentLoaded', function() {
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        card.removeAttribute('href');
        card.style.cursor = 'pointer';
        
        card.addEventListener('click', function(e) {
            if (e.target.closest('.add-to-cart-btn')) {
                return;
            }
            
            e.preventDefault();
            
            const productInfo = {
                brand: this.querySelector('.product-brand')?.textContent.trim() || '',
                title: this.querySelector('.product-title-card')?.textContent.trim() || '',
                price: this.querySelector('.product-price')?.textContent.trim() || '',
                rating: this.querySelector('.rating-text')?.textContent.trim() || '',
                image: this.querySelector('.product-image')?.src || '',
                tag: this.querySelector('.product-tag')?.textContent.trim() || 'Premium',
                stars: this.querySelectorAll('.stars-list .fa-star:not(.far)').length || 4
            };
            
            console.log('Produit sélectionné:', productInfo);
            
            sessionStorage.setItem('selectedProduct', JSON.stringify(productInfo));
            
            let detailPagePath;
            if (window.location.pathname.includes('/pages/')) {
                detailPagePath = 'product_manetteDetail.html';
            } else {
                detailPagePath = 'pages/product_manetteDetail.html';
            }
            
            window.location.href = detailPagePath;
        });
    });
});

window.addEventListener('load', function() {
    if (window.location.pathname.includes('product_manetteDetail.html') || 
        window.location.pathname.includes('product_manetteDetail')) {
        
        console.log('Page de détails détectée');
        
        const productData = sessionStorage.getItem('selectedProduct');
        
        if (productData) {
            const product = JSON.parse(productData);
            console.log('Données du produit récupérées:', product);
            
            const productTitle = document.querySelector('.product-title');
            if (productTitle && product.title) {
                productTitle.textContent = product.title;
                console.log('Titre mis à jour:', product.title);
            }
            
            const newTag = document.querySelector('.new-tag');
            if (newTag && product.tag) {
                newTag.textContent = product.tag;
                console.log('Tag mis à jour:', product.tag);
            }
            
            const mainPrice = document.querySelector('.main-price');
            if (mainPrice && product.price) {
                mainPrice.textContent = product.price;
                console.log('Prix mis à jour:', product.price);
            }
            
            const ratingText = document.querySelector('.rating-text');
            if (ratingText && product.rating) {
                ratingText.textContent = product.rating;
                console.log('Note mise à jour:', product.rating);
            }
            
            const starsDisplay = document.querySelector('.stars-list');
            if (starsDisplay && product.stars) {
                let starsHTML = '';
                for (let i = 0; i < 5; i++) {
                    if (i < product.stars) {
                        starsHTML += '<i class="fas fa-star"></i>';
                    } else {
                        starsHTML += '<i class="far fa-star"></i>';
                    }
                }
                starsDisplay.innerHTML = starsHTML;
                console.log('Étoiles mises à jour');
            }
            
            const mainImage = document.querySelector('#main-image');
            if (mainImage && product.image) {
                mainImage.src = product.image;
                console.log('Image mise à jour');
            }
            
            const thumbnails = document.querySelectorAll('.thumbnail img');
            thumbnails.forEach((thumb, index) => {
                if (product.image) {
                    thumb.src = product.image;
                    thumb.setAttribute('data-image', product.image);
                }
            });
            
            const productSubtitle = document.querySelector('.product-subtitle');
            if (productSubtitle && product.brand) {
                productSubtitle.textContent = `${product.brand} | Intel Core i7 | 16 Go RAM | SSD 512 Go - Performance et élégance réunies`;
                console.log('Sous-titre mis à jour');
            }
            
            console.log('✅ Mise à jour de la page de détails terminée');
            
        } else {
            console.log('❌ Aucune donnée produit trouvée dans sessionStorage');
        }
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const thumbnails = document.querySelectorAll('.thumbnail');
    const mainImage = document.querySelector('#main-image');
    
    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            thumbnails.forEach(t => t.classList.remove('active'));
            
            this.classList.add('active');
            
            const newImageSrc = this.querySelector('img').getAttribute('data-image') || 
                               this.querySelector('img').src;
            if (mainImage) {
                mainImage.src = newImageSrc;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const colorOptions = document.querySelectorAll('.color-option');
    const selectedColorText = document.querySelector('#selected-color');
    
    colorOptions.forEach(option => {
        option.addEventListener('click', function() {
            colorOptions.forEach(o => o.classList.remove('active'));
            
            this.classList.add('active');
            
            const colorName = this.getAttribute('data-color');
            if (selectedColorText && colorName) {
                selectedColorText.textContent = colorName;
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const quantityBtns = document.querySelectorAll('.quantity-btn');
    const quantityDisplay = document.querySelector('.quantity-display');
    
    quantityBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (!quantityDisplay) return;
            
            let currentQuantity = parseInt(quantityDisplay.textContent);
            const icon = this.querySelector('i');
            
            if (icon && icon.classList.contains('fa-plus')) {
                currentQuantity++;
            } else if (icon && icon.classList.contains('fa-minus') && currentQuantity > 1) {
                currentQuantity--;
            }
            
            quantityDisplay.textContent = currentQuantity;
        });
    });
});


    
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

function updateCartCount() {
    const cartCount = document.querySelector('.cart-count');
    if (cartCount) {
        let currentCount = parseInt(cartCount.textContent) || 0;
        currentCount++;
        cartCount.textContent = currentCount;
        
        cartCount.style.transform = 'scale(1.3)';
        setTimeout(() => {
            cartCount.style.transform = 'scale(1)';
        }, 200);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const filterLinks = document.querySelectorAll('.dropdown-content2 a');
    
    filterLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const filterType = this.closest('.filter-dropdown').querySelector('.tag-button').textContent.trim().split(' ')[0];
            const filterValue = this.getAttribute('data-price') || 
                               this.getAttribute('data-brand') || 
                               this.getAttribute('data-rating');
            
            console.log(`Filtre appliqué: ${filterType} = ${filterValue}`);
            
            const tagButton = this.closest('.filter-dropdown').querySelector('.tag-button');
            if (tagButton) {
                tagButton.classList.add('selected-tag');
            }
            
            const checkbox = this.closest('.filter-dropdown').querySelector('.filter-checkbox');
            if (checkbox) {
                checkbox.checked = false;
            }
            
            showNotification(`Filtre "${this.textContent.trim()}" appliqué`, 'info');
        });
    });
});