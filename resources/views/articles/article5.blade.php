@extends('layouts.app')

@section('title', 'article- Shopecart')

@section('content')
  <main class="article-content">
    <a href="{{ route('blog') }}" class="back-to-blog">
      <i class="fas fa-arrow-left"></i> Retour au blog
    </a>


    <article class="article-header">
      <h1>Le bureau du futur</h1>
      <div class="date">
        <i class="far fa-calendar"></i> Publié le 3 octobre 2025
      </div>
      <div class="author">
        <i class="far fa-user"></i> Par l'équipe Shopcart
      </div>
    </article>

    <img src="/assets/images/femmecasque.jpg" alt="Femme utilisant un casque audio" class="article-featured-image">

    <p>Le télétravail et les études à domicile sont devenus la norme pour beaucoup d'entre nous. Pour rester productif et organisé, un setup de bureau bien pensé est essentiel. Des ordinateurs performants aux accessoires ergonomiques, découvrez comment créer un espace de travail qui stimule l'efficacité.</p>

    <h2>L'ordinateur : cœur de votre bureau</h2>
    <p>Que vous optiez pour un ordinateur portable polyvalent comme le MacBook Air ou un PC fixe puissant, la performance est clé. Les processeurs récents, associés à une RAM suffisante, permettent de gérer plusieurs applications simultanément sans ralentissement. Pour les créatifs, un écran haute résolution et une carte graphique performante sont indispensables.</p>

    <blockquote>
      "Un bureau bien équipé n'est pas un luxe, c'est un investissement dans votre productivité et votre bien-être quotidien."
    </blockquote>

    <h3>Les éléments d'un bureau optimisé</h3>
    <ul>
      <li>Ordinateur adapté à vos besoins (portable pour la mobilité, fixe pour la puissance)</li>
      <li>Écran large ou double écran pour le multitâche</li>
      <li>Clavier et souris ergonomiques pour le confort</li>
      <li>Casque à réduction de bruit pour la concentration</li>
      <li>Éclairage adapté et siège ergonomique</li>
    </ul>

    <h2>Accessoires intelligents pour plus d'efficacité</h2>
    <p>Les accessoires transforment un simple bureau en un véritable espace de travail intelligent. Une imprimante sans fil, un scanner de documents ou un hub USB-C peuvent considérablement améliorer votre flux de travail. N'oubliez pas les solutions de stockage externes pour sauvegarder vos données en sécurité.</p>

    <h3>Notre sélection bureau</h3>
    <ol>
      <li>MacBook Pro 16" - La puissance créative</li>
      <li>Dell XPS 13 - L'ultraportable performant</li>
      <li>HP Pavilion - Le rapport qualité-prix idéal</li>
      <li>Monitor LG UltraFine 4K - La clarté professionnelle</li>
      <li>Logitech MX Keys - Le clavier ergonomique par excellence</li>
    </ol>

    <p>Chez Shopcart, nous vous aidons à construire le bureau de vos rêves, qu'il soit destiné au travail, aux études ou aux projets personnels. Parcourez notre sélection et transformez votre espace de travail en un lieu d'inspiration et de productivité. Nos experts peuvent vous conseiller sur les combinaisons d'équipements les plus adaptées à votre situation.</p>

    <blockquote>
      "Votre environnement de travail façonne votre état d'esprit et influence directement votre réussite."
    </blockquote>

    <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #e5e7eb;">
      <a href="{{ route('blog') }}" class="back-to-blog">
        <i class="fas fa-arrow-left"></i> Retour au blog
      </a>
    </div>
  </main>
@endsection