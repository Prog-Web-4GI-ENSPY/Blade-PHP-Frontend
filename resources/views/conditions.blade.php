
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopcart - Terms & Conditions</title>
    <link rel="stylesheet" href="{{ asset('assets/css/conditions.css') }}">
     <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'Conditions- Shopecart')

@section('content')
<body>
 
    <div class="content-wrapper">
  <main class="terms-page">
    <!-- Hero Section -->
    <section class="terms-hero">
      <h1 class="termsTitle">Terms & Conditions</h1>
      <p class="termsIntro">
        Welcome to Shopcart. These Terms & Conditions govern your use of our website and services. By accessing or using Shopcart, you agree to be bound by these terms. Please read them carefully.
      </p>
    </section>

    <!-- Accordion -->
    <div class="accordion" id="termsAccordion">
      <!-- Acceptance of Terms -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-check-circle"></i></span>
          <h3>Acceptance of Terms</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>By creating an account or making a purchase, you accept these Terms & Conditions in full.</p>
        </div>
      </div>

      <!-- Eligibility -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-user-check"></i></span>
          <h3>Eligibility</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>You must be at least <strong>18 years old</strong> to use Shopcart.</p>
        </div>
      </div>

      <!-- Account Registration -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-key"></i></span>
          <h3>Account Registration and Security</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>You are responsible for maintaining the confidentiality of your account credentials.</p>
        </div>
      </div>

      <!-- User Conduct -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-gavel"></i></span>
          <h3>User Conduct</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>You agree not to use Shopcart for any unlawful purpose or to infringe on others’ rights.</p>
        </div>
      </div>

      <!-- Service Description -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-store"></i></span>
          <h3>Service Description</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>Shopcart provides an e-commerce platform for purchasing goods and managing user accounts.</p>
        </div>
      </div>

      <!-- Payments and Refunds -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-credit-card"></i></span>
          <h3>Payments and Refunds</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>All purchases are final unless otherwise stated. Refunds are processed within <strong>14 days</strong>.</p>
        </div>
      </div>

      <!-- Intellectual Property -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-copyright"></i></span>
          <h3>Intellectual Property</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>All content on Shopcart is owned by us and protected by copyright law.</p>
        </div>
      </div>

      <!-- Limitation of Liability -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-shield-alt"></i></span>
          <h3>Limitation of Liability</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>Shopcart is not liable for any indirect damages arising from use of the site.</p>
        </div>
      </div>

      <!-- Termination -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-ban"></i></span>
          <h3>Termination</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>We may terminate your account for violation of these terms with notice.</p>
        </div>
      </div>

      <!-- Governing Law -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-balance-scale"></i></span>
          <h3>Governing Law</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>These terms are governed by the laws of <strong>Cameroon</strong>.</p>
        </div>
      </div>

      <!-- Changes to Terms -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-edit"></i></span>
          <h3>Changes to Terms</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>We may revise these terms at any time. Updates will be posted here with the effective date.</p>
        </div>
      </div>

      <!-- Contact Information -->
      <div class="accordion-item">
        <button class="accordion-header" aria-expanded="false">
          <span class="icon"><i class="fas fa-envelope"></i></span>
          <h3>Contact Information</h3>
          <span class="chevron"><i class="fas fa-chevron-down"></i></span>
        </button>
        <div class="accordion-body">
          <p>
            For inquiries, contact
            <a href="mailto:support@shopcart.com" class="email-link" data-copy="support@shopcart.com">
              support@shopcart.com
            </a>.
            <span class="copy-feedback">Copied!</span>
          </p>
          <p style="margin-top: 1rem;">
            <a href="security.html" class="privacy">Privacy Policy</a> |
            <a href="cookies.html" class="cookies">Cookies</a>
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
    

<script src="{{ asset('assets/js/conditions.js') }}"></script>
@endsection