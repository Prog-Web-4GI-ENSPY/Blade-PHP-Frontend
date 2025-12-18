// register.js - VERSION AVEC API
document.addEventListener('DOMContentLoaded', () => {
  const passwordInputs = document.querySelectorAll('input[type="password"]');

  passwordInputs.forEach(passwordInput => {
    const wrapper = document.createElement('div');
    wrapper.classList.add('password-wrapper');
    
    passwordInput.parentNode.insertBefore(wrapper, passwordInput);
    wrapper.appendChild(passwordInput);

    const toggleIcon = document.createElement('i');
    toggleIcon.classList.add('fas', 'fa-eye', 'password-toggle-icon');
    
    wrapper.appendChild(toggleIcon);

    toggleIcon.addEventListener('click', () => {
      const isPassword = passwordInput.getAttribute('type') === 'password';
      passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
      toggleIcon.classList.toggle('fa-eye-slash');
    });
  });

  // --- FORM SUBMISSION WITH API ---
  const form = document.querySelector('.login-form');

  if (form) {
    form.addEventListener('submit', async (event) => {
      event.preventDefault();

      const emailInput = form.querySelector('input[name="login"]');
      const nameInput = form.querySelector('input[name="username"]');
      const passwordInput = form.querySelector('input[name="password"]');
      const confirmPasswordInput = form.querySelector('input[name="confirm_password"]');

      // Validation côté client
      if (passwordInput.value !== confirmPasswordInput.value) {
        showNotification('Les mots de passe ne correspondent pas.', 'error');
        return;
      }

      if (passwordInput.value.length < 8) {
        showNotification('Le mot de passe doit contenir au moins 8 caractères.', 'error');
        return;
      }

      // Vérifier que le service API est disponible
      if (typeof apiService === 'undefined') {
        alert('Erreur: Service API non disponible. Veuillez recharger la page.');
        return;
      }

      try {
        // Afficher un indicateur de chargement
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        submitBtn.textContent = 'Création du compte...';
        submitBtn.disabled = true;

        // Appel API pour l'inscription
        const result = await apiService.register({
          name: nameInput.value,
          email: emailInput.value,
          password: passwordInput.value,
          password_confirmation: confirmPasswordInput.value
        });

        if (result.token) {
          // Inscription réussie
          showNotification('Compte créé avec succès! Redirection...', 'success');
          
          // Sauvegarder aussi dans localStorage pour la compatibilité
          localStorage.setItem('user', JSON.stringify(result.user));
          
          form.reset();
          
          // Redirection vers la page de connexion
          setTimeout(() => {
            window.location.href = 'login';
          }, 2000);
        }
        
      } catch (error) {
        console.error('Registration error:', error);
        
        // Gestion spécifique des erreurs
        if (error.message.includes('422') || error.message.includes('validation')) {
          showNotification('Données invalides. Vérifiez votre email et mot de passe.', 'error');
        } else if (error.message.includes('409') || error.message.includes('already exists')) {
          showNotification('Un compte avec cet email existe déjà.', 'error');
        } else if (error.message.includes('Network')) {
          showNotification('Erreur de connexion. Vérifiez votre connexion internet.', 'error');
        } else {
          showNotification('Erreur lors de la création du compte. Veuillez réessayer.', 'error');
        }
        
        // Réactiver le bouton
        const submitBtn = form.querySelector('button[type="submit"]');
        submitBtn.textContent = 'Créer un compte';
        submitBtn.disabled = false;
      }
    });
  }

  // Fonction de notification (identique à login.js)
  function showNotification(message, type = 'info') {
    const existingNotifications = document.querySelectorAll('.notification');
    existingNotifications.forEach(notif => notif.remove());

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
      transform: translateX(400px);
      opacity: 0;
      transition: all 0.3s ease;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
      notification.style.transform = 'translateX(0)';
      notification.style.opacity = '1';
    }, 10);
    
    setTimeout(() => {
      notification.style.transform = 'translateX(400px)';
      notification.style.opacity = '0';
      setTimeout(() => notification.remove(), 300);
    }, 4000);
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