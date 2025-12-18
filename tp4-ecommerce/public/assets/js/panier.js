/**
 * PANIER.JS - Gestion des évènements de la page panier
 */
document.addEventListener('DOMContentLoaded', () => {
    console.log('✅ Page Panier initialisée');

    // Gestion du bouton de paiement
    const checkoutBtn = document.getElementById('checkout-button');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', () => {
            const token = localStorage.getItem('auth_token');
            if (!token) {
                alert("Veuillez vous connecter pour finaliser votre commande.");
                window.location.href = "/login";
                return;
            }
            
            // Redirection vers le checkout
            window.location.href = "/checkout";
        });
    }
});