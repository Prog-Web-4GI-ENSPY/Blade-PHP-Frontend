// JavaScript pour gérer le menu mobile
document.addEventListener('DOMContentLoaded', function() {
  const hamburger = document.getElementById('hamburger');
  const navLinks = document.getElementById('navLinks');
  const overlay = document.getElementById('overlay');
  const searchBar = document.getElementById('searchBar');
  const userActions = document.getElementById('userActions');
  const categoriesLabel = document.getElementById('categoriesLabel');
  const dropdownContent = document.getElementById('dropdownContent');
  const accountButton = document.getElementById('accountButton');
  const loginButton = document.getElementById('loginButton');

  // Initialiser toutes les fonctionnalités
  updateCartBadge();
  updateUserButtons();
  initDarkMode();

  // Toggle menu mobile
  if (hamburger) {
    hamburger.addEventListener('click', function(e) {
      e.preventDefault();
      toggleMobileMenu();
    });
  }

  // Fermer le menu en cliquant sur l'overlay
  if (overlay) {
    overlay.addEventListener('click', function(e) {
      e.preventDefault();
      closeMobileMenu();
    });
  }

  // Toggle dropdown des catégories sur mobile
  if (categoriesLabel) {
    categoriesLabel.addEventListener('click', function(e) {
      if (window.innerWidth <= 768) {
        e.preventDefault();
        e.stopPropagation();
        if (dropdownContent) {
          dropdownContent.classList.toggle('active');
          // Ajouter une classe active au parent pour la flèche
          categoriesLabel.parentElement.classList.toggle('active');
        }
      }
    });
  }

  // Fermer le menu en cliquant sur un lien
  const navItems = document.querySelectorAll('.nav-links a:not(.categories-dropdown label)');
  navItems.forEach(item => {
    item.addEventListener('click', function() {
      if (window.innerWidth <= 768) {
        closeMobileMenu();
      }
    });
  });

  // Fermer le dropdown si on clique en dehors
  document.addEventListener('click', function(e) {
    if (window.innerWidth <= 768) {
      if (dropdownContent && dropdownContent.classList.contains('active') && 
          !e.target.closest('.categories-dropdown')) {
        dropdownContent.classList.remove('active');
        categoriesLabel.parentElement.classList.remove('active');
      }
    }
  });

  // Gérer le redimensionnement de la fenêtre
  window.addEventListener('resize', function() {
    if (window.innerWidth > 768) {
      closeMobileMenu();
      if (dropdownContent) {
        dropdownContent.classList.remove('active');
        categoriesLabel.parentElement.classList.remove('active');
      }
    }
  });

  // Fonction pour toggle le menu mobile
  function toggleMobileMenu() {
    const isActive = navLinks.classList.contains('active');
    
    if (isActive) {
      closeMobileMenu();
    } else {
      openMobileMenu();
    }
  }

  // Fonction pour ouvrir le menu mobile
  function openMobileMenu() {
    navLinks.classList.add('active');
    overlay.classList.add('active');
    searchBar.classList.add('active');
    userActions.classList.add('active');
    hamburger.classList.add('active');
    document.body.style.overflow = 'hidden'; // Empêcher le scroll
  }

  // Fonction pour fermer le menu mobile
  function closeMobileMenu() {
    navLinks.classList.remove('active');
    overlay.classList.remove('active');
    searchBar.classList.remove('active');
    userActions.classList.remove('active');
    hamburger.classList.remove('active');
    if (dropdownContent) {
      dropdownContent.classList.remove('active');
      categoriesLabel.parentElement.classList.remove('active');
    }
    document.body.style.overflow = ''; // Rétablir le scroll
  }

  // Écouter les changements de localStorage pour mettre à jour les boutons
  window.addEventListener('storage', function(e) {
    if (e.key === 'user') {
      updateUserButtons();
    }
    if (e.key === 'theme') {
      // Mettre à jour le thème si changé dans un autre onglet
      const theme = localStorage.getItem('theme');
      document.documentElement.setAttribute('data-theme', theme || 'light');
    }
  });
});

let CartData = null;
const CART_STORAGE = 'shopcart_cart';
const USER_STORAGE_KEY = 'user';

/**
 * Met à jour les boutons utilisateur selon l'état de connexion
 */
function updateUserButtons() {
  const accountButton = document.getElementById('accountButton');
  const loginButton = document.getElementById('loginButton');
  
  if (!accountButton || !loginButton) return;

  try {
    const user = localStorage.getItem(USER_STORAGE_KEY);
    
    if (user && user !== 'null' && user !== 'undefined') {
      // Utilisateur connecté
      accountButton.style.display = 'flex';
      loginButton.style.display = 'none';
      
      // Optionnel: Afficher le nom d'utilisateur
      try {
        const userData = JSON.parse(user);
        if (userData.username) {
          const accountText = accountButton.querySelector('span');
          if (accountText) {
            accountText.textContent = userData.username;
          }
        }
      } catch (e) {
        console.log('Données utilisateur non JSON');
      }
    } else {
      // Utilisateur non connecté
      accountButton.style.display = 'none';
      loginButton.style.display = 'flex';
    }
  } catch (error) {
    console.error('Erreur lors de la mise à jour des boutons utilisateur:', error);
    // Par défaut, afficher le bouton de connexion
    accountButton.style.display = 'none';
    loginButton.style.display = 'flex';
  }
}

/**
 * Met à jour le badge du panier dans le header
 */
function updateCartBadge() {
  // Charger les données du panier pour compter le nombre d'éléments
  loadCartData();
  
  const cartBadge = document.querySelector('.cart-count');
  
  if (!cartBadge) {
    console.warn('⚠️ Badge du panier introuvable');
    return;
  }
  
  if (!CartData || !CartData.cart_items || CartData.cart_items.length === 0) {
    cartBadge.textContent = '0';
    cartBadge.style.display = 'none'; // Cacher si vide
    return;
  }
  
  const totalItems = CartData.cart_items.reduce((sum, item) => sum + (item.quantite || 0), 0);
  cartBadge.textContent = totalItems > 99 ? '99+' : totalItems.toString();
  cartBadge.style.display = 'flex'; // Afficher s'il y a des articles
}

/**
 * Charge les données du panier depuis localStorage
 */
async function loadCartData() {
  try {
    const savedCart = localStorage.getItem(CART_STORAGE);
    
    if (savedCart) {
      CartData = JSON.parse(savedCart);
    } else {
      CartData = { cart_items: [] };
    }
  } catch (error) {
    console.error('❌ Erreur lors du chargement du panier:', error);
    CartData = { cart_items: [] };
  }
}

/**
 * Affiche un message d'erreur (peut être étendu pour afficher des notifications)
 */
function showError(message) {
  console.error(message);
  // Optionnel: Afficher une notification à l'utilisateur
  // showNotification(message, 'error');
}

// Dark Mode functionality
function initDarkMode() {
  const darkModeToggle = document.getElementById('darkModeToggle');
  const darkModeText = document.querySelector('.dark-mode-text');
  
  // Vérifier la préférence sauvegardée ou le mode système
  const savedTheme = localStorage.getItem('theme');
  const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
  
  // Appliquer le thème initial
  if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
    applyDarkMode(true, darkModeText);
  } else {
    applyDarkMode(false, darkModeText);
  }
  
  // Gérer le clic sur le bouton
  if (darkModeToggle) {
    darkModeToggle.addEventListener('click', toggleDarkMode);
  }
  
  // Écouter les changements de préférence système
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
      applyDarkMode(e.matches, darkModeText);
    }
  });
}

function toggleDarkMode() {
  const currentTheme = document.documentElement.getAttribute('data-theme');
  const darkModeText = document.querySelector('.dark-mode-text');
  
  if (currentTheme === 'light') {
    applyDarkMode(true, darkModeText);
  } else {
    applyDarkMode(false, darkModeText);
  }
}

function applyDarkMode(isDark, darkModeText) {
  if (isDark) {
    document.documentElement.setAttribute('data-theme', 'dark');
    localStorage.setItem('theme', 'dark');
    if (darkModeText) darkModeText.textContent = 'Mode clair';
  } else {
    document.documentElement.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
    if (darkModeText) darkModeText.textContent = 'Mode sombre';
  }
}

// Exposer les fonctions globalement pour un accès facile
window.updateCartBadge = updateCartBadge;
window.updateUserButtons = updateUserButtons;