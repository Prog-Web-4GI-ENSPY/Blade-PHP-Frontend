<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Shopcart - Connexion</title>

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
  <script src="{{ asset('assets/js/login.js') }}" defer></script>
  <script src="{{ asset('assets/js/api-service.js') }}" defer></script>

  <script></script>
</head>
<body>
  <div class="center-column">

      <header class="brand">
        <img src="assets/images/logo.png" alt="Logo Shopcart" class="brand-logo">
        <h1 class="brand-title">Shopcart</h1>
      </header>

      <section class="auth-area">
        <div class="auth-card">
          <div class="auth-head">
            <h2>s’identifier</h2>
          </div>

          <form action="{{ route('login') }}" class="login-form" autocomplete="off" novalidate>
            @csrf
            <label class="field-label">email ou numero de telephone</label>
            <input class="field-input" type="text" name="email" placeholder="nom@email.com " required>

            <label class="field-label">mot de passe</label>
            <input class="field-input" type="password" name="password" placeholder=".... " required>

            <div class="social-row">
              <button type="button" class="social-icon" aria-label="Google"><i class="fab fa-google"></i></button>
              <button type="button" class="social-icon" aria-label="Apple"><i class="fab fa-apple"></i></button>
              <button type="button" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></button>
            </div>

            <button class="btn-continue" type="submit"> Connecter </button>

            <div class="card-separator"></div>

            <a href="help.html" class="help-link">BESOIN D'AIDE</a>
          </form>
        </div>
      </section>

      <section class="signup-area">
        <div class="line-with-text"><span>nouveau sur la plateforme?</span></div>
        <a  href="/register" class="btn-create">créer un compte</a>
      </section>

      <footer class="site-footer">
        <nav class="footer-links">
          <a href="conditions.html">conditions utilisateur</a>
          <a href="help.html">aide</a>
          <a href="cookies.html">cookies</a>
          <a href="security.html">securite</a>
          <a href="#">annonce</a>
        </nav>
        <p class="copyright">copyright &copy; 2025 Shopcart - Tous les droits réservés</p>
      </footer>
  </div>
  
</body>
</html>