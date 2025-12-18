
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart</title>
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main_about.css') }}">

     <!-- Utilisation de Font Awesome pour les icônes -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
   <script src="{{ asset('assets/js/about.js') }}"> </script>
  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>

@extends('layouts.app')

@section('title', 'A_propos- Shopecart')

@section('content')
<body>

  <main>

    <section class="hero-about">
        <div class="container">
            <h1 class="hero-title">À Propos de Shopecart</h1>
            <p class="hero-subtitle">Votre partenaire de confiance pour l'électronique depuis 2020</p>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="mission">
        <div class="container">
            <h2 class="section-title">Notre Mission</h2>
            <p class="mission-text">
                Chez Shopecart, notre mission est de rendre la technologie accessible à tous. 
                Nous nous engageons à fournir des produits électroniques de qualité supérieure 
                à des prix compétitifs, tout en offrant un service client exceptionnel.
            </p>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values">
        <div class="container">
            <h2 class="section-title">Nos Valeurs</h2>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">✨</div>
                    <h3>Qualité</h3>
                    <p>Nous sélectionnons rigoureusement chaque produit pour garantir la satisfaction de nos clients.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🚀</div>
                    <h3>Innovation</h3>
                    <p>Nous restons à la pointe de la technologie en proposant les dernières nouveautés du marché.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">🤝</div>
                    <h3>Confiance</h3>
                    <p>La transparence et l'honnêteté sont au cœur de notre relation avec nos clients.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">💼</div>
                    <h3>Service Client</h3>
                    <p>Notre équipe dévouée est disponible pour vous accompagner à chaque étape de votre achat.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3 class="stat-number">5000+</h3>
                    <p class="stat-label">Clients Satisfaits</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number">500+</h3>
                    <p class="stat-label">Produits Disponibles</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number">50+</h3>
                    <p class="stat-label">Marques Partenaires</p>
                </div>
                <div class="stat-item">
                    <h3 class="stat-number">98%</h3>
                    <p class="stat-label">Taux de Satisfaction</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team">
      <h2 class="section-title">Notre Équipe</h2>
            <p class="team-intro">
                Une équipe passionnée et expérimentée au service de vos besoins technologiques
            </p>
        <div class="team-scroll team-right-to-left">
          <div class="container">
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="/assets/images/ALD.png" alt="CHEF">
                    </div>
                    <h3>AZANGUE</h3>
                    <p class="member-role">CEO</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Sountsa Pio">
                    </div>
                    <h3>Sountsa Pio</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Roy">
                    </div>
                    <h3>Roy</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Daryl">
                    </div>
                    <h3>Daryl</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Gabrielle">
                    </div>
                    <h3>Gabrielle</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>

                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Sountsa Pio">
                    </div>
                    <h3>Sountsa Pio</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
            </div>
        </div>
        </div>
        <div class="team-scroll team-left-to-right">
          <div class="container">
            <div class="team-grid1">
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Samuel">
                    </div>
                    <h3>TAGATSING Samuel</h3>
                    <p class="member-role">Administrateur</p>
                    <p class="member-bio">1 an d'expérience dans le secteur de l'électronique</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Pio">
                    </div>
                    <h3>Sountsa Pio</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Bala">
                    </div>
                    <h3>Bala</h3>
                    <p class="member-role">Chef Service Client</p>
                    <p class="member-bio">Garant de votre satisfaction et de votre expérience</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Stacy">
                    </div>
                    <h3>Nkolo Stacy</h3>
                    <p class="member-role">Responsable Logistique</p>
                    <p class="member-bio">Spécialiste de la chaîne d'approvisionnement</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Brunel">
                    </div>
                    <h3>Brunel</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Marcelle">
                    </div>
                    <h3>Marcelle</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="/assets/images/ALD.png" alt="CHEF">
                    </div>
                    <h3>AZANGUE</h3>
                    <p class="member-role">CEO</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
                <div class="team-member">
                    <div class="member-photo">
                        <img src="#" alt="Sountsa Pio">
                    </div>
                    <h3>Sountsa Pio</h3>
                    <p class="member-role">Responsable Achats</p>
                    <p class="member-bio">Experte en sourcing et relations fournisseurs</p>
                </div>
            </div>
        </div>
        </div>
    </section>

     <!-- History Section -->
    <section class="history">
        <div class="container">
            <h2 class="section-title">Notre Histoire</h2>
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2022</div>
                    <div class="timeline-content">
                        <h3>Création de Shopecart</h3>
                        <p>Lancement de notre boutique en ligne avec 50 produits phares</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2023</div>
                    <div class="timeline-content">
                        <h3>Expansion du Catalogue</h3>
                        <p>Plus de 200 produits et partenariats avec des marques internationales</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2024</div>
                    <div class="timeline-content">
                        <h3>Excellence Reconnue</h3>
                        <p>Prix du meilleur e-commerce électronique de l'année</p>
                    </div>
                </div>
                <div class="timeline-item">
                    <div class="timeline-year">2025</div>
                    <div class="timeline-content">
                        <h3>Innovation Continue</h3>
                        <p>Plus de 500 produits et expansion vers de nouveaux marchés</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="container">
            <h2>Rejoignez des Milliers de Clients Satisfaits</h2>
            <p>Découvrez notre sélection de produits électroniques de qualité</p>
            <a href="{{ route('catalogue') }}" class="cta-button">Voir nos Produits</a>
        </div>
    </section>
    
    <!-- Contact Section -->
    <section class="contact">
        <div class="container">
            <h2 class="section-title">Contactez-Nous</h2>
            <p class="contact-intro">Une question ? Notre équipe est là pour vous répondre</p>
            <div class="contact-grid">
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <h3>Adresse</h3>
                        <p>123 Rue Commerce<br>Yaoundé, Cameroun</p>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📧</div>
                        <h3>Email</h3>
                        <p>business@gmail.com<br>support@shopcart.com</p>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">📱</div>
                        <h3>Téléphone</h3>
                        <p>+237 657450314<br>Lun - Sam: 8h - 18h</p>
                    </div>
                </div>
                <div class="contact-form">
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Votre Nom" required>
                        </div>
                        <div class="form-group">
                            <input type="email" placeholder="Votre Email" required>
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Sujet">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Votre Message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="submit-button">Envoyer le Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


  </main>

</body>
@endsection
