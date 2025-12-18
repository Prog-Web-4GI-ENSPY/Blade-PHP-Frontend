/**
 * PANIER.JS - Gestion Hybride (API + LocalStorage)
 */

window.USER_STORAGE_KEY = window.USER_STORAGE_KEY || 'shopcart_user_data';
window.CART_STORAGE_KEY = window.CART_STORAGE_KEY || 'shopcart_cart';

// Initialise CartData globalement s'il n'existe pas
if (typeof window.CartData === 'undefined') {
    window.CartData = { cart_items: [], total: 0 };
}
// Alias pour la compatibilité avec votre code existant dans panier.js
var cartData = window.CartData;
document.addEventListener('DOMContentLoaded', async () => {
    console.log('🛒 Initialisation du panier...');
    
    // Initialisation du service API au cas où
    if (!window.apiService) {
        console.error("api-service.js n'est pas chargé !");
        return;
    }

    await initCart();

    // Gestion du bouton de commande avec vérification de sécurité
    const checkoutBtn = document.getElementById('checkout-button');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            if (typeof window.handleCheckout === 'function') {
                window.handleCheckout();
            } else {
                console.error("handleCheckout n'est pas défini globalement.");
            }
        });
    }

    document.getElementById('clear-cart-button')?.addEventListener('click', clearCart);
});
/**
 * Initialisation : Priorité à l'API si connecté, sinon LocalStorage
 */
async function initCart() {
    const loader = document.getElementById('loading-indicator');
    if (loader) loader.style.display = 'block';

    try {
        if (window.apiService && window.apiService.token) {
            console.log('🌐 Récupération du panier via API...');
            const response = await window.apiService.getCart();
            
            // ANALYSE DE LA RÉPONSE :
            // Si response.data existe, on cherche 'items' ou 'cart_items' à l'intérieur
            let items = [];
            if (response.data) {
                items = response.data.items || response.data.cart_items || [];
            } else if (response.items) {
                items = response.items;
            }

            window.CartData.cart_items = items;
            console.log("✅ Articles extraits :", window.CartData.cart_items);

        } else {
            console.log('📦 Récupération du panier via LocalStorage...');
            const saved = localStorage.getItem(window.CART_STORAGE_KEY);
            if (saved) {
                const parsed = JSON.parse(saved);
                window.CartData.cart_items = parsed.cart_items || parsed.items || [];
            }
        }
        displayCart();
    } catch (error) {
        console.error("❌ Détail de l'erreur :", error);
        showError("Erreur lors du chargement du panier.");
    } finally {
        if (loader) loader.style.display = 'none';
    }
}

/**
 * Affichage des articles
 */
function displayCart() {
    const container = document.getElementById('cart-items-container');
    const wrapper = document.getElementById('cart-content-wrapper');
    const emptyMsg = document.getElementById('empty-cart-message');

    // On utilise la référence globale window.CartData pour être cohérent
    const items = window.CartData.cart_items;

    if (!items || items.length === 0) {
        if (wrapper) wrapper.style.display = 'none';
        if (emptyMsg) emptyMsg.style.display = 'block';
        updateCartBadge(0);
        return;
    }

    if (wrapper) wrapper.style.display = 'flex';
    if (emptyMsg) emptyMsg.style.display = 'none';
    container.innerHTML = '';

    items.forEach((item, index) => {
        // --- MAPPING SPÉCIFIQUE À VOTRE LOG ---
        // Les infos sont dans item.product_variant.product (ou directement product_variant)
        const variant = item.product_variant || {};
        const product = variant.product || variant; // On remonte d'un niveau si nécessaire
        
        const itemName = product.name || product.nom || "Appareil électronique";
        const itemPrice = item.unit_price || variant.price || 0;
        const itemQty = item.quantity || 1;
        const itemImage = variant.image || product.image || 'default.jpg';

        const div = document.createElement('div');
        div.className = 'cart-item';
        div.innerHTML = `
            <img src="${window.apiService.getImageUrl(itemImage)}" class="item-image" alt="${itemName}">
            <div class="item-details">
                <h3 class="item-name">${itemName}</h3>
                <p class="item-price">${formatPrice(itemPrice)}</p>
            </div>
            <div class="item-actions">
                <div class="quantity-controls">
                    <button class="quantity-btn" onclick="changeQuantity(${index}, -1)">-</button>
                    <span class="quantity-display">${itemQty}</span>
                    <button class="quantity-btn" onclick="changeQuantity(${index}, 1)">+</button>
                </div>
                <button class="remove-btn" onclick="removeItem(${index})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(div);
    });

    updateSummary();
}

async function clearCart() {
    if (!confirm("Voulez-vous vraiment vider votre panier ?")) return;

    try {
        if (window.apiService.token) {
            // Appel à votre API Laravel
            await window.apiService.clearCart(); 
        }
        // Nettoyage local
        cartData = { cart_items: [], total: 0 };
        localStorage.removeItem(window.CART_STORAGE_KEY);
        
        displayCart();
        showNotification("Panier vidé", "success");
    } catch (error) {
        showNotification("Erreur lors du vidage du panier", "error");
    }
}

/**
 * Changement de quantité avec synchro API
 */
async function changeQuantity(index, delta) {
    const item = cartData.cart_items[index];
    const currentQty = item.quantity || item.quantite;
    const newQty = currentQty + delta;

    if (newQty < 1) return removeItem(index);
    if (newQty > 10) return showNotification("Maximum 10 articles", "info");

    // Mise à jour locale immédiate (Optimistic UI)
    if (item.quantity) item.quantity = newQty; else item.quantite = newQty;
    displayCart();

    try {
        if (window.apiService.token && item.id) {
            await window.apiService.updateCartItem(item.id, newQty);
        } else {
            saveLocalCart();
        }
    } catch (error) {
        showNotification("Erreur de synchronisation", "error");
        initCart(); // Recharger l'état réel
    }
}

/**
 * Suppression d'un article
 */
async function removeItem(index) {
    const item = cartData.cart_items[index];
    if (!confirm(`Supprimer ${item.product?.name || item.nom} ?`)) return;

    try {
        if (window.apiService.token && item.id) {
            await window.apiService.removeCartItem(item.id);
        }
        cartData.cart_items.splice(index, 1);
        saveLocalCart();
        displayCart();
        showNotification("Article supprimé", "success");
    } catch (error) {
        showNotification("Erreur lors de la suppression", "error");
    }
}

/**
 * Calcul des totaux
 */
function updateSummary() {
    const items = window.CartData.cart_items;
    const subtotal = items.reduce((sum, item) => {
        const price = parseFloat(item.unit_price || 0);
        const qty = parseInt(item.quantity || 0);
        return sum + (price * qty);
    }, 0);

    const subtotalValue = document.getElementById('subtotal-value');
    if (subtotalValue) subtotalValue.textContent = formatPrice(subtotal);
    
    const totalValue = document.getElementById('total-value');
    if (totalValue) totalValue.textContent = formatPrice(subtotal);

    const count = items.reduce((sum, item) => sum + parseInt(item.quantity || 0), 0);
    updateCartBadge(count);
}

function formatPrice(amount) {
    return new Intl.NumberFormat('fr-FR', { style: 'currency', currency: 'XAF' }).format(amount);
}

function saveLocalCart() {
    localStorage.setItem(CART_STORAGE_KEY, JSON.stringify(cartData));
}

function updateCartBadge(count) {
    const badge = document.querySelector('.cart-count');
    if (badge) badge.textContent = count;
}

function showNotification(msg, type) {
    console.log(`[${type}] ${msg}`);
    // Implémentez votre toast ici
}