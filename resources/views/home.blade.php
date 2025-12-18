
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopcart - Landing Page</title>
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
<script src="{{ asset('assets/js/header.js') }}"></script>
  <script src="{{ asset('assets/js/api-service.js') }}" defer></script>
  <script src="{{ asset('assets/js/logout.js') }}" defer></script>
<script defer src="{{ asset('assets/js/newsletter.js') }}"></script>


  <!-- Utilisation de Font Awesome pour les icônes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!--  les icônes de paiement -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
@extends('layouts.app')

@section('title', 'LandingPage- Shopecart')

@section('content')
  <!-- Contenu principal de la landing page -->
  <main>
    <section class="hero">
      <div class="hero-content">
        <h1>L'Excellence en Électronique pour Tous</h1>
        <p class="hero-subtitle">Découvrez des appareils de qualité supérieure, des prix imbattables et une livraison
          rapide à travers le Cameroun et au-delà.</p>
        <div class="search-bar">
          <input type="text" placeholder=" Rechercher des produits électroniques" class="search-input">
        </div>
        <a href="#explore" class="hero-cta">Explorer Maintenant</a>
      </div>
    </section>

    <section class="features">
      <div class="feature-item">
        <i class="fas fa-network-wired"></i>
        <span>Réseau Étendu de Fournisseurs</span>
        <p>Connectez-vous avec des centaines de fournisseurs vérifiés pour les derniers appareils électroniques.</p>
      </div>
      <div class="feature-item">
        <i class="fas fa-lock"></i>
        <span>Sécurité Garantie pour les Clients</span>
        <p>Transactions sécurisées avec notre système de paiement crypté et protection des données.</p>
      </div>
      <div class="feature-item">
        <i class="fas fa-star"></i>
        <span>Meilleur E-commerce au Cameroun</span>
        <p>Reconnu par des milliers de clients pour la qualité et le service depuis 2020.</p>
      </div>
    </section>

    <section class="spotlight">
      <h2>À la Une</h2>
      <div class="spotlight-content">
        <div class="spotlight-item">
          <h3>Classement</h3>
          <img src="/assets/images/classement.png" alt="classement ">

          <p>Leader du marché avec un taux de satisfaction client de 85%.</p>
          <div class="progress-bar"></div>
        </div>

        <div class="spotlight-item">
          <h3>Nouveautés</h3>
          <div class="new-arrivals">
            <div class="product-card">
              <div class="product-image">
                <img
                  src="https://tse1.mm.bing.net/th/id/OIP.bdIFNBImZMRAE-X1cCDiPAAAAA?cb=12&rs=1&pid=ImgDetMain&o=7&rm=3"
                  alt="iPhone 15 Pro">
              </div>
              <div class="product-info">
                <span class="product-badge">Nouveau</span>
                <h4>iPhone 15 Pro</h4>
                <p class="product-price">849 000 FCFA</p>
              </div>
            </div>

            <div class="product-card">
              <div class="product-image">
                <img src="/assets/images/desktopjeuenligne.jpg" alt="Produits Populaires">
              </div>
              <div class="product-info">
                <span class="product-badge">Populaire</span>
                <h4>Produits Populaires</h4>
                <p class="product-price">Voir plus</p>
              </div>
            </div>
          </div>
        </div>

        <div class="spotlight-item">
          <h3>Meilleures Offres</h3>
          <div class="deal-images">
            <div class="deal-item">-30%</div>
            <div class="deal-item">-25%</div>
            <div class="deal-item">-20%</div>
          </div>
          <p>Économisez jusqu'à 30% sur les articles sélectionnés cette semaine !</p>
        </div>
      </div>

      <p class="explore-text">Explorez des millions d'offres adaptées à vos besoins</p>
      <div class="stats">
        <span>2k+ produits</span>
        <span>20+ pays</span>
        <span>50 catégories</span>
      </div>
    </section>

    <section class="explore" id="explore">
      <h2>Prêt à Acheter ?</h2>
      <p>Découvrez les meilleures offres et produits conçus pour vous dès aujourd'hui !</p>
      <a href="{{ route('catalogue') }}" class="hero-cta">Acheter Maintenant</a>
      <div class="testimonials">
        <p>"Service incroyable et livraison rapide ! Je recommande vivement !" - Jean D.</p>
        <p>"Meilleur magasin d'électronique au Cameroun, des prix excellents !" - Sarah K.</p>
      </div>
    </section>

    <section class="payment-method">
      <h3>Méthodes de Paiement Acceptées</h3>
      <div class="payment-icons">
        <div class="payment-icon">
          <i class="fab fa-cc-visa"></i>
        </div>
        <div class="payment-icon">
          <i class="fab fa-cc-mastercard"></i>
        </div>
        <div class="payment-icon">
          <i class="fab fa-cc-paypal"></i>
        </div>
        <div class="payment-icon">
          <i class="fab fa-cc-apple-pay"></i>
        </div>
        <div class="payment-icon">
          <i class="fas fa-mobile-alt"></i>
        </div>
      </div>
    </section>
  </main>
<script src="{{ asset('assets/js/advertisement.js') }}"></script>
</body>


@endsection