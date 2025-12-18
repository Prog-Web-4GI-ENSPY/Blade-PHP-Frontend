
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart</title>
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">

     <!-- Utilisation de Font Awesome pour les icônes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
   <script src="{{ asset('assets/js/about.js') }}"> </script>
  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>

@extends('layouts.app')

@section('title', 'Blog - Shopecart')

@section('content')
   <!-- Contenu principal du Blog -->
  <main class="blog-container">
    <!-- Hero Section -->
    <section class="blog-hero">
      <div class="hero-overlay">
        <h1>Le Monde de l'Électronique</h1>
        <p>Découvrez nos guides, comparatifs et actualités pour choisir les meilleurs appareils électroniques</p>
      </div>
    </section>

    <!-- Section Intro -->
    <section class="blog-intro">
      <h2>Nos Derniers Articles</h2>
      <p>Restez informés sur les tendances tech, nos conseils d'experts et les meilleures offres du moment</p>
    </section>
    
    <!-- Grille des articles -->
    <section class="articles">
      <!-- Article 5 -->
    <article class="card">
      <img src="/assets/images/femmecasque.jpg" alt="Femme avec casque audio">
      <div class="card-content">
        <span class="card-category">Tech & Lifestyle</span>
        <h2><a href="{{ route('article5') }}">Avec nos amis électroniques</a></h2>
        <p>Les appareils électroniques sont devenus des acteurs incontournables...</p>
        <div class="card-meta">
          <span><i class="far fa-clock"></i> 5 min</span>
          <span><i class="far fa-calendar"></i> 2 Oct 2025</span>
          <button class="like-btn" data-article-id="5">
            <i class="far fa-heart"></i>
            <span class="like-count"></span>
          </button>
        </div>
        <a class="read-more" href="{{ route('article5') }}">Lire l'article</a>
      </div>
    </article>

    <!-- Article 3 -->
    <article class="card">
      <img src="/assets/images/laptopcamera.jpg" alt="Laptop et caméra">
      <div class="card-content">
        <span class="card-category">Photographie</span>
        <h2><a href="{{ route('article3') }}">Les créateurs de souvenirs</a></h2>
        <p>Afin de capturer les moments qui comptent...</p>
        <div class="card-meta">
          <span><i class="far fa-clock"></i> 7 min</span>
          <span><i class="far fa-calendar"></i> 28 Sep 2025</span>
          <button class="like-btn" data-article-id="3">
            <i class="far fa-heart"></i>
            <span class="like-count"></span>
          </button>
        </div>
        <a class="read-more" href="{{ route('article3') }}">Lire l'article</a>
      </div>
    </article>

    <!-- Article 4 -->
    <article class="card">
      <img src="/assets/images/bazar.jpg" alt="Appareils électroniques variés">
      <div class="card-content">
        <span class="card-category">Guide d'Achat</span>
        <h2><a href="{{ route('article4') }}">Comment choisir ses appareils indispensables ?</a></h2>
        <p>Les critères essentiels pour ne pas se tromper...</p>
        <div class="card-meta">
          <span><i class="far fa-clock"></i> 10 min</span>
          <span><i class="far fa-calendar"></i> 25 Sep 2025</span>
          <button class="like-btn" data-article-id="4">
            <i class="far fa-heart"></i>
            <span class="like-count"></span>
          </button>
        </div>
        <a class="read-more" href="{{ route('article4') }}">Lire l'article</a>
      </div>
    </article>

    <!-- Article 2 -->
    <article class="card">
      <img src="/assets/images/desktopjeuenligne.jpg" alt="Setup gaming">
      <div class="card-content">
        <span class="card-category">Gaming</span>
        <h2><a href="{{ route('article2') }}">Le divertissement sans limite</a></h2>
        <p>Les outils électroniques ne sont pas qu'à but professionnel...</p>
        <div class="card-meta">
          <span><i class="far fa-clock"></i> 6 min</span>
          <span><i class="far fa-calendar"></i> 20 Sep 2025</span>
          <button class="like-btn" data-article-id="2">
            <i class="far fa-heart"></i>
            <span class="like-count"></span>
          </button>
        </div>
        <a class="read-more" href="{{ route('article2') }}">Lire l'article</a>
      </div>
    </article>

    <!-- Article 1 -->
    <article class="card">
      <img src="/assets/images/fille.jpg" alt="Femme avec smartphone">
      <div class="card-content">
        <span class="card-category">Smartphones</span>
        <h2><a href="{{ route('article1') }}">Au sommet du monde des smartphones</a></h2>
        <p>Vous cherchez un smartphone performant ? Ne cherchez plus !...</p>
        <div class="card-meta">
          <span><i class="far fa-clock"></i> 8 min</span>
          <span><i class="far fa-calendar"></i> 15 Sep 2025</span>
          <button class="like-btn" data-article-id="1">
            <i class="far fa-heart"></i>
            <span class="like-count"></span>
          </button>
        </div>
         <a class="read-more" href="{{ route('article1') }}">Lire l'article</a>
      </div>
    </article>

    <!-- Article 6 -->
    <article class="card">
      <img src="/assets/images/casqueetmanette.jpg" alt="Casque et manette de jeu">
      <div class="card-content">
        <span class="card-category">Gaming</span>
        <h2><a href="{{ route('article6') }}">Immersion totale dans vos jeux</a></h2>
        <p>Casques VR, manettes et accessoires gaming...</p>
        <div class="card-meta">
          <span><i class="far fa-clock"></i> 5 min</span>
          <span><i class="far fa-calendar"></i> 10 Sep 2025</span>
          <button class="like-btn" data-article-id="6">
            <i class="far fa-heart"></i>
            <span class="like-count"></span>
          </button>
        </div>
        <a class="read-more" href="{{ route('article6') }}">Lire l'article</a>
      </div>
    </article>

    </section>
  </main>

@endsection