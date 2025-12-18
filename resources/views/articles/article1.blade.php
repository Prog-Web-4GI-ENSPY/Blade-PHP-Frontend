@extends('layouts.app')

@section('title', 'article- Shopecart')

@section('content')
  <main class="article-content">
    <a href="{{ route('blog') }}" class="back-to-blog">
      <i class="fas fa-arrow-left"></i> Retour au blog
    </a>

    <article class="article-header">
      <h1>Au sommet du monde des smartphones</h1>
      <div class="date">
        <i class="far fa-calendar"></i> Publié le 3 octobre 2025
      </div>
      <div class="author">
        <i class="far fa-user"></i> Par l'équipe Shopcart
      </div>
    </article>

    <img src="/assets/images/fille.jpg" alt="Femme utilisant un smartphone" class="article-featured-image">

    <p>Vous cherchez un smartphone performant ? Ne cherchez plus ! Notre catalogue de smartphones est à couper le souffle, et en tête d'affiche, découvrez l'exclusivité du moment : l'iPhone 12 Pro Max. Ce bijou technologique repousse les limites de l'innovation avec des performances inégalées et un design élégant.</p>

    <h2>Pourquoi l'iPhone 12 Pro Max se démarque-t-il ?</h2>
    <p>Doté d'un écran Super Retina XDR de 6,7 pouces, l'iPhone 12 Pro Max offre une qualité visuelle époustouflante, parfaite pour les amateurs de streaming et de jeux. Sa puce A14 Bionic garantit une rapidité fulgurante, même pour les applications les plus gourmandes. Que vous soyez un créateur de contenu ou un utilisateur quotidien, ce smartphone s'adapte à tous vos besoins.</p>

    <blockquote>
      "L'iPhone 12 Pro Max n'est pas qu'un téléphone, c'est un véritable compagnon technologique qui redéfinit l'excellence."
    </blockquote>

    <h3>Les points forts de l'iPhone 12 Pro Max</h3>
    <ul>
      <li>Écran Super Retina XDR de 6,7 pouces pour une immersion totale</li>
      <li>Puce A14 Bionic pour des performances exceptionnelles</li>
      <li>Système de triple caméra avec capteur LiDAR</li>
      <li>Connectivité 5G pour des débits ultrarapides</li>
    </ul>

    <h2>Un design qui allie style et robustesse</h2>
    <p>Avec son Ceramic Shield, l'iPhone 12 Pro Max est plus résistant que jamais. Son design en acier inoxydable et ses finitions soignées en font un appareil aussi beau que durable. Disponible en plusieurs coloris, il saura séduire tous les goûts.</p>

    <h3>Notre sélection de smartphones premium</h3>
    <ol>
      <li>iPhone 12 Pro Max - L'excellence Apple</li>
      <li>Samsung Galaxy S23 Ultra - La polyvalence suprême</li>
      <li>Google Pixel 8 Pro - La photographie réinventée</li>
      <li>OnePlus 11 - Performance et fluidité</li>
      <li>Xiaomi 13 Pro - Innovation et rapport qualité-prix</li>
    </ol>

    <p>Prêt à rejoindre le sommet du monde des smartphones ? Explorez notre catalogue exclusif sur Shopcart et laissez-vous tenter par l'iPhone 12 Pro Max. Votre prochain coup de cœur technologique vous attend ! Nos conseillers sont disponibles pour vous aider à faire le choix parfait selon vos besoins et votre budget.</p>

    <blockquote>
      "Choisir le bon smartphone, c'est s'offrir un outil qui vous accompagne dans chaque aspect de votre vie quotidienne."
    </blockquote>

    <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #e5e7eb;">
      <a href="{{ route('blog') }}" class="back-to-blog">
        <i class="fas fa-arrow-left"></i> Retour au blog
      </a>
    </div>
  </main>
@endsection