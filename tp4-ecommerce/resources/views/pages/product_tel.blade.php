<!DOCTYPE html>
<html lang="fr">

@extends('layouts.app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> Telephones| Shopcart</title> 
    
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/products_casque.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    
    <!-- Scripts -->
    <script type="module" src="{{ asset('assets/js/universal-product-loader.js') }}" defer></script>

    
    <!-- Script d'initialisation -->
    
</head>


@section('title', 'Casques Audio - Shopcart')

@section('content')
<body>
    <!-- Hero Banner -->
    <section class="hero-banner">
        <input type="radio" name="slide" id="slide4clone">
        <input type="radio" name="slide" id="slide1" checked>
        <input type="radio" name="slide" id="slide2">
        <input type="radio" name="slide" id="slide3">
        <input type="radio" name="slide" id="slide4">
        <input type="radio" name="slide" id="slide1clone">
        <div class="carousel-container">
            <!--Les slides-->
            <div class="slides" id="slides">
                <!--Slide 4 Clone-->
                <div class="slide">
                    <label class="left-arrow" for="slide3"><strong>&#60</strong></label>
                    <div class="banner-content">
                        <h1>Are You Ready For<br>Our Products ?<br>Surely Not</h1>
                        <button class="btn-primary">Maybe Yes</button>
                    </div>
                    <div class="banner-image">
                        <img src="/assets/images/22.jpeg"
                            alt="">
                    </div>
                    <label class="right-arrow" for="slide1"><strong>&#62</strong></label>
                </div>
                <!--Slide 1-->
                <div class="slide">
                    <label class="left-arrow" for="slide4clone"><strong>&#60</strong></label>
                    <div class="banner-content">
                        <h1>Get Up to 50% Off<br>On Telephones<br>And Other Gadgets</h1>
                        <button class="btn-primary">Buy Now</button>
                    </div>
                    <div class="banner-image">
                        <img src="/assets/images/22.jpeg"
                            alt="">
                    </div>
                    <label class="right-arrow" for="slide2"><strong>&#62</strong></label>
                </div>
                <!--Slide 2-->
                <div class="slide">
                    <label class="left-arrow" for="slide1"><strong>&#60</strong></label>
                    <div class="banner-content">
                        <h1>New Collection Of<br>Smart Phones<br>Available Now</h1>
                        <button class="btn-primary">Shop Now</button>
                    </div>
                    <div class="banner-image">
                        <img src="/assets/images/22.jpeg"
                            alt="">
                    </div>
                    <label class="right-arrow" for="slide3"><strong>&#62</strong></label>
                </div>
                <!--Slide 3-->
                <div class="slide">
                    <label class="left-arrow" for="slide2"><strong>&#60</strong></label>
                    <div class="banner-content">
                        <h1>Latest Google Pixels<br>Up To 30% Off<br>Limited Time</h1>
                        <button class="btn-primary">Get Now</button>
                    </div>
                    <div class="banner-image">
                        <img src="/assets/images/22.jpeg"
                            alt="">
                    </div>
                    <label class="right-arrow" for="slide4"><strong>&#62</strong></label>
                </div>
                <!--Slide 4-->
                <div class="slide">
                    <label class="left-arrow" for="slide3"><strong>&#60</strong></label>
                    <div class="banner-content">
                        <h1>Are You Ready For<br>Our Products ?<br>Surely Not</h1>
                        <button class="btn-primary">Maybe Yes</button>
                    </div>
                    <div class="banner-image">
                        <img src="/assets/images/22.jpeg"
                            alt="">
                    </div>
                    <label class="right-arrow" for="slide1clone"><strong>&#62</strong></label>
                </div>
                <!--Slide 1 Clone-->
                <div class="slide">
                    <label class="left-arrow" for="slide4"><strong>&#60</strong></label>
                    <div class="banner-content">
                        <h1>Get Up to 50% Off<br>On Telephones<br>And Other Gadgets</h1>
                        <button class="btn-primary">Buy Now</button>
                    </div>
                    <div class="banner-image">
                        <img src="/assets/images/22.jpeg"
                            alt="">
                    </div>
                    <label class="right-arrow" for="slide2"><strong>&#62</strong></label>
                </div>
            </div>
        </div>
        <div class="banner-dots">
            <label for="slide1" class="dot"></label>
            <label for="slide2" class="dot"></label>
            <label for="slide3" class="dot"></label>
            <label for="slide4" class="dot"></label>
        </div>
    </section>

    <main class="main-content-container">
        <!-- Filtres -->
        <div class="tag-buttons-group">
            <div class="filter-button primary-filter">
                <i class="fas fa-sliders-h icon-margin-right"></i> Tous les filtres
            </div>
            
            <div class="filter-dropdown" tabindex="0">
                <input type="radio" name="filters" id="prix-toggle" hidden>
                <label for="prix-toggle" class="tag-button">
                    Prix <span class="dropdown-arrow">▼</span>
                </label>
                <div class="dropdown-content">
                    <a href="#" data-price="0-30000"><i class="fas fa-tag"></i> Moins de 30.000 FCFA</a>
                    <a href="#" data-price="30000-70000"><i class="fas fa-tag"></i> 30.000 - 70.000 FCFA</a>
                    <a href="#" data-price="70000-150000"><i class="fas fa-tag"></i> 70.000 - 150.000 FCFA</a>
                    <a href="#" data-price="150000+"><i class="fas fa-tag"></i> Plus de 150.000 FCFA</a>
                </div>
            </div>
            
            <div class="filter-dropdown" tabindex="0">
                <input type="radio" name="filters" id="marques-toggle" hidden>
                <label for="marques-toggle" class="tag-button">
                    Marques <span class="dropdown-arrow">▼</span>
                </label>
                <div class="dropdown-content">
                    <a href="#" data-brand="sony"><i class="fab fa-sony"></i> Sony</a>
                    <a href="#" data-brand="bose"><i class="fas fa-headphones"></i> Bose</a>
                    <a href="#" data-brand="sennheiser"><i class="fas fa-volume-up"></i> Sennheiser</a>
                    <a href="#" data-brand="jbl"><i class="fas fa-music"></i> JBL</a>
                </div>
            </div>
            
            <div class="filter-dropdown" tabindex="0">
                <input type="radio" name="filters" id="notes-toggle" hidden>
                <label for="notes-toggle" class="tag-button">
                    Notes <span class="dropdown-arrow">▼</span>
                </label>
                <div class="dropdown-content">
                    <a href="#" data-rating="5"><i class="fas fa-star"></i> 5 étoiles</a>
                    <a href="#" data-rating="4"><i class="fas fa-star"></i> 4 étoiles et plus</a>
                    <a href="#" data-rating="3"><i class="fas fa-star"></i> 3 étoiles et plus</a>
                </div>
            </div>
        </div>
        
        <!-- Section: Tous les produits -->
        <section class="products-section">
            <h2 class="section-title">
                <span class="gradient-blue-purple">Tous les Telephones</span>
            </h2>
            <p class="section-subtitle">Notre sélection complète</p>
            <div class="products-grid" id="grid-casques-all">
                <!-- Les produits seront chargés ici par JavaScript -->
            </div>
        </section>
        
        <!-- Pagination -->
        <div class="pagination" id="pagination-all">
            <button class="page-btn" disabled data-direction="prev" data-grid-id="grid-casques-all">
                <i class="fas fa-chevron-left"></i> Précédent
            </button>
            <button class="page-num-active" data-page="1" data-grid-id="grid-casques-all">1</button>
            <button class="page-btn" data-direction="next" data-grid-id="grid-casques-all">
                Suivant <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        
        <div class="progress-bar-row">
            <hr class="progress-bar-segment-1">
            <hr class="progress-bar-segment-2">
            <hr class="progress-bar-segment-3">
        </div>
        
        <!-- Section: Produits en vedette -->
        <section class="products-section">
            <h2 class="section-title">
                <span class="gradient-blue-purple">En Vedette</span>
            </h2>
            <p class="section-subtitle">Nos meilleures ventes</p>
            <div class="products-grid" id="grid-casques-featured">
                <!-- Les produits en vedette seront chargés ici -->
            </div>
        </section>
        
        <!-- Pagination vedette -->
        <div class="pagination" id="pagination-featured">
            <button class="page-btn" disabled data-direction="prev" data-grid-id="grid-casques-featured">
                <i class="fas fa-chevron-left"></i> Précédent
            </button>
            <button class="page-num-active" data-page="1" data-grid-id="grid-casques-featured">1</button>
            <button class="page-btn" data-direction="next" data-grid-id="grid-casques-featured">
                Suivant <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </main>
     <script>
    document.addEventListener('DOMContentLoaded', async function() {
        console.log('🚀 Initialisation de la page produits...');
        
        // Attendre que les services soient prêts
        await waitForService('apiService');
        await waitForService('productLoader');
        
        // Configuration des grilles
        const gridConfig = {
            all: '#grid-casques-all',
            featured: '#grid-casques-featured'
        };
        
        // Catégories à essayer
        const categoryNames = ['Téléphones portables'];
        
        let loaded = false;
        
        for (const categoryName of categoryNames) {
            if (loaded) break;
            
            try {
                console.log(`🔄 Tentative avec la catégorie: "${categoryName}"`);
                
                const category = await window.apiService.findCategoryByName(categoryName);
                
                if (category) {
                    console.log(`✅ Catégorie trouvée: "${category.name}" (ID: ${category.id})`);
                    
                    // Initialiser le chargeur de produits
                    await window.productLoader.init(category.name, gridConfig, {
                        productsPerPage: 8,
                        defaultImage: '/assets/images/ca6.png'
                    });
                    
                    loaded = true;
                    console.log(`✅ Chargement réussi avec "${category.name}"`);
                    break;
                }
                
            } catch (error) {
                console.warn(`⚠️ Erreur avec "${categoryName}":`, error.message);
                continue;
            }
        }
        
        if (!loaded) {
            console.error('❌ Aucune catégorie valide trouvée');
            showErrorMessage('grid-casques-all');
            showErrorMessage('grid-casques-featured');
        }
        
        // Initialiser les filtres
        initFilters();
    });

    // Fonction d'attente pour les services
    function waitForService(serviceName) {
        return new Promise(resolve => {
            const checkService = setInterval(() => {
                if (window[serviceName]) {
                    clearInterval(checkService);
                    resolve();
                }
            }, 100);
        });
    }

    // Fonction pour afficher les erreurs
    function showErrorMessage(gridId) {
        const grid = document.getElementById(gridId);
        if (!grid) return;
        
        grid.innerHTML = `
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px;">
                <i class="fas fa-exclamation-triangle fa-3x" style="color: #dc2626; margin-bottom: 20px;"></i>
                <h3 style="color: #374151; margin-bottom: 10px;">Erreur de chargement</h3>
                <p style="color: #6b7280; margin-bottom: 20px;">
                    Impossible de charger les produits. Veuillez réessayer plus tard.
                </p>
                <button onclick="location.reload()" 
                        style="background: #1e40af; color: white; border: none; 
                            padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                    <i class="fas fa-redo"></i> Réessayer
                </button>
            </div>
        `;
    }

    // Initialisation des filtres
    function initFilters() {
        console.log('🎛️ Initialisation des filtres...');
        
        const filterButtons = document.querySelectorAll('.dropdown-content a');
        filterButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('Filtre cliqué:', this.dataset);
                // Implémentez la logique de filtrage ici
            });
        });
    }

    document.addEventListener('click', function(e) {
    // Gérer les clics sur les liens de produit
    const productLink = e.target.closest('.product-title-link, .product-image-link');
    if (productLink && productLink.href) {
        e.preventDefault();
        window.location.href = productLink.href;
    }
});
    </script>
</body>
@endsection