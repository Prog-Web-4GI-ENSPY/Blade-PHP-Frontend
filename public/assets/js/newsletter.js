// Newsletter System - Modern & Performant
document.addEventListener("DOMContentLoaded", function() {
    const newsletterForm = document.getElementById('newsletter-form');
    const newsletterEmail = document.getElementById('newsletter-email');
    
    if (!newsletterForm) return;

    // États de la newsletter
    const NewsletterState = {
        subscribedEmails: JSON.parse(localStorage.getItem('newsletterSubscribed')) || [],
        isSubmitting: false
    };

    // Initialisation
    function initNewsletter() {
        setupEventListeners();
        prefillEmailIfExists();
        console.log('📧 Système newsletter initialisé');
    }

    // Configuration des écouteurs d'événements
    function setupEventListeners() {
        // Soumission du formulaire
        newsletterForm.addEventListener('submit', handleSubmit);
        
        // Focus/Blur pour les effets visuels
        newsletterEmail.addEventListener('focus', handleFocus);
        newsletterEmail.addEventListener('blur', handleBlur);
        
        // Input pour validation en temps réel
        newsletterEmail.addEventListener('input', debounce(validateEmail, 300));
        
        // Animation au chargement
        animateNewsletterEntrance();
    }

    // Gestion de la soumission
    async function handleSubmit(e) {
        e.preventDefault();
        
        if (NewsletterState.isSubmitting) return;
        
        const email = newsletterEmail.value.trim();
        
        if (!isValidEmail(email)) {
            showError('Veuillez entrer une adresse email valide');
            shakeAnimation(newsletterForm);
            return;
        }
        
        if (isAlreadySubscribed(email)) {
            showError('Cette adresse email est déjà inscrite');
            pulseAnimation(newsletterForm);
            return;
        }
        
        await submitNewsletter(email);
    }

    // Validation d'email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Vérification d'inscription existante
    function isAlreadySubscribed(email) {
        return NewsletterState.subscribedEmails.includes(email.toLowerCase());
    }

    // Soumission asynchrone
    async function submitNewsletter(email) {
        NewsletterState.isSubmitting = true;
        setFormState('loading');
        
        try {
            // Simulation d'appel API - Remplacez par votre endpoint réel
            const success = await mockApiCall(email);
            
            if (success) {
                NewsletterState.subscribedEmails.push(email.toLowerCase());
                localStorage.setItem('newsletterSubscribed', JSON.stringify(NewsletterState.subscribedEmails));
                
                setFormState('success');
                showSuccess();
                createConfetti();
                newsletterForm.reset();
                
                // Réinitialiser après succès
                setTimeout(() => setFormState('idle'), 3000);
            } else {
                throw new Error('Échec de l\'inscription');
            }
        } catch (error) {
            setFormState('error');
            showError('Erreur lors de l\'inscription. Veuillez réessayer.');
            console.error('Newsletter error:', error);
        } finally {
            NewsletterState.isSubmitting = false;
        }
    }

    // États visuels du formulaire
    function setFormState(state) {
        newsletterForm.className = 'newsletter-form';
        newsletterForm.classList.add(state);
        
        const button = newsletterForm.querySelector('button');
        const inputContainer = newsletterForm.querySelector('.input-container');
        
        switch(state) {
            case 'loading':
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Inscription...';
                inputContainer.style.opacity = '0.7';
                break;
                
            case 'success':
                button.innerHTML = '<i class="fas fa-check"></i> Inscrit !';
                inputContainer.style.opacity = '0.5';
                break;
                
            case 'error':
                button.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Erreur';
                setTimeout(() => {
                    button.innerHTML = 'S\'inscrire';
                }, 2000);
                break;
                
            default:
                button.innerHTML = 'S\'inscrire';
                inputContainer.style.opacity = '1';
        }
    }

    // Gestion du focus
    function handleFocus() {
        newsletterForm.classList.add('focused');
        newsletterForm.classList.remove('error');
        animateInputFocus();
    }

    function handleBlur() {
        newsletterForm.classList.remove('focused');
        validateEmail();
    }

    // Validation en temps réel
    function validateEmail() {
        const email = newsletterEmail.value.trim();
        
        if (email === '') {
            newsletterForm.classList.remove('valid', 'invalid');
            return;
        }
        
        if (isValidEmail(email)) {
            newsletterForm.classList.add('valid');
            newsletterForm.classList.remove('invalid');
        } else {
            newsletterForm.classList.add('invalid');
            newsletterForm.classList.remove('valid');
        }
    }

    // Pré-remplissage si email existe
    function prefillEmailIfExists() {
        // Ici vous pourriez récupérer l'email de l'utilisateur connecté
        const userEmail = localStorage.getItem('userEmail');
        if (userEmail) {
            newsletterEmail.value = userEmail;
            validateEmail();
        }
    }

    // Animations
    function animateNewsletterEntrance() {
        newsletterForm.style.opacity = '0';
        newsletterForm.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            newsletterForm.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            newsletterForm.style.opacity = '1';
            newsletterForm.style.transform = 'translateY(0)';
        }, 500);
    }

    function animateInputFocus() {
        const inputContainer = newsletterForm.querySelector('.input-container');
        inputContainer.style.transform = 'scale(1.02)';
        inputContainer.style.transition = 'transform 0.3s ease';
        
        setTimeout(() => {
            inputContainer.style.transform = 'scale(1)';
        }, 300);
    }

    function shakeAnimation(element) {
        element.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
            element.style.animation = '';
        }, 500);
    }

    function pulseAnimation(element) {
        element.style.animation = 'pulse 0.6s ease-in-out';
        setTimeout(() => {
            element.style.animation = '';
        }, 600);
    }

    // Confettis pour le succès
    function createConfetti() {
        const colors = ['#ff6b6b', '#4ecdc4', '#45b7d1', '#96ceb4', '#feca57', '#ff9ff3'];
        const confettiContainer = document.createElement('div');
        confettiContainer.className = 'confetti-container';
        Object.assign(confettiContainer.style, {
            position: 'fixed',
            top: '0',
            left: '0',
            width: '100%',
            height: '100%',
            pointerEvents: 'none',
            zIndex: '9999'
        });
        
        document.body.appendChild(confettiContainer);
        
        for (let i = 0; i < 50; i++) {
            createConfettiPiece(confettiContainer, colors);
        }
        
        setTimeout(() => {
            confettiContainer.remove();
        }, 3000);
    }

    function createConfettiPiece(container, colors) {
        const confetti = document.createElement('div');
        const color = colors[Math.floor(Math.random() * colors.length)];
        
        Object.assign(confetti.style, {
            position: 'absolute',
            width: '10px',
            height: '10px',
            backgroundColor: color,
            top: '-10px',
            left: Math.random() * 100 + 'vw',
            borderRadius: Math.random() > 0.5 ? '50%' : '0',
            opacity: '0.8'
        });
        
        container.appendChild(confetti);
        
        const animation = confetti.animate([
            { transform: 'translateY(0) rotate(0deg)', opacity: 1 },
            { transform: `translateY(${window.innerHeight}px) rotate(${Math.random() * 360}deg)`, opacity: 0 }
        ], {
            duration: 2000 + Math.random() * 1000,
            easing: 'cubic-bezier(0.1, 0.8, 0.2, 1)'
        });
        
        animation.onfinish = () => confetti.remove();
    }

    // Notifications toast modernes
    function showSuccess() {
        showToast('🎉 Félicitations ! Vous êtes inscrit à la newsletter', 'success');
    }

    function showError(message) {
        showToast(message, 'error');
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `newsletter-toast newsletter-toast--${type}`;
        
        const icons = {
            success: '✅',
            error: '❌',
            info: '💡'
        };
        
        toast.innerHTML = `
            <div class="newsletter-toast__content">
                <span class="newsletter-toast__icon">${icons[type] || icons.info}</span>
                <span class="newsletter-toast__message">${message}</span>
            </div>
        `;
        
        Object.assign(toast.style, {
            position: 'fixed',
            top: '20px',
            right: '20px',
            background: type === 'error' ? '#fee2e2' : type === 'success' ? '#d1fae5' : '#e0f2fe',
            color: type === 'error' ? '#dc2626' : type === 'success' ? '#065f46' : '#0369a1',
            padding: '16px 20px',
            borderRadius: '12px',
            boxShadow: '0 10px 25px rgba(0,0,0,0.15)',
            zIndex: '10000',
            transform: 'translateX(400px)',
            opacity: '0',
            transition: 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)',
            maxWidth: '400px',
            border: `1px solid ${type === 'error' ? '#fecaca' : type === 'success' ? '#a7f3d0' : '#bae6fd'}`
        });
        
        document.body.appendChild(toast);
        
        // Animation d'entrée
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
            toast.style.opacity = '1';
        }, 100);
        
        // Animation de sortie
        setTimeout(() => {
            toast.style.transform = 'translateX(400px)';
            toast.style.opacity = '0';
        }, 4000);
        
        // Suppression
        setTimeout(() => {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 4500);
    }

    // Utilitaires
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }

    // Simulation d'appel API 
    function mockApiCall(email) {
        return new Promise((resolve) => {
            setTimeout(() => {
                // Simulation de succès dans 95% des cas
                resolve(Math.random() > 0.05);
            }, 1500);
        });
    }

    // CSS dynamique pour les animations
    function injectNewsletterStyles() {
        const styles = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
            
            @keyframes pulse {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.05); }
            }
            
            .newsletter-form.focused .input-container {
                border-color: #3b82f6;
                box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
                transform: translateY(-1px);
            }
            
            .newsletter-form.loading button {
                background: #6b7280 !important;
                cursor: not-allowed;
            }
            
            .newsletter-form.success button {
                background: linear-gradient(135deg, #10b981, #34d399) !important;
            }
            
            .newsletter-form.error button {
                background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            }
            
            .newsletter-form.valid .input-container {
                border-color: #10b981;
            }
            
            .newsletter-form.invalid .input-container {
                border-color: #ef4444;
            }
            
            .newsletter-toast__content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .newsletter-toast__icon {
                font-size: 1.2em;
            }
            
            .newsletter-toast__message {
                font-weight: 500;
            }
        `;
        
        const styleSheet = document.createElement('style');
        styleSheet.textContent = styles;
        document.head.appendChild(styleSheet);
    }

    // Initialisation
    injectNewsletterStyles();
    initNewsletter();
});