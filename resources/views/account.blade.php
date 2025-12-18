
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shopcart - Account parameters</title>
        <link rel="stylesheet" href="{{ asset('assets/css/mainaccount.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
        <!-- Utilisation de Font Awesome pour les icônes -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
      
        <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
        <script src="{{ asset('assets/js/account.js') }}" defer></script>
 
  <script src="{{ asset('assets/js/header.js') }}"></script>
</head>
@extends('layouts.app')

@section('title', 'Compte- Shopecart')

@section('content')
<body>

    <div class="container">
      <aside class="sidebar">
        <div class="profile">
          <div class="avatar">PN</div>
          <div>
            <div class="name">Pierre-Marcelle N.</div>
            <div class="email">pierre@example.com</div>
          </div>
        </div>
  
        <nav class="nav">
          <a href="#profile" class="active">Account & Profil</a>
          <a href="#security">Security & Password</a>
          <a href="/orders-history.html">My orders</a>
        </nav>
  
        <div style="margin-top:16px">
          <div class="muted">Member since</div>
          <div style="font-weight:600">12 January 2023</div>
        </div>
      </aside>
  
      <main>
        <section class="card" id="profile">
            <h1>Account parameters</h1>
            <p class="lead">Gérez vos informations personnelles, coordonnées et préférences de compte.</p>

            <div class="section">
                <div class="section-title">Profil</div>
                <div class="form-grid">
                    <div>
                        <label for="firstName">First Name</label>
                        <input type="text" id="firstName" name="firstName" />
                    </div>
                    <div>
                        <label for="lastName">Last Name</label>
                        <input type="text" id="lastName" name="lastName" />
                    </div>
                    <div>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" />
                        <div class="muted">Email is used for authentification and notifications.</div>
                    </div>
                    <div>
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" />
                    </div>
                    <div>
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" />
                    </div>
                </div>

                <div class="row-right" style="margin-top:12px;">
                    <button class="btn btn-primary" id="saveProfileBtn">Save</button>
                </div>
            </div>

            <div class="section" id="security">
                <div class="section-title">Security</div>
                <div style="display:grid;gap:12px">
                    <div>
                        <label>Change password</label>
                        <div class="form-grid">
                            <div><input type="password" id="oldPassword" placeholder="Mot de passe actuel"/></div>
                            <div><input type="password" id="newPassword" placeholder="Nouveau mot de passe"/></div>
                            <div><input type="password" id="confirmPassword" placeholder="Confirmer le nouveau mot de passe"/></div>
                        </div>
                    </div>
                    <div class="row-right">
                        <button class="btn btn-primary" id="updatePasswordBtn">Update password</button>
                    </div>
                    <div class="muted">Conseil : utilisez un mot de passe long et unique. Activez l'authentification à deux facteurs pour une sécurité supplémentaire.</div>
                </div>
            </div>
        </section>
      </main>
    </div>
  
    <script>
      // Navigation fluide entre les sections
      document.querySelectorAll('.nav a').forEach(a=>{
        a.addEventListener('click', (e)=>{
          e.preventDefault();
          document.querySelectorAll('.nav a').forEach(x=>x.classList.remove('active'));
          a.classList.add('active');
          const id = a.getAttribute('href').slice(1);
          const el = document.getElementById(id);
          if(el) el.scrollIntoView({behavior:'smooth', block:'start'});
        });
      });
    </script>

  
</body>
@endsection