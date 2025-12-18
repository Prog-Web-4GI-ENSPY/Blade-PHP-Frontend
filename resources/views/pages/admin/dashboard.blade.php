
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tableau de bord administrateur">
    <title>Tableau de Bord - Administration</title>
    
    <!-- Fichiers CSS dans l'ordre d'importance -->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/headerA.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
@section('title', 'Admin- Shopecart')

@section('content')
<body>
    
    <!-- Conteneur principal de l'application -->
    <div class="app-container">
        
        <!-- BARRE LATÉRALE DE NAVIGATION -->
        <aside class="sidebar">
            
            <!-- En-tête de la sidebar avec logo -->
            <div class="sidebar-header">
                <div class="sidebar-logo">
                    <svg class="sidebar-logo-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L13.09 8.26L20 9L14.55 13.47L16.18 20L12 16.77L7.82 20L9.46 13.47L4 9L10.91 8.26L12 2Z" fill="currentColor"/>
                    </svg>
                    <span>ADMIN</span>
                </div>
                <button class="sidebar-close" aria-label="Fermer la barre latérale">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            
            <!-- Menu de navigation principal -->
            <nav class="sidebar-menu">
                
                <!-- Groupe de menu ADMIN -->
                <div class="menu-group">
                    <div class="menu-group-title">Admin</div>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="dashboard.html" class="menu-link active">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 4C3 3.44772 3.44772 3 4 3H6C6.55228 3 7 3.44772 7 4V6C7 6.55228 6.55228 7 6 7H4C3.44772 7 3 6.55228 3 6V4Z" fill="currentColor"/>
                                    <path d="M3 10C3 9.44772 3.44772 9 4 9H6C6.55228 9 7 9.44772 7 10V16C7 16.5523 6.55228 17 6 17H4C3.44772 17 3 16.5523 3 16V10Z" fill="currentColor"/>
                                    <path d="M10 3C9.44772 3 9 3.44772 9 4V16C9 16.5523 9.44772 17 10 17H12C12.5523 17 13 16.5523 13 16V4C13 3.44772 12.5523 3 12 3H10Z" fill="currentColor"/>
                                    <path d="M15 3C14.4477 3 14 3.44772 14 4V10C14 10.5523 14.4477 11 15 11H17C17.5523 11 18 10.5523 18 10V4C18 3.44772 17.5523 3 17 3H15Z" fill="currentColor"/>
                                    <path d="M15 13C14.4477 13 14 13.4477 14 14V16C14 16.5523 14.4477 17 15 17H17C17.5523 17 18 16.5523 18 16V14C18 13.4477 17.5523 13 17 13H15Z" fill="currentColor"/>
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="products.html" class="menu-link">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5 3C4.44772 3 4 3.44772 4 4V6C4 6.26522 4.10536 6.51957 4.29289 6.70711L8.58579 11L4.29289 15.2929C4.10536 15.4804 4 15.7348 4 16V18C4 18.5523 4.44772 19 5 19H15C15.5523 19 16 18.5523 16 18V16C16 15.7348 15.8946 15.4804 15.7071 15.2929L11.4142 11L15.7071 6.70711C15.8946 6.51957 16 6.26522 16 6V4C16 3.44772 15.5523 3 15 3H5Z" fill="currentColor"/>
                                </svg>
                                <span>Produits</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="users.html" class="menu-link">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7 8C8.65685 8 10 6.65685 10 5C10 3.34315 8.65685 2 7 2C5.34315 2 4 3.34315 4 5C4 6.65685 5.34315 8 7 8Z" fill="currentColor"/>
                                    <path d="M14 8C15.6569 8 17 6.65685 17 5C17 3.34315 15.6569 2 14 2C12.3431 2 11 3.34315 11 5C11 6.65685 12.3431 8 14 8Z" fill="currentColor"/>
                                    <path d="M0 16C0 13.7909 1.79086 12 4 12H10C12.2091 12 14 13.7909 14 16V18C14 18.5523 13.5523 19 13 19H1C0.447715 19 0 18.5523 0 18V16Z" fill="currentColor"/>
                                    <path d="M16 16C16 14.3431 17.3431 13 19 13H19.5C19.7761 13 20 13.2239 20 13.5V18.5C20 18.7761 19.7761 19 19.5 19H19C17.3431 19 16 17.6569 16 16Z" fill="currentColor"/>
                                </svg>
                                <span>Utilisateurs</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="predictions.html" class="menu-link">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 12C2 7.58172 5.58172 4 10 4C14.4183 4 18 7.58172 18 12V18H2V12Z" fill="currentColor"/>
                                    <path d="M10 2C10.5523 2 11 2.44772 11 3V5C11 5.55228 10.5523 6 10 6C9.44772 6 9 5.55228 9 5V3C9 2.44772 9.44772 2 10 2Z" fill="currentColor"/>
                                    <path d="M15.5355 4.46447C15.9261 4.85499 16.5592 4.85499 16.9497 4.46447C17.3403 4.07394 17.3403 3.44078 16.9497 3.05025L15.1213 1.22183C14.7308 0.831305 14.0976 0.831305 13.7071 1.22183C13.3166 1.61235 13.3166 2.24552 13.7071 2.63604L15.5355 4.46447Z" fill="currentColor"/>
                                    <path d="M4.46447 4.46447C4.07394 4.85499 3.44078 4.85499 3.05025 4.46447L1.22183 2.63604C0.831305 2.24552 0.831305 1.61235 1.22183 1.22183C1.61235 0.831305 2.24552 0.831305 2.63604 1.22183L4.46447 3.05025C4.85499 3.44078 4.85499 4.07394 4.46447 4.46447Z" fill="currentColor"/>
                                </svg>
                                <span>Prédictions</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="orders.html" class="menu-link">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 1H3L3.4 3M5 11H15L19 3H3.4M5 11L3.4 3M5 11L2.70711 13.2929C2.07714 13.9229 2.52331 15 3.41421 15H15M15 15C13.8954 15 13 15.8954 13 17C13 18.1046 13.8954 19 15 19C16.1046 19 17 18.1046 17 17C17 15.8954 16.1046 15 15 15ZM7 17C7 18.1046 6.10457 19 5 19C3.89543 19 3 18.1046 3 17C3 15.8954 3.89543 15 5 15C6.10457 15 7 15.8954 7 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <span>Commandes</span>
                                <span class="menu-badge">3</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Groupe de menu ANALYSE -->
                <div class="menu-group">
                    <div class="menu-group-title">Analyse</div>
                    <ul class="menu-list">
                        <li class="menu-item">
                            <a href="reports.html" class="menu-link">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 3V17H17V3H3ZM15 15H5V5H15V15Z" fill="currentColor"/>
                                    <path d="M7 7H9V13H7V7Z" fill="currentColor"/>
                                    <path d="M11 9H13V13H11V9Z" fill="currentColor"/>
                                </svg>
                                <span>Rapports</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="analytics.html" class="menu-link">
                                <svg class="menu-icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 2V16H18V18H2C0.895431 18 0 17.1046 0 16V2H2Z" fill="currentColor"/>
                                    <path d="M5 9C4.44772 9 4 9.44772 4 10V16C4 16.5523 4.44772 17 5 17H7C7.55228 17 8 16.5523 8 16V10C8 9.44772 7.55228 9 7 9H5Z" fill="currentColor"/>
                                    <path d="M9 6C8.44772 6 8 6.44772 8 7V16C8 16.5523 8.44772 17 9 17H11C11.5523 17 12 16.5523 12 16V7C12 6.44772 11.5523 6 11 6H9Z" fill="currentColor"/>
                                    <path d="M13 3C12.4477 3 12 3.44772 12 4V16C12 16.5523 12.4477 17 13 17H15C15.5523 17 16 16.5523 16 16V4C16 3.44772 15.5523 3 15 3H13Z" fill="currentColor"/>
                                </svg>
                                <span>Analytiques</span>
                            </a>
                        </li>
                    </ul>
                </div>
                
            </nav>
            
            <!-- Pied de la sidebar avec bouton déconnexion -->
            <div class="sidebar-footer">
                <button class="logout-btn">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 16H3C2.46957 16 1.96086 15.7893 1.58579 15.4142C1.21071 15.0391 1 14.5304 1 14V4C1 3.46957 1.21071 2.96086 1.58579 2.58579C1.96086 2.21071 2.46957 2 3 2H7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13 12L17 8L13 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M17 8H7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <span>Déconnexion</span>
                </button>
            </div>
            
        </aside>
        
        <!-- CONTENU PRINCIPAL -->
        <main class="main-content">
            
            <!-- En-tête de la page avec onglets -->
            <header class="page-header">
                
                <div class="header-left">
                    <button class="sidebar-toggle" aria-label="Toggle sidebar">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 5H17M3 10H17M3 15H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    
                    <!-- Onglets de navigation -->
                    <div class="header-tabs">
                        <button class="header-tab active">ADMIN</button>
                        <button class="header-tab">BOUTIQUE</button>
                    </div>
                </div>
                
                <!-- Actions et profil utilisateur -->
                <div class="header-actions">
                    <div class="notifications">
                        <button class="notification-btn" aria-label="Notifications">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2C7.23858 2 5 4.23858 5 7V10.5858L3.29289 12.2929C3.10536 12.4804 3 12.7348 3 13V15C3 15.5523 3.44772 16 4 16H16C16.5523 16 17 15.5523 17 15V13C17 12.7348 16.8946 12.4804 16.7071 12.2929L15 10.5858V7C15 4.23858 12.7614 2 10 2Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 17C8 17.5523 8.44772 18 9 18H11C11.5523 18 12 17.5523 12 17V17H8V17Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span class="notification-badge">5</span>
                        </button>
                    </div>
                    
                    <div class="user-profile">
                        <div class="user-avatar">U</div>
                        <div class="user-info">
                            <div class="user-name">Utilisateur</div>
                            <div class="user-role">Administrateur</div>
                        </div>
                        <span class="dropdown-icon">▼</span>
                    </div>
                </div>
                
            </header>
            
            <!-- Conteneur de page avec contenu -->
            <div class="page-container">
                
                <!-- Titre de la page -->
                <div class="page-title-section">
                    <h1 class="dashboard-title">Tableau de Bord</h1>
                    <p class="dashboard-subtitle">Aperçu de la performance de votre boutique</p>
                </div>
                
                <!-- ===== CARTES STATISTIQUES ===== -->
                <div class="stats-grid">
                    
                    <!-- Carte Nouveaux Clients -->
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Nouveaux clients</span>
                            <div class="stat-card-icon primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" fill="currentColor"/>
                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">1,234</div>
                        <div class="stat-card-footer">
                            <span class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 2L10 6L7.5 6L7.5 10L4.5 10L4.5 6L2 6L6 2Z" fill="currentColor"/>
                                </svg>
                                12.5%
                            </span>
                            <span class="color-text-muted">vs mois dernier</span>
                        </div>
                    </div>
                    
                    <!-- Carte Nouveaux Produits -->
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Nouveaux produits</span>
                            <div class="stat-card-icon success">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 7H16V4C16 2.89543 15.1046 2 14 2H10C8.89543 2 8 2.89543 8 4V7H4C2.89543 7 2 7.89543 2 9V19C2 20.1046 2.89543 21 4 21H20C21.1046 21 22 20.1046 22 19V9C22 7.89543 21.1046 7 20 7ZM10 4H14V7H10V4ZM20 19H4V9H20V19Z" fill="currentColor"/>
                                    <path d="M12 11C10.8954 11 10 11.8954 10 13C10 14.1046 10.8954 15 12 15C13.1046 15 14 14.1046 14 13C14 11.8954 13.1046 11 12 11Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">89</div>
                        <div class="stat-card-footer">
                            <span class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 2L10 6L7.5 6L7.5 10L4.5 10L4.5 6L2 6L6 2Z" fill="currentColor"/>
                                </svg>
                                8.2%
                            </span>
                            <span class="color-text-muted">vs mois dernier</span>
                        </div>
                    </div>
                    
                    <!-- Carte Nouvelles Ventes -->
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Nouvelles ventes</span>
                            <div class="stat-card-icon warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
                                    <path d="M12 7C11.45 7 11 7.45 11 8V13C11 13.55 11.45 14 12 14C12.55 14 13 13.55 13 13V8C13 7.45 12.55 7 12 7ZM11 15C11 15.55 11.45 16 12 16C12.55 16 13 15.55 13 15C13 14.45 12.55 14 12 14C11.45 14 11 14.45 11 15Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">567</div>
                        <div class="stat-card-footer">
                            <span class="stat-trend negative">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10L2 6L4.5 6L4.5 2L7.5 2L7.5 6L10 6L6 10Z" fill="currentColor"/>
                                </svg>
                                3.1%
                            </span>
                            <span class="color-text-muted">vs mois dernier</span>
                        </div>
                    </div>
                    
                    <!-- Carte Revenus -->
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Revenus totaux</span>
                            <div class="stat-card-icon accent">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM12 20C7.59 20 4 16.41 4 12C4 7.59 7.59 4 12 4C16.41 4 20 7.59 20 12C20 16.41 16.41 20 12 20Z" fill="currentColor"/>
                                    <path d="M12.5 7.5H11V13L16.2 15.9L16.9 14.7L12.5 12.2V7.5Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">103M XAF</div>
                        <div class="stat-card-footer">
                            <span class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 2L10 6L7.5 6L7.5 10L4.5 10L4.5 6L2 6L6 2Z" fill="currentColor"/>
                                </svg>
                                15.3%
                            </span>
                            <span class="color-text-muted">vs mois dernier</span>
                        </div>
                    </div>
                    
                </div>
                
                <!-- SECTION GRAPHIQUE PRINCIPAL -->
                <div class="section">
                    <div class="section-header">
                        <h2 class="section-title">Performance des Ventes</h2>
                        <div class="section-actions">
                            <div class="chart-filter">
                                <button class="chart-filter-btn">Jour</button>
                                <button class="chart-filter-btn active">Mois</button>
                                <button class="chart-filter-btn">Année</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="chart-card">
                        <div class="chart-container">
                            <!-- Placeholder pour le graphique JavaScript -->
                            <div class="chart-placeholder">
                                <div class="chart-placeholder-content">
                                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 60L20 45L30 50L40 35L50 40L60 25L70 30" stroke="var(--color-primary)" stroke-width="3" stroke-linecap="round"/>
                                        <path d="M10 60L20 45L30 50L40 35L50 40L60 25L70 30" stroke="var(--color-secondary)" stroke-width="3" stroke-linecap="round" stroke-dasharray="4 4"/>
                                    </svg>
                                    <p>Graphique des performances</p>
                                    <p class="chart-placeholder-subtitle">Données en temps réel</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Légende du graphique -->
                        <div class="chart-legend">
                            <div class="legend-item">
                                <div class="legend-color primary"></div>
                                <span>Ventes 2023</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color secondary"></div>
                                <span>Ventes 2024</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- SECTION TABLEAU DES PRODUITS POPULAIRES -->
                <div class="section">
                    <h2 class="section-title">Produits Populaires</h2>
                    
                    <div class="table-card">
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th>Catégorie</th>
                                        <th>Prix</th>
                                        <th>Ventes</th>
                                        <th>Stock</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <div class="product-avatar">P1</div>
                                                <div class="product-details">
                                                    <div class="product-name">Smartphone X1</div>
                                                    <div class="product-sku">SKU: SM-X1-2024</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Électronique</td>
                                        <td>250,000 XAF</td>
                                        <td>156</td>
                                        <td>
                                            <div class="stock-info">
                                                <div class="stock-bar">
                                                    <div class="stock-progress" style="width: 75%"></div>
                                                </div>
                                                <span>45/60</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge success">En stock</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <div class="product-avatar">P2</div>
                                                <div class="product-details">
                                                    <div class="product-name">Casque Audio Pro</div>
                                                    <div class="product-sku">SKU: CA-PRO-24</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Audio</td>
                                        <td>85,000 XAF</td>
                                        <td>89</td>
                                        <td>
                                            <div class="stock-info">
                                                <div class="stock-bar">
                                                    <div class="stock-progress" style="width: 30%"></div>
                                                </div>
                                                <span>15/50</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge warning">Stock faible</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <div class="product-avatar">P3</div>
                                                <div class="product-details">
                                                    <div class="product-name">Montre Connectée</div>
                                                    <div class="product-sku">SKU: MC-S4-2024</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>Wearables</td>
                                        <td>120,000 XAF</td>
                                        <td>203</td>
                                        <td>
                                            <div class="stock-info">
                                                <div class="stock-bar">
                                                    <div class="stock-progress" style="width: 90%"></div>
                                                </div>
                                                <span>90/100</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge success">En stock</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
                <!-- SECTION DOUBLE COLONNE -->
                <div class="two-column-grid">
                    
                    <!-- COLONNE GAUCHE -->
                    <div class="column">
                        
                        <!-- ACTIONS RAPIDES -->
                        <div class="section">
                            <h2 class="section-title">Actions Rapides</h2>
                            
                            <div class="quick-actions">
                                <button class="quick-action-btn">
                                    <div class="quick-action-icon primary">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5C10.5523 5 11 4.55228 11 4C11 3.44772 10.5523 3 10 3C9.44772 3 9 3.44772 9 4C9 4.55228 9.44772 5 10 5Z" fill="currentColor"/>
                                            <path d="M10 9C9.44772 9 9 9.44772 9 10C9 10.5523 9.44772 11 10 11C10.5523 11 11 10.5523 11 10C11 9.44772 10.5523 9 10 9Z" fill="currentColor"/>
                                            <path d="M10 15C9.44772 15 9 15.4477 9 16C9 16.5523 9.44772 17 10 17C10.5523 17 11 16.5523 11 16C11 15.4477 10.5523 15 10 15Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    <span class="quick-action-label">Ajouter Produit</span>
                                </button>
                                <button class="quick-action-btn">
                                    <div class="quick-action-icon success">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5C10.5523 5 11 4.55228 11 4C11 3.44772 10.5523 3 10 3C9.44772 3 9 3.44772 9 4C9 4.55228 9.44772 5 10 5Z" fill="currentColor"/>
                                            <path d="M10 9C9.44772 9 9 9.44772 9 10C9 10.5523 9.44772 11 10 11C10.5523 11 11 10.5523 11 10C11 9.44772 10.5523 9 10 9Z" fill="currentColor"/>
                                            <path d="M10 15C9.44772 15 9 15.4477 9 16C9 16.5523 9.44772 17 10 17C10.5523 17 11 16.5523 11 16C11 15.4477 10.5523 15 10 15Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    <span class="quick-action-label">Nouvelle Commande</span>
                                </button>
                                <button class="quick-action-btn">
                                    <div class="quick-action-icon warning">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5C10.5523 5 11 4.55228 11 4C11 3.44772 10.5523 3 10 3C9.44772 3 9 3.44772 9 4C9 4.55228 9.44772 5 10 5Z" fill="currentColor"/>
                                            <path d="M10 9C9.44772 9 9 9.44772 9 10C9 10.5523 9.44772 11 10 11C10.5523 11 11 10.5523 11 10C11 9.44772 10.5523 9 10 9Z" fill="currentColor"/>
                                            <path d="M10 15C9.44772 15 9 15.4477 9 16C9 16.5523 9.44772 17 10 17C10.5523 17 11 16.5523 11 16C11 15.4477 10.5523 15 10 15Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    <span class="quick-action-label">Gérer Stock</span>
                                </button>
                                <button class="quick-action-btn">
                                    <div class="quick-action-icon accent">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 5C10.5523 5 11 4.55228 11 4C11 3.44772 10.5523 3 10 3C9.44772 3 9 3.44772 9 4C9 4.55228 9.44772 5 10 5Z" fill="currentColor"/>
                                            <path d="M10 9C9.44772 9 9 9.44772 9 10C9 10.5523 9.44772 11 10 11C10.5523 11 11 10.5523 11 10C11 9.44772 10.5523 9 10 9Z" fill="currentColor"/>
                                            <path d="M10 15C9.44772 15 9 15.4477 9 16C9 16.5523 9.44772 17 10 17C10.5523 17 11 16.5523 11 16C11 15.4477 10.5523 15 10 15Z" fill="currentColor"/>
                                        </svg>
                                    </div>
                                    <span class="quick-action-label">Générer Rapport</span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- ACTIVITÉ RÉCENTE -->
                        <div class="section">
                            <h2 class="section-title">Activité Récente</h2>
                            
                            <div class="activity-list">
                                <div class="activity-item">
                                    <div class="activity-icon success">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M13 4L6 11L3 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Nouvelle commande #1245</div>
                                        <div class="activity-description">Commande passée par Jean Dupont</div>
                                        <div class="activity-time">Il y a 5 min</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon primary">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 3V13M13 8H3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Produit ajouté</div>
                                        <div class="activity-description">Nouveau smartphone ajouté au catalogue</div>
                                        <div class="activity-time">Il y a 1 heure</div>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon warning">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 6V8M8 10H8.01M14 8C14 11.3137 11.3137 14 8 14C4.68629 14 2 11.3137 2 8C2 4.68629 4.68629 2 8 2C11.3137 2 14 4.68629 14 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                        </svg>
                                    </div>
                                    <div class="activity-content">
                                        <div class="activity-title">Stock faible</div>
                                        <div class="activity-description">Casque Audio Pro - Seulement 15 unités</div>
                                        <div class="activity-time">Il y a 2 heures</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <!-- COLONNE DROITE -->
                    <div class="column">
                        
                        <!-- STATISTIQUES DE PERFORMANCE -->
                        <div class="section">
                            <h2 class="section-title">Performance</h2>
                            
                            <div class="performance-stats">
                                <div class="performance-item">
                                    <div class="performance-label">Taux de conversion</div>
                                    <div class="performance-value">3.2%</div>
                                    <div class="performance-bar">
                                        <div class="performance-progress" style="width: 65%"></div>
                                    </div>
                                </div>
                                <div class="performance-item">
                                    <div class="performance-label">Panier moyen</div>
                                    <div class="performance-value">45,200 XAF</div>
                                    <div class="performance-bar">
                                        <div class="performance-progress" style="width: 80%"></div>
                                    </div>
                                </div>
                                <div class="performance-item">
                                    <div class="performance-label">Clients actifs</div>
                                    <div class="performance-value">78%</div>
                                    <div class="performance-bar">
                                        <div class="performance-progress" style="width: 78%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- OBJECTIFS -->
                        <div class="section">
                            <h2 class="section-title">Objectifs du Mois</h2>
                            
                            <div class="goals-list">
                                <div class="goal-item">
                                    <div class="goal-info">
                                        <div class="goal-title">Ventes mensuelles</div>
                                        <div class="goal-progress">75%</div>
                                    </div>
                                    <div class="goal-bar">
                                        <div class="goal-progress-bar" style="width: 75%"></div>
                                    </div>
                                </div>
                                <div class="goal-item">
                                    <div class="goal-info">
                                        <div class="goal-title">Nouveaux clients</div>
                                        <div class="goal-progress">60%</div>
                                    </div>
                                    <div class="goal-bar">
                                        <div class="goal-progress-bar" style="width: 60%"></div>
                                    </div>
                                </div>
                                <div class="goal-item">
                                    <div class="goal-info">
                                        <div class="goal-title">Satisfaction client</div>
                                        <div class="goal-progress">90%</div>
                                    </div>
                                    <div class="goal-bar">
                                        <div class="goal-progress-bar" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
            
        </main>
        
    </div>
    
    <!-- SCRIPTS JAVASCRIPT -->
    <script>
        
            // Configuration et initialisation du graphique
        document.addEventListener('DOMContentLoaded', function() {
            // Sélection du conteneur du graphique
            const chartContainer = document.querySelector('.chart-placeholder');
            
            // Création du canvas pour le graphique
            const canvas = document.createElement('canvas');
            canvas.id = 'salesChart';
            canvas.width = chartContainer.offsetWidth;
            canvas.height = chartContainer.offsetHeight;
            
            // Remplacement du placeholder par le canvas
            chartContainer.innerHTML = '';
            chartContainer.appendChild(canvas);
            
            // Données pour le graphique (exemple avec données pour 12 mois)
            const months = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
            
            // Données de ventes pour 2023 et 2024 (exemple)
            const sales2023 = [120, 150, 180, 200, 250, 300, 350, 320, 280, 260, 300, 350];
            const sales2024 = [140, 170, 210, 230, 280, 330, 380, 360, 310, 290, 340, 390];
            
            // Configuration du graphique
            const ctx = document.getElementById('salesChart').getContext('2d');
            const salesChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Ventes 2023',
                            data: sales2023,
                            borderColor: 'var(--color-primary)',
                            backgroundColor: 'rgba(79, 70, 229, 0.1)',
                            borderWidth: 3,
                            fill: true,
                            tension: 0.4
                        },
                        {
                            label: 'Ventes 2024',
                            data: sales2024,
                            borderColor: 'var(--color-secondary)',
                            backgroundColor: 'rgba(236, 72, 153, 0.1)',
                            borderWidth: 3,
                            borderDash: [5, 5],
                            fill: true,
                            tension: 0.4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false // Nous avons notre propre légende
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleColor: '#fff',
                            bodyColor: '#fff',
                            borderColor: 'rgba(255, 255, 255, 0.1)',
                            borderWidth: 1,
                            padding: 12,
                            callbacks: {
                                label: function(context) {
                                    return `${context.dataset.label}: ${context.parsed.y} ventes`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: 'var(--color-text-muted)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                color: 'var(--color-text-muted)',
                                callback: function(value) {
                                    return value;
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        axis: 'x',
                        intersect: false
                    },
                    elements: {
                        point: {
                            radius: 4,
                            hoverRadius: 6
                        }
                    }
                }
            });
            
            // Gestion des filtres de période
            const filterButtons = document.querySelectorAll('.chart-filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Retirer la classe active de tous les boutons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    
                    // Ajouter la classe active au bouton cliqué
                    this.classList.add('active');
                    
                    // Mettre à jour les données en fonction de la période sélectionnée
                    updateChartData(this.textContent.trim());
                });
            });
            
            // Fonction pour mettre à jour les données du graphique selon la période
            function updateChartData(period) {
                let newLabels, newData2023, newData2024;
                
                switch(period) {
                    case 'Jour':
                        // Données pour les 7 derniers jours
                        newLabels = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];
                        newData2023 = [45, 52, 38, 65, 72, 58, 48];
                        newData2024 = [50, 58, 45, 70, 78, 65, 55];
                        break;
                        
                    case 'Mois':
                        // Données pour les 12 mois (défaut)
                        newLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Août', 'Sep', 'Oct', 'Nov', 'Déc'];
                        newData2023 = [120, 150, 180, 200, 250, 300, 350, 320, 280, 260, 300, 350];
                        newData2024 = [140, 170, 210, 230, 280, 330, 380, 360, 310, 290, 340, 390];
                        break;
                        
                    case 'Année':
                        // Données pour les 5 dernières années
                        newLabels = ['2020', '2021', '2022', '2023', '2024'];
                        newData2023 = [2800, 3200, 3500, 3800, 0]; // 2024 n'a pas de données pour 2023
                        newData2024 = [0, 0, 0, 0, 4200]; // Seulement 2024 a des données pour 2024
                        break;
                }
                
                // Mise à jour du graphique
                salesChart.data.labels = newLabels;
                salesChart.data.datasets[0].data = newData2023;
                salesChart.data.datasets[1].data = newData2024;
                salesChart.update();
            }
            
            // Redimensionnement du graphique lors du redimensionnement de la fenêtre
            window.addEventListener('resize', function() {
                salesChart.resize();
            });
        });
    </script>
    
</body>
@endsection