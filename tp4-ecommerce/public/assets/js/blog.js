document.addEventListener("DOMContentLoaded", () => {
  console.log("✅ blog.js chargé - fonctionnalités du blog activées");

  // Fonctions utilitaires
  const qs = (sel, root = document) => root.querySelector(sel);
  const qsa = (sel, root = document) => Array.from(root.querySelectorAll(sel));
  const storage = window.localStorage;

  // État des likes - BLOG SEULEMENT
  const BlogState = {
    likes: JSON.parse(storage.getItem('blogLikes')) || {}
  };

  /* 
     SYSTÈME DE LIKES - EXCLUSIVEMENT POUR LE BLOG
     --------------------------- */
  function initLikeSystem() {
    const likeButtons = qsa('.card .like-btn');
    
    console.log(`🎯 ${likeButtons.length} boutons like sur le blog`);
    
    likeButtons.forEach(btn => {
      const articleId = btn.dataset.articleId;
      
      // Initialiser l'état du bouton
      if (articleId && BlogState.likes[articleId]) {
        btn.classList.add('liked');
        updateLikeCount(btn, BlogState.likes[articleId]);
      }
      
      // Gérer le clic
      btn.addEventListener('click', (e) => {
        e.stopPropagation();
        e.preventDefault();
        handleBlogLike(btn, articleId);
      });
    });
  }

  function handleBlogLike(button, articleId) {
    if (!articleId) {
      console.error('❌ ID article manquant');
      return;
    }

    if (!BlogState.likes[articleId]) {
      // Ajouter like
      BlogState.likes[articleId] = 1;
      button.classList.add('liked');
      updateLikeCount(button, 1);
      showToast('❤️ Article liké !');
      
      // Confettis pour le like
      createLikeConfetti(button);
      
      // Animation de pulse sur le bouton
      animateLikeButton(button);
    } else {
      // Retirer like
      delete BlogState.likes[articleId];
      button.classList.remove('liked');
      updateLikeCount(button, 0);
      showToast('💔 Like retiré');
    }
    
    // Sauvegarder les likes du blog
    storage.setItem('blogLikes', JSON.stringify(BlogState.likes));
  }

  function updateLikeCount(button, count) {
    let countElement = button.querySelector('.like-count');
    if (!countElement) {
      countElement = document.createElement('span');
      countElement.className = 'like-count';
      button.appendChild(countElement);
    }
    countElement.textContent = count > 0 ? count : '';
  }

  /* 
     CONFETTIS POUR LES LIKES
     --------------------------- */
  function createLikeConfetti(button) {
    const buttonRect = button.getBoundingClientRect();
    const colors = [
      '#ff6b6b', '#ff9ff3', '#f368e0', '#ff9f43', '#feca57',
      '#48dbfb', '#54a0ff', '#5f27cd', '#00d2d3', '#1dd1a1'
    ];
    
    const confettiContainer = document.createElement('div');
    confettiContainer.className = 'like-confetti-container';
    Object.assign(confettiContainer.style, {
      position: 'fixed',
      top: '0',
      left: '0',
      width: '100%',
      height: '100%',
      pointerEvents: 'none',
      zIndex: '9998'
    });
    
    document.body.appendChild(confettiContainer);
    
    // Créer plusieurs types de confettis
    for (let i = 0; i < 25; i++) {
      createHeartConfetti(confettiContainer, buttonRect, colors);
    }
    
    for (let i = 0; i < 15; i++) {
      createStarConfetti(confettiContainer, buttonRect, colors);
    }
    
    for (let i = 0; i < 10; i++) {
      createCircleConfetti(confettiContainer, buttonRect, colors);
    }
    
    // Nettoyer après l'animation
    setTimeout(() => {
      confettiContainer.remove();
    }, 3000);
  }

  function createHeartConfetti(container, buttonRect, colors) {
    const confetti = document.createElement('div');
    const color = colors[Math.floor(Math.random() * colors.length)];
    
    confetti.innerHTML = '❤️';
    Object.assign(confetti.style, {
      position: 'absolute',
      fontSize: Math.random() * 16 + 12 + 'px',
      top: (buttonRect.top + buttonRect.height / 2) + 'px',
      left: (buttonRect.left + buttonRect.width / 2) + 'px',
      opacity: '0.9',
      pointerEvents: 'none',
      userSelect: 'none',
      zIndex: '9999'
    });
    
    container.appendChild(confetti);
    
    // Animation aléatoire
    const angle = Math.random() * Math.PI * 2;
    const velocity = 50 + Math.random() * 100;
    const rotation = Math.random() * 720 - 360;
    
    const animation = confetti.animate([
      { 
        transform: 'translate(0, 0) rotate(0deg) scale(1)',
        opacity: 1 
      },
      { 
        transform: `translate(${Math.cos(angle) * velocity}px, ${Math.sin(angle) * velocity - 100}px) rotate(${rotation}deg) scale(0.5)`,
        opacity: 0 
      }
    ], {
      duration: 1000 + Math.random() * 1000,
      easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
    });
    
    animation.onfinish = () => confetti.remove();
  }

  function createStarConfetti(container, buttonRect, colors) {
    const confetti = document.createElement('div');
    const color = colors[Math.floor(Math.random() * colors.length)];
    
    confetti.innerHTML = '⭐';
    Object.assign(confetti.style, {
      position: 'absolute',
      fontSize: Math.random() * 14 + 10 + 'px',
      top: (buttonRect.top + buttonRect.height / 2) + 'px',
      left: (buttonRect.left + buttonRect.width / 2) + 'px',
      opacity: '0.9',
      pointerEvents: 'none',
      userSelect: 'none',
      zIndex: '9999'
    });
    
    container.appendChild(confetti);
    
    const angle = Math.random() * Math.PI * 2;
    const velocity = 40 + Math.random() * 80;
    const rotation = Math.random() * 360 - 180;
    
    const animation = confetti.animate([
      { 
        transform: 'translate(0, 0) rotate(0deg) scale(1)',
        opacity: 1 
      },
      { 
        transform: `translate(${Math.cos(angle) * velocity}px, ${Math.sin(angle) * velocity - 80}px) rotate(${rotation}deg) scale(0.4)`,
        opacity: 0 
      }
    ], {
      duration: 1200 + Math.random() * 800,
      easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
    });
    
    animation.onfinish = () => confetti.remove();
  }

  function createCircleConfetti(container, buttonRect, colors) {
    const confetti = document.createElement('div');
    const color = colors[Math.floor(Math.random() * colors.length)];
    
    Object.assign(confetti.style, {
      position: 'absolute',
      width: '8px',
      height: '8px',
      backgroundColor: color,
      borderRadius: '50%',
      top: (buttonRect.top + buttonRect.height / 2) + 'px',
      left: (buttonRect.left + buttonRect.width / 2) + 'px',
      opacity: '0.8',
      pointerEvents: 'none'
    });
    
    container.appendChild(confetti);
    
    const angle = Math.random() * Math.PI * 2;
    const velocity = 60 + Math.random() * 120;
    
    const animation = confetti.animate([
      { 
        transform: 'translate(0, 0) scale(1)',
        opacity: 1 
      },
      { 
        transform: `translate(${Math.cos(angle) * velocity}px, ${Math.sin(angle) * velocity - 120}px) scale(0.3)`,
        opacity: 0 
      }
    ], {
      duration: 1500 + Math.random() * 1000,
      easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
    });
    
    animation.onfinish = () => confetti.remove();
  }

  /* 
     ANIMATION DU BOUTON LIKE
     --------------------------- */
  function animateLikeButton(button) {
    // Animation de pulse
    button.animate([
      { transform: 'scale(1)' },
      { transform: 'scale(1.3)' },
      { transform: 'scale(1)' }
    ], {
      duration: 300,
      easing: 'cubic-bezier(0.4, 0, 0.2, 1)'
    });
    
    // Changement de couleur temporaire
    const originalBorder = button.style.borderColor;
    button.style.borderColor = '#ef4444';
    button.style.backgroundColor = '#fef2f2';
    
    setTimeout(() => {
      button.style.borderColor = originalBorder;
      button.style.backgroundColor = '';
    }, 500);
  }

  /* 
     INTERACTIONS DES CARTES
     --------------------------- */
  function initArticleCards() {
    const cards = qsa('.card');
    
    cards.forEach(card => {
      // Effet de survol
      card.addEventListener('mouseenter', () => {
        card.style.transform = 'translateY(-8px) scale(1.02)';
        card.style.boxShadow = '0 20px 40px rgba(0,0,0,0.15)';
      });
      
      card.addEventListener('mouseleave', () => {
        card.style.transform = 'translateY(0) scale(1)';
        card.style.boxShadow = '';
      });
    });
  }

  /* 
     NOTIFICATIONS TOAST
     --------------------------- */
  function showToast(message, duree = 3000) {
    const existingToast = qs("#__toast__");
    if (existingToast) existingToast.remove();
    
    const t = document.createElement("div");
    t.id = "__toast__";
    t.innerHTML = message;
    Object.assign(t.style, {
      position: "fixed",
      right: "20px",
      bottom: "20px",
      background: "rgba(0,0,0,0.9)",
      color: "white",
      padding: "12px 20px",
      borderRadius: "12px",
      zIndex: 9999,
      fontSize: "14px",
      boxShadow: "0 8px 25px rgba(0,0,0,0.3)",
      transform: "translateY(100px)",
      opacity: "0",
      transition: "all 0.3s cubic-bezier(0.4, 0, 0.2, 1)"
    });
    
    document.body.appendChild(t);
    
    // Animation d'entrée
    setTimeout(() => {
      t.style.transform = "translateY(0)";
      t.style.opacity = "1";
    }, 10);
    
    // Animation de sortie
    setTimeout(() => {
      t.style.transform = "translateY(100px)";
      t.style.opacity = "0";
    }, duree - 300);
    
    // Suppression
    setTimeout(() => t.remove(), duree);
  }

  /* 
     INITIALISATION
     --------------------------- */
  function initBlog() {
    initLikeSystem();
    initArticleCards();
    
    console.log('🚀 Blog - Likes et confettis activés');
    console.log('💾 État actuel:', BlogState.likes);
  }

  // Démarrer
  initBlog();
});