

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Shopcart - Advertisement Policy</title>
  <link rel="stylesheet" href="{{ asset('assets/css/advertisement.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
  <script src="{{ asset('assets/js/advertisement.js') }}"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:wght@600;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>

  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'Ad- Shopecart')

@section('content')
<body>
  <div class="content-wrapper">
    <main class="ads-page">
      <!-- Hero Section -->
      <section class="ads-hero">
        <h1 class="adsTitle">Advertisement Policy</h1>
        <p class="adsIntro">
          At Shopcart, we strive to provide a transparent and fair advertising experience. This policy outlines how we
          handle advertisements, your rights as a user, and our commitment to ethical practices.
        </p>
      </section>

      <!-- Accordion -->
      <div class="accordion" id="adsAccordion">
        <!-- Purpose of Advertisements -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-bullhorn"></i></span>
            <h3>Purpose of Advertisements</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <p>To fund free features and improve our services, and to promote relevant products and offers to enhance
              your shopping experience.</p>
          </div>
        </div>

        <!-- Types of Advertisements -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-ad"></i></span>
            <h3>Types of Advertisements</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <ul>
              <li><strong>Sponsored Listings:</strong> Promoted products from our partners.</li>
              <li><strong>Banner Ads:</strong> Display ads on our site.</li>
              <li><strong>Email Promotions:</strong> Targeted offers sent to subscribers.</li>
              <li><strong>Third-Party Ads:</strong> Ads from external networks (e.g., Google Ads).</li>
            </ul>
          </div>
        </div>

        <!-- Advertising Guidelines -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-clipboard-check"></i></span>
            <h3>Advertising Guidelines</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <ul>
              <li>All ads must comply with local laws and Shopcart’s terms.</li>
              <li>No misleading claims, offensive content, or prohibited products (e.g., illegal goods).</li>
              <li>Ads must be clearly labeled as 'Sponsored' or 'Advertisement'.</li>
            </ul>
          </div>
        </div>

        <!-- User Rights and Control -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-user-cog"></i></span>
            <h3>User Rights and Control</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <p>Ads may be personalized based on your browsing behavior or preferences.</p>
            <p>You can disable personalized ads via your account settings or browser preferences.</p>
            <p><a href="https://support.google.com/ads" target="_blank" rel="noopener">Click here for instructions</a>.
            </p>
            <p>We may share anonymized data with ad partners, subject to our <a href="/html/privacy.html"
                class="privacy">Privacy Policy</a>.</p>
          </div>
        </div>

        <!-- Prohibited Practices -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-ban"></i></span>
            <h3>Prohibited Practices</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <ul>
              <li>False discounts or scams.</li>
              <li>Ads targeting vulnerable groups without consent.</li>
              <li>Malware or intrusive pop-ups.</li>
            </ul>
          </div>
        </div>

        <!-- Enforcement and Reporting -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-exclamation-triangle"></i></span>
            <h3>Enforcement and Reporting</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <p>We monitor ad compliance and reserve the right to remove violating content.</p>
            <p>Report an ad issue by emailing
              <a href="mailto:support@shopcart.com" class="email-link" data-copy="support@shopcart.com">
                support@shopcart.com
              </a>.
              <span class="copy-feedback">Copied!</span>
            </p>
          </div>
        </div>

        <!-- Legal and Updates -->
        <div class="accordion-item">
          <button class="accordion-header" aria-expanded="false">
            <span class="icon"><i class="fas fa-gavel"></i></span>
            <h3>Legal and Updates</h3>
            <span class="chevron"><i class="fas fa-chevron-down"></i></span>
          </button>
          <div class="accordion-body">
            <p>This policy complies with applicable advertising laws.</p>
            <p>We may update it periodically—check back for changes.</p>
            <p style="margin-top: 1rem;">
              <a href="/html/privacy.html" class="privacy">Privacy Policy</a> |
              <a href="/html/terms.html" class="terms">Terms & Conditions</a>
            </p>
          </div>
        </div>
      </div>

   
    </main>
  </div>

</body>

@endsection
