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
            itemCount: data.item_count || 0
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
        const cartBadges = document.querySelectorAll('.cart-badge, .cart-item-count-badge');
        cartBadges.forEach(badge => {
            badge.textContent = this.cart.itemCount;
            badge.style.display = this.cart.itemCount > 0 ? 'flex' : 'none';
        });
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
        
        // Vérifier si le panier est vide
        if (this.cart.items.length === 0) {
            if (emptyCartMessage) emptyCartMessage.style.display = 'flex';
            if (cartContent) cartContent.style.display = 'none';
            
            // Mettre à jour le compteur
            document.getElementById('total-items').textContent = '0';
            return;
        }
        
        // Afficher le contenu du panier
        if (emptyCartMessage) emptyCartMessage.style.display = 'none';
        if (cartContent) cartContent.style.display = 'block';
        
        // Mettre à jour le compteur
        document.getElementById('total-items').textContent = this.cart.itemCount;
        
        // Rendre les articles
        container.innerHTML = this.cart.items.map(item => this.createCartItemHTML(item)).join('');
        
        // Mettre à jour le résumé
        this.updateSummary();
        
        // Ajouter les événements
        this.bindCartItemEvents();
    }

    createCartItemHTML(item) {
        const price = this.formatPrice(item.price);
        const total = this.formatPrice(item.total);
        const imageUrl = item.product?.image_url || '/assets/images/placeholder.jpg';
        
        return `
            <div class="cart-item" data-cart-item-id="${item.id}">
                <div class="cart-item-image">
                    <img src="${imageUrl}" alt="${item.product?.name || 'Produit'}">
                </div>
                
                <div class="cart-item-details">
                    <h3 class="cart-item-title">${item.product?.name || 'Produit'}</h3>
                    <p class="cart-item-description">${item.product?.description?.substring(0, 100) || ''}...</p>
                    <div class="cart-item-attributes">
                        <span class="cart-item-brand">${item.product?.brand || 'Marque'}</span>
                        <span class="cart-item-sku">SKU: ${item.product?.sku || 'N/A'}</span>
                    </div>
                </div>
                
                <div class="cart-item-price">
                    <span class="price-unit">${price}</span>
                    <span class="price-total-label">Total: ${total}</span>
                </div>
                
                <div class="cart-item-quantity">
                    <button class="quantity-btn minus" data-action="decrease">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" class="quantity-input" value="${item.quantity}" min="1" max="99" 
                           data-cart-item-id="${item.id}">
                    <button class="quantity-btn plus" data-action="increase">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
                
                <div class="cart-item-actions">
                    <button class="btn-remove-item" data-cart-item-id="${item.id}">
                        <i class="fas fa-trash"></i>
                        Supprimer
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
        // Boutons de quantité
        document.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const action = e.target.closest('.quantity-btn').dataset.action;
                const input = e.target.closest('.cart-item-quantity').querySelector('.quantity-input');
                const cartItemId = input.dataset.cartItemId;
                let quantity = parseInt(input.value);
                
                if (action === 'increase') {
                    quantity++;
                } else if (action === 'decrease' && quantity > 1) {
                    quantity--;
                }
                
                await this.updateQuantity(cartItemId, quantity);
            });
        });
        
        // Input de quantité
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', async (e) => {
                const cartItemId = e.target.dataset.cartItemId;
                const quantity = parseInt(e.target.value);
                
                if (quantity >= 1 && quantity <= 99) {
                    await this.updateQuantity(cartItemId, quantity);
                } else {
                    e.target.value = 1;
                }
            });
        });
        
        // Boutons de suppression
        document.querySelectorAll('.btn-remove-item').forEach(btn => {
            btn.addEventListener('click', async (e) => {
                const cartItemId = e.target.closest('.btn-remove-item').dataset.cartItemId;
                await this.removeItem(cartItemId);
            });
        });
    }

    formatPrice(amount) {
        if (!amount && amount !== 0) return 'XAF0.00';
        return new Intl.NumberFormat('fr-FR', {
            style: 'currency',
            currency: 'XOF',
            minimumFractionDigits: 0
        }).format(amount);
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