<footer>
    <!-- Section des avantages -->
    <div class="footer-top">
      <div class="benefits">
        <div class="benefit">
          <i class="fas fa-truck"></i>
          <p>Livraison à domicile</p>
        </div>
        <div class="benefit">
          <i class="fas fa-lock"></i>
          <p>Paiement sécurisé</p>
        </div>
        <div class="benefit">
          <i class="fas fa-undo"></i>
          <p>Retours faciles</p>
        </div>
        <div class="benefit">
          <i class="fas fa-headset"></i>
          <p>Support client 24/7</p>
        </div>
      </div>
    </div>

    <!-- Grille principale -->
    <div class="footer-container">

      <!-- Section Navigation Rapide -->
      <div class="footer-section">
        <h3>Navigation Rapide</h3>
        <ul>
          <li><a href="#">Deals</a></li>
        <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('blog') }}">Blog</a></li>
          <li><a href="#">Promotions</a></li>
        </ul>
      </div>

      <!-- Section À propos -->
      <div class="footer-section about-section">
        <h3>À propos de Shopcart</h3>
        <p>Votre destination en ligne pour les meilleurs appareils électroniques. Qualité, prix compétitifs et service
          client exceptionnel.</p>
        <div class="social-links">
          <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
          <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
          <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
          <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        </div>
      </div>

      <!-- Section Boutique -->
      <div class="footer-section">
        <h3>Boutique</h3>
        <div class="shop-categories">
          <ul>
            <li><a href="{{route('tel') }}">Smartphones</a></li>
            <li><a href="{{ route('ordi') }}">Ordinateurs</a></li>
            <li><a href="{{ route('casque') }}">Casques</a></li>
            <li><a href="{{ route('manettes') }}">Accessoires</a></li>
          </ul>
        </div>
      </div>

      <!-- Section Newsletter et Contact -->
      <div class="footer-section">
        <h3>Restez Informé</h3>
        <div class="newsletter-section">
          <p>Inscrivez-vous à notre newsletter</p>
          <form id="newsletter-form" class="newsletter-form">
            <div class="input-container">
              <i class="far fa-envelope"></i>
              <input type="email" id="newsletter-email" placeholder="Votre email" required>
            </div>
            <button type="submit">S'inscrire</button>
          </form>
        </div>

        <div class="contact-info" style="margin-top: 20px;">
          <p><i class="fas fa-envelope"></i> business@shopcart.com</p>
          <p><i class="fas fa-phone"></i> +237 657450314</p>
          <p><i class="fas fa-map-marker-alt"></i> Yaoundé, Cameroun</p>
          <p><i class="fas fa-clock"></i> Lun-Sam: 8h-18h</p>
        </div>
      </div>
    </div>

    <!-- Séparateur -->
    <div class="footer-divider"></div>

    <!-- Footer bottom -->
    <div class="footer-bottom">
      <div class="payment-methods">
        <p>Nous acceptons</p>
        <div class="payment-icons">
          <i class="fab fa-cc-visa"></i>
          <i class="fab fa-cc-mastercard"></i>
          <i class="fab fa-cc-paypal"></i>
          <i class="fab fa-cc-apple-pay"></i>
        </div>
      </div>

      <p>© Copyright {{ date('Y') }} Shopcart. Tous droits réservés.</p>

      <div class="footer-links">
        <a href="{{ route('security') }}">Confidentialité</a>
        <a href="{{ route('conditions') }}">Conditions d'utilisation</a>
        <a href="{{ route('cookies') }}">Mentions légales</a>
      </div>
    </div>
  </footer>