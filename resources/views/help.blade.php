
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Help</title>
    <link rel="stylesheet" href="{{ asset('assets/css/help.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>

  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'Aide- Shopecart')

@section('content')
<body>

  <div class="content-wrapper">
  <main class="help-page">
    <!-- Hero Section -->
    <section class="help-hero">
      <h1 class="helpTitle">Help Center</h1>
      <p class="helpIntro">
        Get assistance with your Shopcart account or any questions you may have.
      </p>
    </section>

    <!-- FAQ Accordion -->
    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-user-plus"></i></span>
          <h3>How do I create an account?</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>Visit the registration page, enter your email or phone number, name, and password, then click 'Sign up'. You can also use social login options (Google, Apple, Facebook).</p>
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-key"></i></span>
          <h3>What if I forgot my password?</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>Go to the login page, click 'Forgot Password', enter your email, and follow the reset link sent to you.</p>
        </div>
      </div>

      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-sign-in-alt"></i></span>
          <h3>Why can’t I log in?</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>Check your credentials. If the issue persists, contact support with your account details.</p>
        </div>
      </div>
    </div>

    <!-- Support Form -->
    <section class="support-form-section">
      <h3>Need More Help? Contact Us</h3>
      <form id="supportForm" class="support-form" novalidate>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="your@email.com" required>
          <span class="error-msg"></span>
        </div>

        <div class="form-group">
          <label for="message">Message</label>
          <textarea id="message" name="message" placeholder="Describe your issue..." required></textarea>
          <span class="error-msg"></span>
        </div>

        <button type="submit" class="btn-submit">Send Request</button>
      </form>

      <div id="formSuccess" class="success-message" style="display: none;">
        <i class="fas fa-check-circle"></i>
        <p>Thank you! Your request has been sent. We'll get back to you within 24 hours.</p>
      </div>
    </section>

    <!-- Troubleshooting Tips -->
    <section class="troubleshooting">
      <h3>Troubleshooting Tips</h3>
      <ul class="tips-list">
        <li><i class="fas fa-envelope"></i> Check your spam/junk folder for verification emails.</li>
        <li><i class="fas fa-broom"></i> Clear your browser cache or try a different browser.</li>
        <li><i class="fas fa-wifi"></i> Ensure your internet connection is stable.</li>
      </ul>
    </section>

    <!-- Contact Info -->
    <section class="contact-info">
      <p>
        For urgent issues, email 
        <a href="mailto:support@shopcart.com" class="email-link" data-copy="support@shopcart.com">
          support@shopcart.com
        </a>.
        <span class="copy-feedback">Copied!</span>
      </p>
      <p style="margin-top: 1rem;">
        <a href="security.html" class="privacy">Privacy Policy</a> |
        <a href="conditions.html" class="terms">Terms & Conditions</a>
      </p>
    </section>

    <!-- Dark Mode Toggle -->
    <div class="dark-mode-toggle">
      <input type="checkbox" id="darkSwitch">
      <label for="darkSwitch"><i class="fas fa-moon"></i> Dark Mode</label>
    </div>
  </main>
</div>
    
<script src="{{ asset('assets/js/help.js') }}"></script>
</body>
@endsection
