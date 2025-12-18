<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Créer un compte</title>
   
  <script src="{{ asset('assets/js/api-service.js') }}" defer></script>
  <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
  <script src="{{ asset('assets/js/register.js') }}" defer></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <h2>Créer votre compte</h2>
          </div>

          <form class="login-form" autocomplete="off" novalidate>
            <label class="field-label">email ou numero de telephone</label>
            <input class="field-input" type="text" name="login" placeholder=" ">

            <label class="field-label">nom d'utilisateur</label>
            <input class="field-input" type="text" name="username" placeholder=" ">

            <label class="field-label">mot de passe</label>
            <input class="field-input" type="password" name="password" placeholder=" ">

            <label class="field-label">confirmer le mot de passe</label>
            <input class="field-input" type="password" name="confirm_password" placeholder=" ">

            <div class="social-row">
              <button type="button" class="social-icon" aria-label="Google"><i class="fab fa-google"></i></button>
              <button type="button" class="social-icon" aria-label="Apple"><i class="fab fa-apple"></i></button>
              <button type="button" class="social-icon" aria-label="Facebook"><i class="fab fa-facebook-f"></i></button>
            </div>

            <button class="btn-continue" type="submit"> inscrivez vous </button>

            <div class="card-separator"></div>

            <a href="help.html" class="help-link">BESOIN D'AIDE</a>
          </form>
        </div>
      </section>

      <section class="signup-area">
        <div class="line-with-text"><span>Vous avez déjà un compte?</span></div>
        <a class="btn-create" href="/login">se connecter</a>
      </section>

      <footer class="site-footer">
        <nav class="footer-links">
          <a href="conditions.html">Conditions of use</a>
        <a href="help.html">Help</a>
        <a href="cookies.html">cookies</a>
        <a href="security.html">Security</a>
        <a href="advertisement.html">Advertisement</a>
        </nav>
        <p class="copyright">copyright &copy; 2025 Shopcart - Tous les droits réservés</p>
      </footer>
  </div>
<script src="assets/js/register.js" defer></script>
</body>
</html>