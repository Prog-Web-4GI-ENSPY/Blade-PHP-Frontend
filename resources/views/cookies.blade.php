
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Cookies Policy</title>
    <link rel="stylesheet" href="{{ asset('assets/css/cookies.css') }}">
      <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
 
  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'Cookies- Shopecart')

@section('content')
<body>

  <div class="content-wrapper">
  <main class="cookies-page">
    <!-- Hero Section -->
    <section class="cookies-hero">
      <h1 class="cookiesTitle">Cookies Policy</h1>
      <p class="cookiesIntro">
        At Shopcart, we use cookies to enhance your browsing experience, remember your preferences, and analyze site usage. This policy explains how we use cookies and your options to manage them.
      </p>
    </section>

    <!-- Accordion -->
    <div class="accordion" id="cookiesAccordion">
      <!-- What Are Cookies? -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-cookie-bite"></i></span>
          <h3>What Are Cookies?</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>Cookies are small text files stored on your device that help us personalize your experience and improve our services.</p>
        </div>
      </div>

      <!-- Types of Cookies -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-list-ul"></i></span>
          <h3>Types of Cookies We Use</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <ul>
            <li><strong>Essential Cookies:</strong> Enable core functions like account access and shopping cart management.</li>
            <li><strong>Performance Cookies:</strong> Track site performance and user trends (e.g., via analytics tools).</li>
            <li><strong>Functional Cookies:</strong> Save your language and interface preferences.</li>
            <li><strong>Advertising Cookies:</strong> Support targeted ads (if you opt in).</li>
          </ul>
        </div>
      </div>

      <!-- How We Use Cookies -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-cogs"></i></span>
          <h3>How We Use Cookies</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <ul>
            <li>To keep you logged in across sessions.</li>
            <li>To maintain your cart contents during shopping.</li>
            <li>To show relevant advertisements (with your consent).</li>
          </ul>
        </div>
      </div>

      <!-- Your Cookie Choices -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-sliders-h"></i></span>
          <h3>Your Cookie Choices</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>
            You can control cookies via your browser settings. Visit 
            <a href="https://www.google.com/support" target="_blank" rel="noopener">this guide</a> for help.
          </p>
          <p>
            To opt out of non-essential cookies, 
            <button class="opt-out-btn" id="openOptOutModal">Opt Out</button>.
          </p>
          <p><em>By using our site, you agree to essential cookies; non-essential use requires your consent.</em></p>
        </div>
      </div>

      <!-- Third-Party Cookies -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-handshake"></i></span>
          <h3>Third-Party Cookies</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>We may work with partners (e.g., for analytics or ads) who set their own cookies. See our <a href="security.html" class="privacy">Privacy Policy</a> for details.</p>
        </div>
      </div>

      <!-- Legal & Updates -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-calendar-alt"></i></span>
          <h3>Legal & Updates</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p><strong>Last updated:</strong> October 12, 2025</p>
          <p>We may revise this policy periodically.</p>
          <p>
            For questions, contact 
            <a href="mailto:support@shopcart.com" class="email-link" data-copy="support@shopcart.com">
              support@shopcart.com
            </a>.
            <span class="copy-feedback">Copied!</span>
          </p>
          <p style="margin-top: 1rem;">
            <a href="security.html" class="privacy">Privacy Policy</a> |
            <a href="conditions.html" class="terms">Terms & Conditions</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Dark Mode Toggle -->
    <div class="dark-mode-toggle">
      <input type="checkbox" id="darkSwitch">
      <label for="darkSwitch"><i class="fas fa-moon"></i> Dark Mode</label>
    </div>
  </main>
</div>

<!-- Opt-Out Modal -->
<div class="modal" id="optOutModal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Opt Out of Non-Essential Cookies</h2>
    <p>You're about to disable cookies used for analytics and personalized ads.</p>
    <p><strong>This will take effect immediately and persist across sessions.</strong></p>
    <div class="modal-actions">
      <button id="confirmOptOut" class="btn-primary">Yes, Opt Out</button>
      <button id="cancelOptOut" class="btn-secondary">Cancel</button>
    </div>
    <p class="note"><em>You can always re-enable via browser settings.</em></p>
  </div>
</div>
  <script src="{{ asset('assets/js/cookies.js') }}"></script>  

</body>
@endsection

