<header>
    <!-- Checkbox cachée pour contrôler le menu mobile -->
    <nav class="navbar">
      <div class="logo">
        <div class="logo-img">
          <a href="{{ route('home')  }}">
            <img src="/assets/images/shopcart-logo.png" alt="Shopcart Logo" class="logo-img">
          </a>
        </div>
        <span class="logo-text">Shopcart</span>
      </div>
      <!-- Hamburger icon comme label pour la checkbox -->
      <label for="menu-toggle" class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </label>

      <ul class="nav-links" id="navLinks">
        <li class="categories-dropdown">
          <!-- Label pour le sous-menu des catégories -->
          <label for="categories-toggle" class="categories-label" id="categoriesLabel">
            Catégories <span class="dropdown-arrow">▼</span>
          </label>
          <div class="dropdown-content" id="dropdownContent">
            <a href="{{ route('ordi') }}"><i class="fas fa-laptop"></i> Ordinateurs portables</a>
            <a href="{{ route('tel') }}"><i class="fas fa-mobile-alt"></i> Téléphones</a>
            <a href="{{ route('casque') }}"><i class="fas fa-headphones"></i> Casques & Écouteurs</a>
            <a href="#"><i class="fas fa-tablet-alt"></i> Tablettes</a>
            <a href="{{ route('ordi') }}"><i class="fas fa-desktop"></i> Ordinateurs de bureau</a>
            <a href="{{ route('disk') }}"><i class="fas fa-keyboard"></i> Périphériques</a>
            <a href="#"><i class="fas fa-microchip"></i> Composants PC</a>
            <a href="#"><i class="fas fa-print"></i> Imprimantes</a>
            <a href="{{ route('manettes') }}"><i class="fas fa-gamepad"></i> Gaming</a>
            <a href="{{ route('cam')  }}"><i class="fas fa-tv"></i> Caméras</a>
          </div>
        </li>
        <li><a href="">Promotions</a></li>
        <li><a href="{{ route('about') }}">À propos</a></li>
        <li><a href="{{ route('blog') }}">Blog</a></li>
      </ul>

      <div class="search-bar" id="searchBar">
        <input type="text" placeholder="Rechercher un produit..." class="search-input">
      </div>

      <div class="user-actions" id="userActions">
        <!-- Bouton conditionnel Mon compte / Se connecter -->
        <a href="{{ route('account') }}" class="account-icon" id="accountButton" style="display: none;">
          <i class="fa-regular fa-user"></i> <span>Mon Compte</span>
        </a>
        <a href="{{ route('login') }}" class="account-icon" id="loginButton" style="display: none;">
          <i class="fa-regular fa-user"></i> <span>Se connecter</span>
        </a>

        <a href="{{ route('panier') }}" class="cart-icon">
          <i class="fas fa-shopping-cart"></i> <span>Panier</span>
          <span class="cart-count"></span>
        </a>

        <!-- Dark Mode Toggle amélioré -->
        <button class="dark-mode-toggle" id="darkModeToggle" aria-label="Basculer le mode sombre">
          <i class="fas fa-moon"></i>
          <i class="fas fa-sun"></i>
          <span class="dark-mode-text">Mode sombre</span>
        </button>
      </div>
      </div>
    </nav>

    <!-- Overlay pour fermer le menu (utilise l'ancre) -->
    <a href="#" class="overlay" id="overlay"></a>
  </header>
  <!-- <header>
    <div class="logo">Shopecart</div>
    <nav>
        <a href="/">Accueil</a>
        <a href="/products">Produits</a>
        <a href="/cart">Panier (<span id="cart-count">0</span>)</a>

        @auth
            <span>Bonjour, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        @else
            <a href="{{ route('login') }}">Connexion</a>
            <a href="{{ route('register') }}">Inscription</a>
        @endauth
    </nav>
</header> -->