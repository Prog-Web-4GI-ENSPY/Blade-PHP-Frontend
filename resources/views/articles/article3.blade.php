@extends('layouts.app')

@section('title', 'article- Shopecart')

@section('content')
  <main class="article-content">
    <a href="{{ route('blog') }}" class="back-to-blog">
      <i class="fas fa-arrow-left"></i> Retour au blog
    </a>


    <article class="article-header">
      <h1>Les créateurs de souvenirs</h1>
      <div class="date">
        <i class="far fa-calendar"></i> Publié le 3 octobre 2025
      </div>
      <div class="author">
        <i class="far fa-user"></i> Par l'équipe Shopcart
      </div>
    </article>

    <img src="/assets/images/laptopcamera.jpg" alt="Appareils photo et équipement de création" class="article-featured-image">

    <p>Afin de capturer les moments qui comptent, notre gamme de caméras est là pour vous accompagner. Que ce soit pour immortaliser un coucher de soleil, un anniversaire en famille ou une aventure en voyage, une caméra de qualité transforme chaque instant en un souvenir précieux.</p>

    <h2>Des caméras pour tous les besoins</h2>
    <p>Des appareils photo reflex pour les passionnés aux caméras compactes pour les débutants, notre sélection couvre tous les profils. Les modèles comme le Canon EOS R5 offrent une qualité d'image exceptionnelle avec des vidéos en 8K, tandis que les caméras instantanées Fujifilm Instax apportent une touche rétro amusante.</p>

    <blockquote>
      "Une image vaut mille mots, mais une photo de qualité raconte toute une histoire."
    </blockquote>

    <h3>Comment choisir sa caméra ?</h3>
    <ul>
      <li><strong>Débutants :</strong> Caméras compactes ou hybrides entry-level</li>
      <li><strong>Amateurs :</strong> Hybrides polyvalentes comme la Sony A7 III</li>
      <li><strong>Professionnels :</strong> Reflex ou hybrides haut de gamme</li>
      <li><strong>Vloggers :</strong> Caméras légères avec bon autofocus et stabilisation</li>
    </ul>

    <h2>Technologie au service de la créativité</h2>
    <p>Avec des fonctionnalités comme la mise au point automatique ultra-rapide et les modes nocturnes avancés, capturer des images nettes n'a jamais été aussi simple. Ajoutez à cela des accessoires comme des trépieds ou des objectifs interchangeables, et laissez libre cours à votre créativité.</p>

    <h3>Notre sélection créative</h3>
    <ol>
      <li>Canon EOS R5 - L'excellence professionnelle</li>
      <li>Sony A7 IV - Le polyvalent haute performance</li>
      <li>Fujifilm X-T5 - Le rétro moderne</li>
      <li>GoPro Hero 12 - L'aventure en action</li>
      <li>Instax Mini 12 - L'instantané magique</li>
    </ol>

    <p>Chez Shopcart, nous avons les outils pour faire de chaque moment un chef-d'œuvre. Parcourez notre collection de caméras et commencez à créer des souvenirs qui dureront toute une vie. Notre équipe d'experts est disponible pour vous conseiller selon votre niveau et vos projets.</p>

    <blockquote>
      "La meilleure caméra n'est pas la plus chère, mais celle qui vous donne envie de créer tous les jours."
    </blockquote>

    <div style="margin-top: 50px; padding-top: 30px; border-top: 2px solid #e5e7eb;">
      <a href="{{ route('blog') }}" class="back-to-blog">
        <i class="fas fa-arrow-left"></i> Retour au blog
      </a>
    </div>
  </main>
@endsection