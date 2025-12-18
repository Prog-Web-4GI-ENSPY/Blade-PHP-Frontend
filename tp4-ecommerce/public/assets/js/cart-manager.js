// assets/js/cart-manager.js
class CartManager {
    constructor() {
        this.api = window.apiService;
        this.cart = {
            items: [],
            subtotal: 0,
            discount: 0,
            shipping: 0,
            total: 0,
            itemCount: 0
        };
        this.init();
    }

    async init() {
        console.log('🛒 Initialisation du CartManager...');
        this.bindEvents();
        await this.loadCart();

        // Sécurité supplémentaire : on force l'affichage après le chargement
    this.updateUI();
    }

    bindEvents() {
        // Ajout au panier depuis les boutons "add-to-cart"
        document.addEventListener('click', async (e) => {
            const addToCartBtn = e.target.closest('.add-to-cart-btn');
            if (addToCartBtn) {
                e.preventDefault();
                const productId = addToCartBtn.dataset.productId;
                await this.addToCart(productId, 1);
            }
        });
    }

    async loadCart() {
        try {
            console.log('📦 Chargement du panier depuis l\'API...');
            const data = await this.api.getCart();
            
            if (data && data.message && data.data) {
                this.updateCart(data.data);
                this.updateUI();
            }
        } catch (error) {
            console.error('❌ Erreur chargement panier:', error);
            this.updateCart({ items: [] });
        }
    }

    updateCart(data) {
        this.cart = {
            items: data.items || [],
            subtotal: data.subtotal || 0,
            discount: data.discount || 0,
            shipping: data.shipping || 0,
            total: data.total || 0,
            itemCount:data.items_count|| (data.items ? data.items.length : 0)
        };
        
        console.log('🛒 Panier mis à jour:', {
            items: this.cart.items.length,
            total: this.cart.total
        });
    }

    async addToCart(productId, quantity = 1) {
        try {
            console.log(`➕ Ajout au panier - Produit: ${productId}, Quantité: ${quantity}`);
            
            const response = await this.api.addToCart(productId, quantity);
            
            if (response && response.message) {
                console.log('✅ Produit ajouté:', response.message);
                this.showNotification('Produit ajouté au panier', 'success');
                
                // Recharger le panier
                await this.loadCart();
                return true;
            }
        } catch (error) {
            console.error('❌ Erreur ajout panier:', error);
            this.showNotification('Erreur: ' + error.message, 'error');
            return false;
        }
    }

    async updateQuantity(cartItemId, newQuantity) {
        try {
            console.log(`✏️ Mise à jour quantité - Item: ${cartItemId}, Quantité: ${newQuantity}`);
            
            const response = await this.api.updateCartItem(cartItemId, newQuantity);
            
            if (response && response.message) {
                await this.loadCart();
                this.showNotification('Quantité mise à jour', 'success');
                return true;
            }
        } catch (error) {
            console.error('❌ Erreur mise à jour quantité:', error);
            this.showNotification('Erreur: ' + error.message, 'error');
            return false;
        }
    }

    async removeItem(cartItemId) {
        try {
            console.log(`🗑️ Suppression item - Item: ${cartItemId}`);
            
            const response = await this.api.removeCartItem(cartItemId);
            
            if (response && response.message) {
                await this.loadCart();
                this.showNotification('Article supprimé', 'success');
                return true;
            }
        } catch (error) {
            console.error('❌ Erreur suppression:', error);
            this.showNotification('Erreur: ' + error.message, 'error');
            return false;
        }
    }

    async clearCart() {
        try {
            console.log('🧹 Vidage du panier...');
            
            const response = await this.api.clearCart();
            
            if (response && response.message) {
                this.updateCart({ items: [] });
                this.updateUI();
                this.showNotification('Panier vidé', 'success');
                return true;
            }
        } catch (error) {
            console.error('❌ Erreur vidage panier:', error);
            this.showNotification('Erreur: ' + error.message, 'error');
            return false;
        }
    }

    updateUI() {
        // Mettre à jour le badge du panier dans l'en-tête
        this.updateCartBadge();
        
        // Si on est sur la page panier, mettre à jour l'affichage
        if (window.location.pathname.includes('panier')) {
            this.renderCartPage();
        }
    }

    updateCartBadge() {
       // Cible la classe .cart-count utilisée dans votre header.blade.php
       const badges = document.querySelectorAll('.cart-count');
       badges.forEach(badge => {
           badge.textContent = this.cart.itemCount;
           // On s'assure que le badge est visible s'il y a des articles
           badge.style.setProperty('display', this.cart.itemCount > 0 ? 'flex' : 'none', 'important');
       });

       // Cible l'ID total-items utilisé dans votre panier.blade.php
       const totalItemsElement = document.getElementById('total-items');
       if (totalItemsElement) {
           totalItemsElement.textContent = this.cart.itemCount;
       }
   }

    renderCartPage() {
        const container = document.getElementById('cart-items-container');
        const loadingIndicator = document.getElementById('loading-indicator');
        const emptyCartMessage = document.getElementById('empty-cart-message');
        const cartContent = document.getElementById('cart-content-wrapper');
        
        if (!container) return;
        
        // Masquer l'indicateur de chargement
        if (loadingIndicator) {
            loadingIndicator.style.display = 'none';
        }
        
        if (this.cart.items.length === 0) {
            if (emptyCartMessage) emptyCartMessage.style.display = 'flex';
            if (cartContent) cartContent.style.display = 'none';
            const totalText = document.getElementById('total-items');
            if (totalText) totalText.textContent = '0';
            return;
        }

        if (emptyCartMessage) emptyCartMessage.style.display = 'none';
        if (cartContent) cartContent.style.display = 'flex';
        
        // On remplit le container avec les items
        container.innerHTML = this.cart.items.map(item => this.createCartItemHTML(item)).join('');
        
        this.updateSummary();
        this.bindCartItemEvents();
        
        // Gestion du bouton vider
        const clearBtn = document.getElementById('clear-cart-button');
        if (clearBtn) {
            clearBtn.onclick = () => this.clearCart();
        }
    }

    createCartItemHTML(item) {
    // Sécurité pour les prix et noms
    const unitPrice = item.unit_price || item.price || 0;
    const productName = item.product?.name || 'Produit';
    
    // Gestion de l'image (évite le "undefined")
    const imageUrl = item.product?.image_url || 
                    (item.product?.image ? this.api.getImageUrl(item.product.image) : '/assets/images/placeholder.jpg');

    return `
        <div class="cart-item" data-cart-item-id="${item.id}">
            <img src="${imageUrl}" class="item-image" alt="${productName}">
            
            <div class="item-details">
                <h3 class="item-name">${productName}</h3>
                <p class="item-brand">${item.product?.brand || 'Marque non spécifiée'}</p>
                <div class="item-rating">
                    <span class="stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </span>
                    <span class="rating-value">4.5</span>
                </div>
            </div>
            
            <div class="item-actions">
                <p class="item-price">${this.formatPrice(unitPrice * item.quantity)}</p>
                <div class="quantity-controls">
                    <button class="quantity-btn minus" data-action="decrease">-</button>
                    <span class="quantity-display">${item.quantity}</span>
                    <button class="quantity-btn plus" data-action="increase">+</button>
                </div>
                <button class="remove-btn btn-remove-item" data-cart-item-id="${item.id}">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </div>
        </div>
    `;
}
    updateSummary() {
        const subtotalElement = document.getElementById('subtotal-value');
        const discountElement = document.getElementById('discount-value');
        const shippingElement = document.getElementById('shipping-value');
        const totalElement = document.getElementById('total-value');
        
        if (subtotalElement) {
            subtotalElement.textContent = this.formatPrice(this.cart.subtotal);
        }
        
        if (discountElement) {
            if (this.cart.discount > 0) {
                discountElement.textContent = '-' + this.formatPrice(this.cart.discount);
                discountElement.style.color = '#10b981';
            } else {
                discountElement.textContent = this.formatPrice(0);
                discountElement.style.color = 'inherit';
            }
        }
        
        if (shippingElement) {
            shippingElement.textContent = this.cart.shipping === 0 ? 'Gratuite' : this.formatPrice(this.cart.shipping);
        }
        
        if (totalElement) {
            totalElement.textContent = this.formatPrice(this.cart.total);
        }
    }

bindCartItemEvents() {
    // Boutons de quantité (Plus / Moins)
document.querySelectorAll('.quantity-btn').forEach(btn => {
    btn.onclick = async (e) => {
        const action = e.currentTarget.classList.contains('plus') ? 'increase' : 'decrease';
        const cartItem = e.currentTarget.closest('.cart-item');
        const cartItemId = cartItem.dataset.cartItemId;
        const display = cartItem.querySelector('.quantity-display');
        let quantity = parseInt(display.textContent);

        if (action === 'increase') quantity++;
        else if (action === 'decrease' && quantity > 1) quantity--;

        await this.updateQuantity(cartItemId, quantity);
    };
});
    
    // Boutons de suppression
    document.querySelectorAll('.remove-btn').forEach(btn => {
        btn.onclick = async (e) => {
            const cartItemId = e.currentTarget.closest('.cart-item').dataset.cartItemId;
            if(confirm('Supprimer cet article ?')) {
                await this.removeItem(cartItemId);
            }
        };
    });
}

   formatPrice(amount) {
    if (!amount && amount !== 0) return '0 F CFA';
    return new Intl.NumberFormat('fr-FR').format(amount) + ' F CFA';
}

    showNotification(message, type = 'info') {
        // Créer le style si nécessaire
        if (!document.getElementById('cart-notification-styles')) {
            const style = document.createElement('style');
            style.id = 'cart-notification-styles';
            style.textContent = `
                .cart-notification {
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
                
                .cart-notification.show {
                    transform: translateX(0);
                }
                
                .cart-notification.error {
                    background: #dc2626;
                }
                
                .cart-notification.info {
                    background: #3b82f6;
                }
            `;
            document.head.appendChild(style);
        }
        
        const notification = document.createElement('div');
        notification.className = `cart-notification ${type}`;
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

    // Récupérer le panier pour usage externe
    getCart() {
        return this.cart;
    }
}

// Initialisation globale
if (!window.cartManager) {
    window.cartManager = new CartManager();
}

export default CartManager;