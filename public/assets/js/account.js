document.addEventListener('DOMContentLoaded', () => {
  // =================================================================
    // NOUVELLE LOGIQUE : GESTION DE L'AFFICHAGE/MASQUAGE DU MOT DE PASSE
    // =================================================================
    const passwordInputs = document.querySelectorAll('input[type="password"]');

    passwordInputs.forEach(passwordInput => {
        // 1. Créer le wrapper <div> autour du champ pour positionner l'icône
        const wrapper = document.createElement('div');
        wrapper.classList.add('password-wrapper'); // Assurez-vous d'avoir le CSS pour cette classe
        
        // Insérer le wrapper à la place du champ de mot de passe
        passwordInput.parentNode.insertBefore(wrapper, passwordInput);
        wrapper.appendChild(passwordInput);

        // 2. Créer l'icône "œil" (Font Awesome est requis dans votre HTML)
        const toggleIcon = document.createElement('i');
        // 'fas fa-eye' est l'icône par défaut (mot de passe masqué)
        toggleIcon.classList.add('fas', 'fa-eye', 'password-toggle-icon'); 
        
        wrapper.appendChild(toggleIcon);

        // 3. Ajouter l'écouteur d'événement au clic sur l'icône
        toggleIcon.addEventListener('click', () => {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            
            // Basculer l'attribut 'type' entre 'text' et 'password'
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            
            // Basculer l'icône entre l'œil ouvert et l'œil barré
            toggleIcon.classList.toggle('fa-eye-slash');
        });
    });
  // 1. Récupération des données utilisateur stockées
  const storedUser = localStorage.getItem('user');

  if (storedUser) {
      const userData = JSON.parse(storedUser);
      
      // Supposons que 'name' stocké est le Prénom (First Name) et que nous n'avons pas de Nom (Last Name) dans le LocalStorage de l'inscription
      const userName = userData.name || 'Client'; // Utilise 'Client' si le nom est manquant
      const userEmail = userData.email;
      const userPassword = userData.password;

      // --- A. Mise à jour de la BARRE LATÉRALE (Sidebar) ---
      
      const profileAvatar = document.querySelector('.profile .avatar');
      const profileName = document.querySelector('.profile .name');
      const profileEmail = document.querySelector('.profile .email');
      
      if (profileAvatar) {
          // Afficher les initiales dans l'avatar
          const initials = userName.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
          profileAvatar.textContent = initials;
      }

      if (profileName) {
          profileName.textContent = userName;
      }

      if (profileEmail) {
          profileEmail.textContent = userEmail;
      }


      // --- B. Remplissage des CHAMPS de formulaire (Section Profil) ---
      // Le nom (name) stocké dans votre login.js est utilisé pour le prénom ici
      const firstNameInput = document.getElementById('firstName');
      const emailInput = document.getElementById('email');
      
      // Note: Les champs 'lastName', 'phone', 'address' ne sont pas stockés lors de l'inscription/connexion initiale.
      
      if (firstNameInput) {
          firstNameInput.value = userName.split(' ')[0] || ''; // Prend le premier mot comme prénom
      }

      if (emailInput) {
          emailInput.value = userEmail;
      }
      // --- B.1 NOUVEAU : Affichage du mot de passe actuel dans le champ ---
      const oldPasswordInput = document.getElementById('oldPassword');

      if (oldPasswordInput && userPassword) {
          // Cette ligne injecte le mot de passe stocké directement dans le champ.
          oldPasswordInput.value = userPassword;
          
          // Le champ étant de type 'password' dans votre HTML, il sera masqué 
          // par défaut et pourra être révélé par votre autre script "toggle".
      }

      // --- C. Affichage de la date de DÉBUT de l'adhésion (Optionnel) ---
      // Si vous aviez stocké la date d'inscription dans le localStorage, vous pourriez l'afficher ici.
      // Exemple (si vous aviez une clé 'memberSince'):
      /*
      const memberSince = localStorage.getItem('memberSince'); 
      const memberSinceDisplay = document.querySelector('.sidebar > div:last-child > div:last-child');
      if (memberSinceDisplay && memberSince) {
           memberSinceDisplay.textContent = new Date(memberSince).toLocaleDateString('fr-FR');
      }
      */
     // --- 2. GESTION DE LA MISE À JOUR DU PROFIL (Bouton "Save") ---
     const saveProfileBtn = document.getElementById('saveProfileBtn');
     const lastNameInput = document.getElementById('lastName');
     // Récupérer les autres champs pour une éventuelle sauvegarde (même s'ils ne sont pas dans le LS initial)
     const phoneInput = document.getElementById('phone');
     const addressInput = document.getElementById('address');


     if (saveProfileBtn) {
         saveProfileBtn.addEventListener('click', () => {
             // 1. Collecter les nouvelles valeurs
             const newFirstName = firstNameInput.value.trim();
             const newEmail = emailInput.value.trim();
             
             // Optionnel: Collecter les autres champs pour enrichir l'objet utilisateur
             const newLastName = lastNameInput ? lastNameInput.value.trim() : '';
             const newPhone = phoneInput ? phoneInput.value.trim() : '';
             const newAddress = addressInput ? addressInput.value.trim() : '';
             
             // Reconstruire le nom complet si le nom de famille existe
             const newFullName = newLastName ? `${newFirstName} ${newLastName}` : newFirstName;

             // 2. Mettre à jour l'objet utilisateur
             userData.name = newFullName;
             userData.email = newEmail;
             
             // Mise à jour optionnelle des autres champs dans l'objet
             userData.lastName = newLastName;
             userData.phone = newPhone;
             userData.address = newAddress;

             // 3. Sauvegarder dans le Local Storage
             localStorage.setItem('user', JSON.stringify(userData));

             // 4. Mettre à jour l'affichage de la sidebar immédiatement
             if (profileName) { profileName.textContent = newFullName; }
             if (profileEmail) { profileEmail.textContent = newEmail; }
             if (profileAvatar) {
                 const initials = newFullName.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
                 profileAvatar.textContent = initials;
             }

             alert('Vos informations de profil ont été mises à jour avec succès.');
         });
     }


     // --- 3. GESTION DE LA MISE À JOUR DU MOT DE PASSE (Bouton "Update password") ---
     const updatePasswordBtn = document.getElementById('updatePasswordBtn');
     const newPasswordInput = document.getElementById('newPassword');
     const confirmPasswordInput = document.getElementById('confirmPassword');

     if (updatePasswordBtn) {
         updatePasswordBtn.addEventListener('click', () => {
             const oldPasswordValue = oldPasswordInput.value;
             const newPasswordValue = newPasswordInput.value;
             const confirmPasswordValue = confirmPasswordInput.value;

             // 1. Vérification du mot de passe actuel (doit correspondre au mot de passe stocké)
             if (oldPasswordValue !== userData.password) {
                 alert('Erreur: Le "Mot de passe actuel" est incorrect.');
                 return;
             }

             // 2. Vérification de la correspondance des nouveaux mots de passe
             if (newPasswordValue !== confirmPasswordValue) {
                 alert('Erreur: Le "Nouveau mot de passe" et la "Confirmation" ne correspondent pas.');
                 return;
             }
             
             // 3. Vérification que le nouveau mot de passe n'est pas vide
             if (!newPasswordValue.trim()) {
                 alert('Erreur: Le nouveau mot de passe ne peut pas être vide.');
                 return;
             }

             // 4. Mise à jour de l'objet utilisateur
             userData.password = newPasswordValue;

             // 5. Sauvegarder dans le Local Storage
             localStorage.setItem('user', JSON.stringify(userData));

             // 6. Nettoyage des champs et message de succès
             oldPasswordInput.value = newPasswordValue; // Met à jour le champ actuel avec la nouvelle valeur
             newPasswordInput.value = '';
             confirmPasswordInput.value = '';

             alert('Votre mot de passe a été mis à jour avec succès.');
         });
     }

  } else {
      // --- D. Gestion de la déconnexion ---
      // Si aucune donnée n'est trouvée (l'utilisateur n'est pas connecté), on peut le rediriger
      console.warn("Utilisateur non trouvé dans le LocalStorage. Redirection vers la page de connexion...");
      window.location.href = '/login.html'; // Décommenter pour forcer la connexion
  }
});