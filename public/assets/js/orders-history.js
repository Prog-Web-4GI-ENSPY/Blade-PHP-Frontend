/**
 * ORDERS-HISTORY.JS - Gestion de l'Historique des Commandes
 * ==========================================================
 * Ce fichier gère toute la logique de la page d'historique :
 * - Chargement des données depuis JSON
 * - Affichage dynamique des commandes
 * - Filtrage par statut
 * - Calcul des statistiques
 * - Actions sur les commandes (voir détails, racheter, annuler)
 */

// ========================================
// VARIABLES GLOBALES
// ========================================

let ordersData = null; // Stocke toutes les commandes
let currentFilter = 'all'; // Filtre actuel ("all", "en_cours", "recue", "annulee")
const CURRENCY = 'XAF'; // Devise utilisée (Francs CFA)

// ========================================
// INITIALISATION AU CHARGEMENT DE LA PAGE
// ========================================

/**
 * Fonction principale qui se lance quand la page est chargée
 * Elle initialise tous les événements et charge les données
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('📦 Initialisation de la page d\'historique...');
    
    // Charger les données des commandes
    loadOrdersData();
    
    // Initialiser les événements des filtres
    initializeFilters();
});

// ========================================
// CHARGEMENT DES DONNÉES
// ========================================

/**
 * Charge les données des commandes depuis le fichier JSON
 * Cette fonction est asynchrone car elle attend la réponse du serveur
 */
async function loadOrdersData() {
    try {
        console.log('📄 Chargement depuis orders-history.json...');
        
        // Fetch : Récupère le fichier JSON depuis le serveur
        const response = await fetch('/assets/data/orders-history.json');
        
        // Vérifier si la requête a réussi (code 200)
        if (!response.ok) {
            throw new Error('Erreur de chargement du fichier JSON');
        }
        
        // Convertir la réponse en objet JavaScript
        ordersData = await response.json();
        
        console.log('✅ Données chargées:', ordersData);
        
        // Afficher les commandes
        displayOrders();
        
        // Mettre à jour les compteurs
        updateOrdersCount();
        
    } catch (error) {
        // En cas d'erreur, afficher dans la console et à l'utilisateur
        console.error('❌ Erreur lors du chargement:', error);
        showError('Impossible de charger les commandes. Veuillez réactualiser la page.');
    }
}

// ========================================
// AFFICHAGE DES COMMANDES
// ========================================

/**
 * Affiche toutes les commandes (ou les commandes filtrées)
 * Cette fonction génère dynamiquement le HTML pour chaque commande
 */
function displayOrders() {
    // Cacher l'indicateur de chargement
    document.getElementById('loading-indicator').style.display = 'none';
    
    // Vérifier si des commandes existent
    if (!ordersData.orders || ordersData.orders.length === 0) {
        showEmptyOrders();
        return;
    }
    
    // Afficher la section des filtres et la liste
    document.getElementById('filters-section').style.display = 'flex';
    document.getElementById('orders-list').style.display = 'flex';
    document.getElementById('empty-orders-message').style.display = 'none';
    
    // Récupérer le conteneur de la liste
    const ordersList = document.getElementById('orders-list');
    
    // Vider le conteneur avant de le remplir
    ordersList.innerHTML = '';
    
    // Filtrer les commandes selon le filtre actuel
    const filteredOrders = filterOrders(ordersData.orders, currentFilter);
    
    // Si aucune commande ne correspond au filtre
    if (filteredOrders.length === 0) {
        ordersList.innerHTML = `
            <div class="empty-filter-message">
                <i class="fas fa-filter"></i>
                <p>Aucune commande ne correspond à ce filtre.</p>
            </div>
        `;
        return;
    }
    
    // Créer une carte pour chaque commande
    filteredOrders.forEach((order, index) => {
        const orderCard = createOrderCard(order, index);
        ordersList.appendChild(orderCard);
    });
    
    console.log(`✅ ${filteredOrders.length} commande(s) affichée(s)`);
}

/**
 * Filtre les commandes selon le statut sélectionné
 * @param {Array} orders - Tableau de toutes les commandes
 * @param {string} filter - Filtre à appliquer ("all", "en_cours", etc.)
 * @returns {Array} - Tableau des commandes filtrées
 */
function filterOrders(orders, filter) {
    // Si "all", retourner toutes les commandes
    if (filter === 'all') {
        return orders;
    }
    
    // Sinon, filtrer par statut
    return orders.filter(order => order.statut === filter);
}

/**
 * Crée l'élément HTML pour une carte de commande
 * @param {Object} order - Objet commande du JSON
 * @param {number} index - Index de la commande dans le tableau
 * @returns {HTMLElement} - L'élément div de la carte
 */
function createOrderCard(order, index) {
    // Créer l'élément principal de la carte
    const card = document.createElement('div');
    card.className = 'order-card';
    card.dataset.orderId = order.id; // Stocker l'ID pour référence
    
    // Formater les dates
    const orderDate = formatDate(order.date_commande);
    const estimatedDelivery = formatDate(order.date_livraison_estimee);
    
    // Construire le HTML de la carte
    card.innerHTML = `
        <!-- En-tête de la commande -->
        <div class="order-header">
            <div class="order-info">
                <!-- Numéro de commande -->
                <div class="order-id">${order.id}</div>
                <!-- Date de commande -->
                <div class="order-date">
                    <i class="fas fa-calendar-alt"></i>
                    Commandé le ${orderDate}
                </div>
            </div>
            <!-- Badge de statut -->
            <div class="order-status status-${order.statut}">
                ${getStatusIcon(order.statut)} ${getStatusLabel(order.statut)}
            </div>
        </div>
        
        <!-- Corps de la carte : Articles commandés -->
        <div class="order-body">
            <div class="order-items">
                ${order.articles.map(item => createOrderItemHTML(item)).join('')}
            </div>
            
            <!-- Résumé de la commande -->
            <div class="order-summary">
                ${createOrderSummaryHTML(order)}
            </div>
            
            <!-- Informations de livraison -->
            <div class="delivery-info">
                <div class="delivery-title">
                    <i class="fas fa-truck"></i>
                    Informations de livraison
                </div>
                <div class="delivery-details">
                    ${createDeliveryInfoHTML(order)}
                </div>
            </div>
        </div>
        
        <!-- Pied de carte : Actions -->
        <div class="order-footer">
            <div class="order-actions">
                ${createOrderActionsHTML(order)}
            </div>
        </div>
    `;
    
    // Attacher les événements aux boutons
    attachOrderCardEvents(card, order);
    
    return card;
}

/**
 * Génère le HTML d'un article dans la commande
 * @param {Object} item - Objet article du JSON
 * @returns {string} - HTML de l'article
 */
function createOrderItemHTML(item) {
    return `
        <div class="order-item">
            <!-- Image du produit -->
            <img src="${item.image}" alt="${item.nom}" class="item-image" 
                 onerror="this.src='/assets/images/placeholder.png'">
            
            <!-- Détails du produit -->
            <div class="item-details">
                <div class="item-name">${item.nom}</div>
                <div class="item-brand">${item.marque}</div>
                <div class="item-color">
                    <i class="fas fa-palette"></i>
                    Couleur: ${item.couleur}
                </div>
                <div class="item-quantity-price">
                    <span class="item-quantity">Quantité: ${item.quantite}</span>
                    <span class="item-price">${formatPrice(item.prix_unitaire)}</span>
                </div>
            </div>
        </div>
    `;
}

/**
 * Génère le HTML du résumé de commande (prix)
 * @param {Object} order - Objet commande
 * @returns {string} - HTML du résumé
 */
function createOrderSummaryHTML(order) {
    // Calculer le sous-total (somme de tous les articles)
    const subtotal = order.articles.reduce((sum, item) => {
        return sum + (item.prix_unitaire * item.quantite);
    }, 0);
    
    return `
        <div class="summary-row">
            <span class="summary-label">Sous-total:</span>
            <span class="summary-value">${formatPrice(subtotal)}</span>
        </div>
        ${order.reduction > 0 ? `
            <div class="summary-row">
                <span class="summary-label">Réduction:</span>
                <span class="summary-value">-${formatPrice(order.reduction)}</span>
            </div>
        ` : ''}
        <div class="summary-row">
            <span class="summary-label">Frais de livraison:</span>
            <span class="summary-value">${order.frais_livraison > 0 ? formatPrice(order.frais_livraison) : 'Gratuit'}</span>
        </div>
        <div class="summary-row summary-total">
            <span class="summary-label">Total:</span>
            <span class="summary-value">${formatPrice(order.total)}</span>
        </div>
    `;
}

/**
 * Génère le HTML des informations de livraison
 * @param {Object} order - Objet commande
 * @returns {string} - HTML des infos de livraison
 */
function createDeliveryInfoHTML(order) {
    const addr = order.adresse_livraison;
    let html = `
        <p><strong>${addr.nom_complet}</strong></p>
        <p>${addr.adresse}</p>
        <p>${addr.ville}, ${addr.pays}</p>
        <p><i class="fas fa-phone"></i> ${addr.telephone}</p>
        <p><i class="fas fa-credit-card"></i> Paiement: ${order.methode_paiement}</p>
    `;
    
    // Ajouter les dates selon le statut
    if (order.statut === 'en_cours') {
        html += `<p><i class="fas fa-clock"></i> Livraison estimée: ${formatDate(order.date_livraison_estimee)}</p>`;
    } else if (order.statut === 'recue') {
        html += `<p><i class="fas fa-check"></i> Livrée le: ${formatDate(order.date_livraison_reelle)}</p>`;
    } else if (order.statut === 'annulee') {
        html += `<p><i class="fas fa-times"></i> Annulée le: ${formatDate(order.date_annulation)}</p>`;
        if (order.motif_annulation) {
            html += `<p><i class="fas fa-info-circle"></i> Motif: ${order.motif_annulation}</p>`;
        }
    }
    
    return html;
}

/**
 * Génère le HTML des boutons d'action selon le statut
 * @param {Object} order - Objet commande
 * @returns {string} - HTML des boutons
 */
function createOrderActionsHTML(order) {
    let html = `
        <button class="action-btn btn-primary" data-action="details">
            <i class="fas fa-eye"></i>
            Voir les détails
        </button>
    `;
    
    // Actions spécifiques selon le statut
    if (order.statut === 'en_cours') {
        html += `
            <button class="action-btn btn-danger" data-action="cancel">
                <i class="fas fa-times"></i>
                Annuler la commande
            </button>
        `;
    } else if (order.statut === 'recue' || order.statut === 'annulee') {
        html += `
            <button class="action-btn btn-secondary" data-action="reorder">
                <i class="fas fa-redo"></i>
                Racheter
            </button>
        `;
    }
    
    return html;
}

/**
 * Attache les événements aux boutons de la carte
 * @param {HTMLElement} card - L'élément carte
 * @param {Object} order - L'objet commande
 */
function attachOrderCardEvents(card, order) {
    // Récupérer tous les boutons d'action
    const buttons = card.querySelectorAll('.action-btn');
    
    // Attacher un événement à chaque bouton
    buttons.forEach(button => {
        button.addEventListener('click', function() {
            const action = this.dataset.action;
            handleOrderAction(action, order);
        });
    });
}

// ========================================
// GESTION DES ACTIONS SUR LES COMMANDES
// ========================================

/**
 * Gère les actions sur une commande (voir, annuler, racheter)
 * @param {string} action - Type d'action ("details", "cancel", "reorder")
 * @param {Object} order - Objet commande
 */
function handleOrderAction(action, order) {
    console.log(`🎬 Action "${action}" sur commande ${order.id}`);
    
    switch(action) {
        case 'details':
            viewOrderDetails(order);
            break;
        case 'cancel':
            cancelOrder(order);
            break;
        case 'reorder':
            reorderItems(order);
            break;
        default:
            console.warn('Action inconnue:', action);
    }
}

/**
 * Affiche les détails d'une commande (modal ou nouvelle page)
 * @param {Object} order - Objet commande
 */
function viewOrderDetails(order) {
    console.log('👁️ Affichage des détails de', order.id);
    
    // Pour l'instant, afficher dans une alerte
    // Dans une vraie application, ouvrir un modal ou rediriger
    alert(`Détails de la commande ${order.id}\n\n` +
          `Date: ${formatDate(order.date_commande)}\n` +
          `Statut: ${getStatusLabel(order.statut)}\n` +
          `Total: ${formatPrice(order.total)}\n` +
          `Articles: ${order.articles.length}`);
    
    // TODO: Implémenter une vraie page de détails ou un modal
}

/**
 * Annule une commande après confirmation
 * @param {Object} order - Objet commande
 */
function cancelOrder(order) {
    console.log('❌ Tentative d\'annulation de', order.id);
    
    // Demander confirmation
    const confirmation = confirm(
        `Êtes-vous sûr de vouloir annuler la commande ${order.id} ?\n\n` +
        `Montant: ${formatPrice(order.total)}\n` +
        `Cette action est irréversible.`
    );
    
    if (confirmation) {
        // Mettre à jour le statut localement
        order.statut = 'annulee';
        order.date_annulation = new Date().toISOString();
        order.motif_annulation = 'Annulation par le client';
        
        // Réafficher les commandes
        displayOrders();
        updateOrdersCount();
        
        // Afficher une notification
        showNotification('Commande annulée avec succès', 'success');
        
        console.log('✅ Commande annulée:', order.id);
        
        // TODO: Envoyer la mise à jour au serveur
    }
}

/**
 * Rajoute les articles d'une commande au panier
 * @param {Object} order - Objet commande
 */
function reorderItems(order) {
    console.log('🔄 Racheter les articles de', order.id);
    
    // Demander confirmation
    const confirmation = confirm(
        `Ajouter tous les articles de la commande ${order.id} au panier ?\n\n` +
        `${order.articles.length} article(s)\n` +
        `Total: ${formatPrice(order.total)}`
    );
    
    if (confirmation) {
        // TODO: Ajouter les articles au panier (localStorage ou API)
        showNotification('Articles ajoutés au panier !', 'success');
        
        // Rediriger vers le panier après 2 secondes
        setTimeout(() => {
            window.location.href = '/panier.html';
        }, 2000);
        
        console.log('✅ Articles ajoutés au panier');
    }
}

// ========================================
// FILTRAGE DES COMMANDES
// ========================================

/**
 * Initialise les événements des boutons de filtre
 */
function initializeFilters() {
    // Récupérer tous les boutons de filtre
    const filterButtons = document.querySelectorAll('.filter-btn');
    
    // Attacher un événement à chaque bouton
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Récupérer le filtre depuis l'attribut data-filter
            const filter = this.dataset.filter;
            
            // Appliquer le filtre
            applyFilter(filter);
            
            // Mettre à jour l'apparence des boutons
            updateFilterButtons(this);
        });
    });
}

/**
 * Applique un filtre et réaffiche les commandes
 * @param {string} filter - Filtre à appliquer
 */
function applyFilter(filter) {
    console.log(`🔍 Application du filtre: ${filter}`);
    
    // Mettre à jour le filtre actuel
    currentFilter = filter;
    
    // Réafficher les commandes avec le nouveau filtre
    displayOrders();
}

/**
 * Met à jour l'apparence des boutons de filtre
 * @param {HTMLElement} activeButton - Le bouton actuellement cliqué
 */
function updateFilterButtons(activeButton) {
    // Retirer la classe "active" de tous les boutons
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Ajouter la classe "active" au bouton cliqué
    activeButton.classList.add('active');
}

// ========================================
// MISE À JOUR DES COMPTEURS
// ========================================

/**
 * Met à jour tous les compteurs de la page
 */
function updateOrdersCount() {
    if (!ordersData || !ordersData.orders) return;
    
    const orders = ordersData.orders;
    
    // Compter le total
    const totalCount = orders.length;
    
    // Compter par statut
    const enCoursCount = orders.filter(o => o.statut === 'en_cours').length;
    const recueCount = orders.filter(o => o.statut === 'recue').length;
    const annuleeCount = orders.filter(o => o.statut === 'annulee').length;
    
    // Mettre à jour l'affichage
    document.getElementById('total-orders').textContent = totalCount;
    document.getElementById('count-all').textContent = totalCount;
    document.getElementById('count-en_cours').textContent = enCoursCount;
    document.getElementById('count-recue').textContent = recueCount;
    document.getElementById('count-annulee').textContent = annuleeCount;
    
    console.log(`📊 Compteurs: Total=${totalCount}, En cours=${enCoursCount}, Reçues=${recueCount}, Annulées=${annuleeCount}`);
}

// ========================================
// FONCTIONS UTILITAIRES
// ========================================

/**
 * Formate un prix en devise locale (XAF)
 * @param {number} price - Prix à formater
 * @returns {string} - Prix formaté (ex: "18 000 XAF")
 */
function formatPrice(price) {
    // Formater avec séparateur de milliers (espace)
    const formattedNumber = price.toLocaleString('fr-FR', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    });
    
    return `${formattedNumber} ${CURRENCY}`;
}

/**
 * Formate une date ISO en format lisible
 * @param {string} isoDate - Date au format ISO 8601
 * @returns {string} - Date formatée (ex: "15 janvier 2025")
 */
function formatDate(isoDate) {
    const date = new Date(isoDate);
    
    // Options de formatage français
    const options = {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
    };
    
    return date.toLocaleDateString('fr-FR', options);
}

/**
 * Retourne le label lisible d'un statut
 * @param {string} status - Statut brut ("en_cours", "recue", "annulee")
 * @returns {string} - Label lisible ("En cours", "Reçue", "Annulée")
 */
function getStatusLabel(status) {
    const labels = {
        'en_cours': 'En cours',
        'recue': 'Reçue',
        'annulee': 'Annulée'
    };
    
    return labels[status] || status;
}

/**
 * Retourne l'icône Font Awesome d'un statut
 * @param {string} status - Statut brut
 * @returns {string} - HTML de l'icône
 */
function getStatusIcon(status) {
    const icons = {
        'en_cours': '<i class="fas fa-clock"></i>',
        'recue': '<i class="fas fa-check-circle"></i>',
        'annulee': '<i class="fas fa-times-circle"></i>'
    };
    
    return icons[status] || '';
}

/**
 * Affiche le message de liste vide
 */
function showEmptyOrders() {
    document.getElementById('loading-indicator').style.display = 'none';
    document.getElementById('filters-section').style.display = 'none';
    document.getElementById('orders-list').style.display = 'none';
    document.getElementById('empty-orders-message').style.display = 'block';
    
    // Mettre à jour les compteurs à 0
    document.getElementById('total-orders').textContent = '0';
}

/**
 * Affiche un message d'erreur
 * @param {string} message - Message d'erreur
 */
function showError(message) {
    document.getElementById('loading-indicator').style.display = 'none';
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message';
    errorDiv.innerHTML = `
        <i class="fas fa-exclamation-circle"></i>
        <p>${message}</p>
    `;
    
    document.querySelector('.orders-container').prepend(errorDiv);
}

/**
 * Affiche une notification temporaire
 * @param {string} message - Message à afficher
 * @param {string} type - Type de notification ('success', 'error', 'info')
 */
function showNotification(message, type = 'info') {
    // Créer l'élément de notification
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'times-circle' : 'info-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Ajouter au body
    document.body.appendChild(notification);
    
    // Afficher avec animation
    setTimeout(() => notification.classList.add('show'), 10);
    
    // Masquer après 3 secondes
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}