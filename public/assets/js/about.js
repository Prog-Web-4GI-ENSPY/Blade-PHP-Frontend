// Contact Form System - Modern & Performant
document.addEventListener("DOMContentLoaded", function() {
    const contactForm = document.querySelector(".contact-form form");
    
    if (!contactForm) return;

    // États du formulaire de contact
    const ContactState = {
        isSubmitting: false
    };

    // Initialisation
    function initContactForm() {
        setupEventListeners();
        console.log('📧 Système de contact initialisé');
    }

    // Configuration des écouteurs d'événements
    function setupEventListeners() {
        // Soumission du formulaire
        contactForm.addEventListener('submit', handleSubmit);
        
        // Validation en temps réel pour tous les champs
        const inputs = contactForm.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('input', debounce(validateField, 300));
            input.addEventListener('blur', validateField);
        });
        
        // Animation au chargement
        animateFormEntrance();
    }

    // Gestion de la soumission
    async function handleSubmit(e) {
        e.preventDefault();
        
        if (ContactState.isSubmitting) return;
        
        // Validation de tous les champs
        if (!validateAllFields()) {
            showError('Veuillez corriger les erreurs dans le formulaire');
            shakeAnimation(contactForm);
            return;
        }
        
        await submitContactForm();
    }

    // Validation de tous les champs
    function validateAllFields() {
        let isValid = true;
        const fields = contactForm.querySelectorAll('input[required], textarea[required]');
        
        fields.forEach(field => {
            if (!validateField.call(field)) {
                isValid = false;
            }
        });
        
        return isValid;
    }

    // Validation d'un champ individuel
    function validateField() {
        const field = this;
        const value = field.value.trim();
        const isRequired = field.hasAttribute('required');
        
        // Réinitialiser les styles
        field.classList.remove('valid', 'invalid');
        
        // Validation basique pour les champs requis
        if (isRequired && !value) {
            field.classList.add('invalid');
            showFieldError(field, 'Ce champ est obligatoire');
            return false;
        }
        
        // Validation spécifique par type de champ
        let isValid = true;
        let errorMessage = '';
        
        switch(field.type) {
            case 'email':
                if (value && !isValidEmail(value)) {
                    isValid = false;
                    errorMessage = 'Adresse email invalide';
                }
                break;
            case 'text':
                if (field.placeholder.includes('Nom') && value.length < 2) {
                    isValid = false;
                    errorMessage = 'Le nom doit contenir au moins 2 caractères';
                }
                break;
        }
        
        // Validation du textarea
        if (field.tagName === 'TEXTAREA' && value.length < 10) {
            isValid = false;
            errorMessage = 'Le message doit contenir au moins 10 caractères';
        }
        
        if (!isValid) {
            field.classList.add('invalid');
            showFieldError(field, errorMessage);
            return false;
        }
        
        // Champ valide
        if (value) {
            field.classList.add('valid');
        }
        
        hideFieldError(field);
        return true;
    }

    // Validation d'email
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    // Affichage des erreurs de champ
    function showFieldError(field, message) {
        // Supprimer l'erreur existante
        hideFieldError(field);
        
        const errorElement = document.createElement('div');
        errorElement.className = 'field-error';
        errorElement.textContent = message;
        errorElement.style.cssText = `
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: block;
        `;
        
        field.parentNode.appendChild(errorElement);
    }

    function hideFieldError(field) {
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }

    // Soumission asynchrone du formulaire
    async function submitContactForm() {
        ContactState.isSubmitting = true;
        setFormState('loading');
        
        try {
            // Récupération des données du formulaire
            const formData = {
                name: contactForm.querySelector('input[placeholder="Votre Nom"]').value.trim(),
                email: contactForm.querySelector('input[placeholder="Votre Email"]').value.trim(),
                subject: contactForm.querySelector('input[placeholder="Sujet"]').value.trim(),
                message: contactForm.querySelector('textarea').value.trim()
            };
            
            // Simulation d'appel API - Remplacez par votre endpoint réel
            const success = await mockContactApiCall(formData);
            
            if (success) {
                setFormState('success');
                showSuccess(formData.name);
                createConfetti();
                
                // Réinitialiser après succès
                setTimeout(() => {
                    contactForm.reset();
                    resetFormStyles();
                    setFormState('idle');
                }, 3000);
            } else {
                throw new Error('Échec de l\'envoi du message');
            }
        } catch (error) {
            setFormState('error');
            showError('Erreur lors de l\'envoi du message. Veuillez réessayer.');
            console.error('Contact form error:', error);
        } finally {
            ContactState.isSubmitting = false;
        }
    }

    // États visuels du formulaire
    function setFormState(state) {
        contactForm.className = 'contact-form-form';
        contactForm.classList.add(state);
        
        const button = contactForm.querySelector('button[type="submit"]');
        
        switch(state) {
            case 'loading':
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';
                button.disabled = true;
                break;
                
            case 'success':
                button.innerHTML = '<i class="fas fa-check"></i> Message envoyé !';
                button.disabled = true;
                break;
                
            case 'error':
                button.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Erreur';
                button.disabled = false;
                setTimeout(() => {
                    button.innerHTML = 'Envoyer le Message';
                }, 2000);
                break;
                
            default:
                button.innerHTML = 'Envoyer le Message';
                button.disabled = false;
        }
    }

    // Réinitialisation des styles
    function resetFormStyles() {
        const fields = contactForm.querySelectorAll('input, textarea');
        fields.forEach(field => {
            field.classList.remove('valid', 'invalid');
            hideFieldError(field);
        });
    }

    // Animations
    function animateFormEntrance() {
        contactForm.style.opacity = '0';
        contactForm.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            contactForm.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            contactForm.style.opacity = '1';
            contactForm.style.transform = 'translateY(0)';
        }, 500);
    }

    function shakeAnimation(element) {
        element.style.animation = 'shake 0.5s ease-in-out';
        setTimeout(() => {
            element.style.animation = '';
        }, 500);
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
    function showSuccess(name) {
        showToast(`✅ Merci ${name} ! Votre message a été envoyé avec succès.`, 'success');
    }

    function showError(message) {
        showToast(message, 'error');
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `contact-toast contact-toast--${type}`;
        
        const icons = {
            success: '✅',
            error: '❌',
            info: '💡'
        };
        
        toast.innerHTML = `
            <div class="contact-toast__content">
                <span class="contact-toast__icon">${icons[type] || icons.info}</span>
                <span class="contact-toast__message">${message}</span>
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

    // Simulation d'appel API pour le contact
    function mockContactApiCall(formData) {
        return new Promise((resolve) => {
            setTimeout(() => {
                // Simulation de succès dans 95% des cas
                console.log('Données du formulaire:', formData);
                resolve(Math.random() > 0.05);
            }, 2000);
        });
    }

    // CSS dynamique pour les animations
    function injectContactStyles() {
        const styles = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
            
            .contact-form-form.loading button {
                background: #6b7280 !important;
                cursor: not-allowed;
            }
            
            .contact-form-form.success button {
                background: linear-gradient(135deg, #10b981, #34d399) !important;
            }
            
            .contact-form-form.error button {
                background: linear-gradient(135deg, #ef4444, #dc2626) !important;
            }
            
            input.valid, textarea.valid {
                border-color: #10b981 !important;
                box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.1) !important;
            }
            
            input.invalid, textarea.invalid {
                border-color: #ef4444 !important;
                box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.1) !important;
            }
            
            .contact-toast__content {
                display: flex;
                align-items: center;
                gap: 10px;
            }
            
            .contact-toast__icon {
                font-size: 1.2em;
            }
            
            .contact-toast__message {
                font-weight: 500;
            }
            
            .field-error {
                color: #dc2626;
                font-size: 0.875rem;
                margin-top: 0.25rem;
                display: block;
            }
        `;
        
        const styleSheet = document.createElement('style');
        styleSheet.textContent = styles;
        document.head.appendChild(styleSheet);
    }

    // Initialisation
    injectContactStyles();
    initContactForm();
});