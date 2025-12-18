
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link rel='stylesheet' href='{{ asset('assets/css/footer.css') }}'>
    <link rel='stylesheet' href='{{ asset('assets/css/header.css') }}'>
    <link rel='stylesheet' href='{{ asset('assets/css/orders-history.css') }}'>
    
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Historique des Commandes - Shopcart</title>
</head>
@extends('layouts.app')

@section('title', 'Historique- Shopecart')

@section('content')
<body>

  <!-- ========== MAIN CONTENT ========== -->
  <!-- Conteneur principal de la page d'historique -->
  <main class="orders-container">
    
    <!-- En-tête de la page avec titre et statistiques -->
    <div class="orders-header">
      <h1 class="orders-title">
        <i class="fas fa-history"></i>
        Historique de mes Commandes
      </h1>
      <!-- Compteur total de commandes -->
      <p class="orders-count">
        <span id="total-orders">0</span> commande(s) au total
      </p>
    </div>

    <!-- Indicateur de chargement (visible au début) -->
    <div id="loading-indicator" class="loading-indicator">
      <i class="fas fa-spinner fa-spin"></i>
      <p>Chargement de vos commandes...</p>
    </div>

    <!-- Message si aucune commande (caché par défaut) -->
    <div id="empty-orders-message" class="empty-orders-message" style="display: none;">
      <i class="fas fa-box-open"></i>
      <h2>Aucune commande pour le moment</h2>
      <p>Vous n'avez pas encore passé de commande.</p>
      <a href="/index.html" class="btn-start-shopping">
        <i class="fas fa-shopping-bag"></i>
        Commencer mes achats
      </a>
    </div>

    <!-- Filtres de statut (caché pendant le chargement) -->
    <div id="filters-section" class="filters-section" style="display: none;">
      <button class="filter-btn active" data-filter="all">
        <i class="fas fa-list"></i>
        Toutes (<span id="count-all">0</span>)
      </button>
      <button class="filter-btn" data-filter="en_cours">
        <i class="fas fa-clock"></i>
        En cours (<span id="count-en_cours">0</span>)
      </button>
      <button class="filter-btn" data-filter="recue">
        <i class="fas fa-check-circle"></i>
        Reçues (<span id="count-recue">0</span>)
      </button>
      <button class="filter-btn" data-filter="annulee">
        <i class="fas fa-times-circle"></i>
        Annulées (<span id="count-annulee">0</span>)
      </button>
    </div>

    <!-- Conteneur des cartes de commandes (rempli dynamiquement par JS) -->
    <div id="orders-list" class="orders-list" style="display: none;">
      <!-- Les commandes seront injectées ici par JavaScript -->
    </div>

  </main>


  <!-- Script JavaScript -->
  <script src="{{ asset('assets/js/orders-history.js') }}"></script>
  <script src="{{ asset('assets/js/header.js') }}"></script>
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
</body>
@endsection