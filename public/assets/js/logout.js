// logout.js - Gestion de la déconnexion
document.addEventListener('DOMContentLoaded', () => {
  // Fonction de déconnexion globale
  window.logoutUser = async function() {
    try {
      // Vérifier si l'utilisateur est connecté
      if (!localStorage.getItem('auth_token')) {
        // Déjà déconnecté, nettoyer le localStorage
        localStorage.removeItem('user');
        localStorage.removeItem('lastLogin');
        window.location.href = 'login.html';
        return;
      }

      // Appel API pour la déconnexion
      if (typeof apiService !== 'undefined') {
        await apiService.logout();
      }

      // Nettoyer le localStorage
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
      localStorage.removeItem('lastLogin');

      // Redirection vers la page de connexion
      showNotification('Déconnexion réussie', 'success');
      setTimeout(() => {
        window.location.href = 'login.html';
      }, 1000);

    } catch (error) {
      console.error('Logout error:', error);
      // En cas d'erreur, nettoyer quand même le localStorage
      localStorage.removeItem('auth_token');
      localStorage.removeItem('user');
      localStorage.removeItem('lastLogin');
      window.location.href = 'login.html';
    }
  };

  // Attacher la déconnexion aux boutons de logout
  const logoutButtons = document.querySelectorAll('.logout-btn, [onclick*="logout"]');
  logoutButtons.forEach(button => {
    button.addEventListener('click', (e) => {
      e.preventDefault();
      logoutUser();
    });
  });

  // Fonction de notification
  function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.innerHTML = `
      <i class="fas fa-${getNotificationIcon(type)}"></i>
      <span>${message}</span>
    `;
    
    notification.style.cssText = `
      position: fixed;
      top: 100px;
      right: 20px;
      background: ${getNotificationColor(type)};
      color: white;
      padding: 15px 20px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      z-index: 10000;
      display: flex;
      align-items: center;
      gap: 10px;
      max-width: 300px;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.remove();
    }, 3000);
  }

  function getNotificationIcon(type) {
    const icons = {
      success: 'check-circle',
      error: 'exclamation-circle',
      warning: 'exclamation-triangle',
      info: 'info-circle'
    };
    return icons[type] || 'info-circle';
  }

  function getNotificationColor(type) {
    const colors = {
      success: '#4CAF50',
      error: '#f44336',
      warning: '#ff9800',
      info: '#2196F3'
    };
    return colors[type] || '#2196F3';
  }
});