<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Shopecart Cameroon')</title>

    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @stack('styles')
</head>
<body>

    @include('partials.header')

    <main id="main-content">
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="{{ asset('assets/js/api-service.js') }}"></script>
    
    <script src="{{ asset('assets/js/header.js') }}"></script>
    
    <script defer src="{{ asset('assets/js/logout.js') }}"></script>
    <script defer src="{{ asset('assets/js/newsletter.js') }}"></script>
    <script defer src="{{ asset('assets/js/Blog.js') }}"></script>

    @stack('scripts')

    <script>
        // Petite sécurité pour éviter les erreurs "CartData is already declared"
        // Si un script enfant essaie de le redéclarer, window.CartData aura la priorité.
        if (typeof CartData === 'undefined') {
            window.CartData = { items: [], total: 0 };
        }
    </script>
</body>
</html>