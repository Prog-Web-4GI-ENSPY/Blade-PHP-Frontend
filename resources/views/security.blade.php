
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Security</title>
    <link rel="stylesheet" href="{{ asset('assets/css/security.css')}}">
      <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>

  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'Security- Shopecart')

@section('content')
<body>

  
  <div class="content-wrapper">
  <main class="security-page">
    <!-- ==== HERO ==== -->
    <section class="security-hero">
      <h1 class="securityTitle">Privacy Policy</h1>
      <p class="securityIntro">
        At Shopcart, your security is our priority. Learn how we protect your data and what you can do to stay safe online.
      </p>
    </section>

    <!-- ==== ACCORDION ==== -->
    <div class="accordion" id="securityAccordion">
      <!-- Security Measures -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-shield-alt"></i></span>
          <h3>Security Measures</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <ul>
            <li>We use industry-standard <strong>SSL/TLS encryption</strong> to secure your data during transmission.</li>
            <li>Your personal information is stored on secure servers with restricted access.</li>
            <li>We implement strong password policies and <strong>two-factor authentication (2FA)</strong> where available.</li>
            <li>Our systems are regularly audited by third-party security experts.</li>
          </ul>
        </div>
      </div>

      <!-- User Responsibilities -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-user-shield"></i></span>
          <h3>User Responsibilities</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <ul>
            <li>Create a unique, strong password using a mix of letters, numbers, and symbols.</li>
            <li>Regularly check your account for suspicious activity.</li>
            <li>Avoid clicking unknown links or sharing your login details.</li>
          </ul>
        </div>
      </div>

      <!-- Incident Reporting -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-exclamation-triangle"></i></span>
          <h3>Incident Reporting</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>
            If you suspect a security breach, contact us immediately at
            <a href="mailto:support@shopcart.com" class="email-link" data-copy="support@shopcart.com">
              support@shopcart.com
            </a>.
            <span class="copy-feedback">Copied!</span>
          </p>
          <p>We aim to respond within <strong>24 hours</strong> to security concerns.</p>
        </div>
      </div>

      <!-- Legal Information -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-gavel"></i></span>
          <h3>Legal Information</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>
            Our security practices comply with applicable laws, including
            <strong>GDPR</strong> and <strong>CCPA</strong>.
            See our
            <a href="/security.html" class="security">PrivacyPolicy</a> and
            <a href="/conditions.html" class="conditions">Terms & Conditions</a>
            for more details.
          </p>
        </div>
      </div>
    </div>

    <!-- Dark-mode toggle (optional) -->
    <div class="dark-mode-toggle">
      <input type="checkbox" id="darkSwitch">
      <label for="darkSwitch"><i class="fas fa-moon"></i> Dark Mode</label>
    </div>
  </main>
</div>


  

<script src="{{ asset('assets/js/security.js') }}"></script>
</body>
@endsection

