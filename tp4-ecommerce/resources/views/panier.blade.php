
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel='stylesheet' href="{{ asset('assets/css/footer.css') }}">
    <link rel='stylesheet' href="{{ asset('assets/css/header.css') }}">
    <link rel='stylesheet' href="{{ asset('assets/css/panier.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <title>Mon Panier - Shopcart</title>
  
</head>
@extends('layouts.app')

@section('title', 'Panier- Shopecart')

@section('content')
<body>

  <main class='cart-container'>
    
    <div class="cart-header">
      <h1 class='cart-title'>
        <i class="fas fa-shopping-cart"></i> 
        Mon Panier
      </h1>
      <p class="cart-item-count">
        <span id="total-items"></span> article(s) dans votre panier
      </p>
    </div>

    <div id="loading-indicator" class="loading-indicator">
      <i class="fas fa-spinner fa-spin"></i>
      <p>Chargement de votre panier...</p>
    </div>

    <div id="empty-cart-message" class="empty-cart-message" style="display: none;">
      <i class="fas fa-shopping-cart"></i>
      <h2>Votre panier est vide</h2>
      <p>Découvrez nos produits et ajoutez-en à votre panier !</p>
      <a href="{{ route('casque') }}" class="btn-continue-shopping">
        <i class="fas fa-arrow-left"></i>
        Continuer mes achats
      </a>
    </div>

   <div id="cart-content-wrapper" class="cart-content" style="display: none;">

    <div class="cart-main-column">
        <div class="cart-actions-top">
            <button class="btn-clear-cart" id="clear-cart-button">
                <i class="fas fa-trash-alt"></i> Vider le panier
            </button>
        </div>
        
        <div class="cart-items" id="cart-items-container">
            </div>
    </div>

    <aside class="order-summary">
        <h2 class="summary-title">
            <i class="fas fa-receipt"></i> Résumé de la commande
        </h2>

        <div class="summary-box">
            <div class="summary-row">
                <span class="summary-label"><i class="fas fa-shopping-bag"></i> Sous-total:</span>
                <span class="summary-value" id="subtotal-value">0 F CFA</span>
            </div>
            
            <div class="summary-row">
                <span class="summary-label"><i class="fas fa-tag"></i> Réduction:</span>
                <span class="summary-value discount-value" id="discount-value">0 F CFA</span>
            </div>

            <div class="summary-row">
                <span class="summary-label"><i class="fas fa-truck"></i> Livraison:</span>
                <span class="summary-value" id="shipping-value">Gratuite</span>
            </div>
            
            <div class="summary-row summary-total">
                <span class="summary-label"><i class="fas fa-calculator"></i> Total:</span>
                <span class="summary-value" id="total-value">0 F CFA</span>
            </div>
        </div>

        <button class="checkout-btn" id="checkout-button">
            <i class="fas fa-lock"></i> Procéder au paiement
        </button>

        <a href="{{ route('casque') }}" class="continue-shopping-link">
          <i class="fas fa-arrow-left"></i>
          Continuer mes achats
        </a>

        <div class="security-badges">
            <div class="badge"><i class="fas fa-shield-alt"></i> <span>Paiement sécurisé</span></div>
            <div class="badge"><i class="fas fa-undo"></i> <span>Retours gratuits</span></div>
        </div>
    </aside>

</div>

    </div>
  </main>


</body>
@endsection