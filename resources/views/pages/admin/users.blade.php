
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gestion des utilisateurs">
    <title>Gestion des Utilisateurs - Administration</title>
    

    <!-- Fichiers CSS dans l'ordre d'importance -->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/users.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>

@section('title', 'Admin- Shopecart')

@section('content')
<body>
    
    <div class="app-container">
        
        <!-- Sidebar -->
        <aside class="sidebar">
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
            
            <nav class="sidebar-menu">
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
            </nav>
            
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
        
        <!-- Contenu principal -->
        <main class="main-content">
            
            <!-- Header -->
            <header class="page-header">
                <div class="header-left">
                    <button class="sidebar-toggle" aria-label="Toggle sidebar">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 5H17M3 10H17M3 15H17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </button>
                    
                    <div class="header-tabs">
                        <button class="header-tab">ADMIN</button>
                        <button class="header-tab active">BOUTIQUE</button>
                    </div>
                </div>
                
                <div class="header-actions">
                    <div class="notifications">
                        <button class="notification-btn" aria-label="Notifications">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 2C7.23858 2 5 4.23858 5 7V10.5858L3.29289 12.2929C3.10536 12.4804 3 12.7348 3 13V15C3 15.5523 3.44772 16 4 16H16C16.5523 16 17 15.5523 17 15V13C17 12.7348 16.8946 12.4804 16.7071 12.2929L15 10.5858V7C15 4.23858 12.7614 2 10 2Z" stroke="currentColor" stroke-width="2"/>
                                <path d="M8 17C8 17.5523 8.44772 18 9 18H11C11.5523 18 12 17.5523 12 17V17H8V17Z" stroke="currentColor" stroke-width="2"/>
                            </svg>
                            <span class="notification-badge">3</span>
                        </button>
                    </div>
                    
                    <div class="user-profile">
                        <div class="user-avatar">A</div>
                        <div class="user-info">
                            <div class="user-name">Admin</div>
                            <div class="user-role">Administrateur</div>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Contenu de la page -->
            <div class="page-container">
                
                <!-- En-tête utilisateurs -->
                <div class="users-header">
                    <div class="page-title-section">
                        <h1 class="users-title">Gestion des Utilisateurs</h1>
                        <p class="users-subtitle">Gérez les comptes utilisateurs et leurs permissions</p>
                    </div>
                    <div class="users-actions">
                        <button class="btn btn-primary" id="addUserBtn">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 3V13M13 8H3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <span>Nouvel utilisateur</span>
                        </button>
                        <button class="btn btn-outline">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 10V12.6667C14 13.0203 13.8595 13.3594 13.6095 13.6095C13.3594 13.8595 13.0203 14 12.6667 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.3333 6.66667L8 10L4.66667 6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 10V2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Exporter</span>
                        </button>
                    </div>
                </div>
                
                <!-- Cartes statistiques -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Utilisateurs totaux</span>
                            <div class="stat-card-icon primary">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" fill="currentColor"/>
                                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" fill="currentColor"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">1,247</div>
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
                    
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Nouveaux utilisateurs</span>
                            <div class="stat-card-icon success">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 6V12L16 14M22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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
                            <span class="color-text-muted">ce mois-ci</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Utilisateurs actifs</span>
                            <div class="stat-card-icon accent">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9 12L11 14L15 10M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">856</div>
                        <div class="stat-card-footer">
                            <span class="stat-trend positive">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 2L10 6L7.5 6L7.5 10L4.5 10L4.5 6L2 6L6 2Z" fill="currentColor"/>
                                </svg>
                                5.3%
                            </span>
                            <span class="color-text-muted">en ligne</span>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-card-header">
                            <span class="stat-card-label">Taux d'engagement</span>
                            <div class="stat-card-icon warning">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-card-value">68%</div>
                        <div class="stat-card-footer">
                            <span class="stat-trend negative">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 10L2 6L4.5 6L4.5 2L7.5 2L7.5 6L10 6L6 10Z" fill="currentColor"/>
                                </svg>
                                2.1%
                            </span>
                            <span class="color-text-muted">vs mois dernier</span>
                        </div>
                    </div>
                </div>
                
                <!-- Barre d'outils -->
                <div class="users-toolbar">
                    <div class="toolbar-top">
                        <div class="toolbar-search">
                            <div class="search-bar">
                                <svg class="search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 14L11.1 11.1M12.6667 7.33333C12.6667 10.2789 10.2789 12.6667 7.33333 12.6667C4.38781 12.6667 2 10.2789 2 7.33333C2 4.38781 4.38781 2 7.33333 2C10.2789 2 12.6667 4.38781 12.6667 7.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <input type="text" class="search-input" placeholder="Rechercher un utilisateur...">
                            </div>
                        </div>
                        
                        <div class="toolbar-filters">
                            <div class="filter-group">
                                <select class="form-select form-select-sm">
                                    <option value="">Tous les rôles</option>
                                    <option value="admin">Administrateur</option>
                                    <option value="moderator">Livreur</option>
                                    <option value="user">Vendeur</option>
                                    <option value="customer">Client</option>
                                </select>
                                
                                <select class="form-select form-select-sm">
                                    <option value="">Tous les statuts</option>
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="suspended">Suspendu</option>
                                </select>
                                
                                <button class="btn btn-sm btn-secondary">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.8333 1H1.16667C0.522333 1 1.04321e-06 1.52233 1.04321e-06 2.16667V3.5C1.04321e-06 3.86833 0.158 4.20167 0.408333 4.42633L4.08333 7.75967C4.33367 7.98433 4.5 8.31767 4.5 8.686V12.8333C4.5 13.0153 4.58833 13.1847 4.73533 13.2853C4.823 13.345 4.92567 13.375 5.029 13.375C5.11767 13.375 5.20633 13.355 5.28767 13.3147L7.95433 12.0313C8.27967 11.881 8.5 11.556 8.5 11.196V8.686C8.5 8.31767 8.66633 7.98433 8.91667 7.75967L12.5917 4.42633C12.842 4.20167 13 3.86833 13 3.5V2.16667C13 1.52233 12.4777 1 11.8333 1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Filtrer</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions en masse -->
                <div class="bulk-actions hidden" id="bulkActions">
                    <span class="bulk-actions-text">
                        <strong id="selectedCount">0</strong> utilisateurs sélectionnés
                    </span>
                    <div class="bulk-actions-buttons">
                        <button class="btn btn-sm btn-secondary">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.5 1.5H2.5C1.94772 1.5 1.5 1.94772 1.5 2.5V11.5C1.5 12.0523 1.94772 12.5 2.5 12.5H11.5C12.0523 12.5 12.5 12.0523 12.5 11.5V2.5C12.5 1.94772 12.0523 1.5 11.5 1.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.5 6.5H9.5M4.5 9.5H7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                            <span>Modifier</span>
                        </button>
                        <button class="btn btn-sm btn-danger">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.75 3.5H2.91667H12.25" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.66667 3.5V2.33333C4.66667 2.02392 4.78958 1.72718 5.00838 1.50838C5.22718 1.28958 5.52392 1.16667 5.83333 1.16667H8.16667C8.47608 1.16667 8.77282 1.28958 8.99162 1.50838C9.21042 1.72718 9.33333 2.02392 9.33333 2.33333V3.5M11.0833 3.5V11.6667C11.0833 11.9761 10.9604 12.2728 10.7416 12.4916C10.5228 12.7104 10.2261 12.8333 9.91667 12.8333H4.08333C3.77392 12.8333 3.47718 12.7104 3.25838 12.4916C3.03958 12.2728 2.91667 11.9761 2.91667 11.6667V3.5H11.0833Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Supprimer</span>
                        </button>
                    </div>
                </div>
                
                <!-- Tableau des utilisateurs -->
                <div class="users-table-container">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">
                                    <input type="checkbox" class="user-checkbox" id="selectAll">
                                </th>
                                <th>Utilisateur</th>
                                <th>Rôle</th>
                                <th>Statut</th>
                                <th>Dernière connexion</th>
                                <th>Date d'inscription</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" class="user-checkbox" data-id="1">
                                </td>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-small primary">MJ</div>
                                        <div class="user-details">
                                            <div class="user-name">Marie Johnson</div>
                                            <div class="user-email">marie.johnson@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-admin">Administrateur</span>
                                </td>
                                <td>
                                    <span class="status-badge success">Actif</span>
                                </td>
                                <td>
                                    <span class="user-date">Aujourd'hui, 14:30</span>
                                </td>
                                <td>
                                    <span class="user-date">15 Jan 2024</span>
                                </td>
                                <td>
                                    <div class="user-actions">
                                        <button class="action-btn action-btn-edit" title="Modifier">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="action-btn action-btn-delete" title="Supprimer">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <input type="checkbox" class="user-checkbox" data-id="2">
                                </td>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-small secondary">PD</div>
                                        <div class="user-details">
                                            <div class="user-name">Pierre Dubois</div>
                                            <div class="user-email">pierre.dubois@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-moderator">Livreur</span>
                                </td>
                                <td>
                                    <span class="status-badge success">Actif</span>
                                </td>
                                <td>
                                    <span class="user-date">Hier, 09:15</span>
                                </td>
                                <td>
                                    <span class="user-date">20 Fév 2024</span>
                                </td>
                                <td>
                                    <div class="user-actions">
                                        <button class="action-btn action-btn-edit" title="Modifier">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="action-btn action-btn-delete" title="Supprimer">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <input type="checkbox" class="user-checkbox" data-id="3">
                                </td>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-small accent">SM</div>
                                        <div class="user-details">
                                            <div class="user-name">Sophie Martin</div>
                                            <div class="user-email">sophie.martin@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-user">Vendeur</span>
                                </td>
                                <td>
                                    <span class="status-badge warning">Inactif</span>
                                </td>
                                <td>
                                    <span class="user-date">05 Mar 2024</span>
                                </td>
                                <td>
                                    <span class="user-date">10 Mar 2024</span>
                                </td>
                                <td>
                                    <div class="user-actions">
                                        <button class="action-btn action-btn-edit" title="Modifier">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="action-btn action-btn-delete" title="Supprimer">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <input type="checkbox" class="user-checkbox" data-id="4">
                                </td>
                                <td>
                                    <div class="user-info-cell">
                                        <div class="user-avatar-small warning">TL</div>
                                        <div class="user-details">
                                            <div class="user-name">Thomas Leroy</div>
                                            <div class="user-email">thomas.leroy@example.com</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="role-badge role-customer">Client</span>
                                </td>
                                <td>
                                    <span class="status-badge error">Suspendu</span>
                                </td>
                                <td>
                                    <span class="user-date">28 Fév 2024</span>
                                </td>
                                <td>
                                    <span class="user-date">15 Fév 2024</span>
                                </td>
                                <td>
                                    <div class="user-actions">
                                        <button class="action-btn action-btn-edit" title="Modifier">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                        <button class="action-btn action-btn-delete" title="Supprimer">
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <!-- Pagination -->
                    <div class="table-footer">
                        <div class="table-info">
                            Affichage de 1 à 4 sur 1,247 utilisateurs
                        </div>
                        
                        <div class="pagination">
                            <button class="pagination-btn" disabled>
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 12L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <button class="pagination-btn active">1</button>
                            <button class="pagination-btn">2</button>
                            <button class="pagination-btn">3</button>
                            <button class="pagination-btn">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
    </div>

    <script>
        //  GESTIONNAIRE D'UTILISATEURS
class UserManager {
    constructor() {
        this.users = this.loadUsersFromStorage();
        this.currentEditId = null;
        this.initEventListeners();
        this.renderUsers();
    }

    //  Chargement depuis le localStorage
    loadUsersFromStorage() {
        const stored = localStorage.getItem('users');
        return stored ? JSON.parse(stored) : [
            {
                id: 1,
                name: "Marie Johnson",
                email: "marie.johnson@example.com",
                role: "admin",
                status: "active",
                lastLogin: "Aujourd'hui, 14:30",
                registrationDate: "15 Jan 2024",
                avatar: "MJ",
                avatarColor: "primary"
            },
            {
                id: 2,
                name: "Pierre Dubois",
                email: "pierre.dubois@example.com",
                role: "moderator",
                status: "active",
                lastLogin: "Hier, 09:15",
                registrationDate: "20 Fév 2024",
                avatar: "PD",
                avatarColor: "secondary"
            },
            {
                id: 3,
                name: "Sophie Martin",
                email: "sophie.martin@example.com",
                role: "user",
                status: "inactive",
                lastLogin: "05 Mar 2024",
                registrationDate: "10 Mar 2024",
                avatar: "SM",
                avatarColor: "accent"
            },
            {
                id: 4,
                name: "Thomas Leroy",
                email: "thomas.leroy@example.com",
                role: "customer",
                status: "suspended",
                lastLogin: "28 Fév 2024",
                registrationDate: "15 Fév 2024",
                avatar: "TL",
                avatarColor: "warning"
            }
        ];
    }

    //  Sauvegarde dans le localStorage
    saveUsersToStorage() {
        localStorage.setItem('users', JSON.stringify(this.users));
    }

    //  Initialisation des événements
    initEventListeners() {
        // Bouton d'ajout d'utilisateur
        const addUserBtn = document.getElementById('addUserBtn');
        if (addUserBtn) {
            addUserBtn.addEventListener('click', () => this.showUserModal());
        }

        // Bouton d'export
        const exportBtn = document.querySelector('.btn-outline');
        if (exportBtn) {
            exportBtn.addEventListener('click', () => this.exportUsers());
        }

        // Filtres
        this.initFilters();

        // Gestion des cases à cocher
        this.initCheckboxes();

        // Actions en masse
        this.initBulkActions();
    }

    //  Initialisation des filtres
    initFilters() {
        const searchInput = document.querySelector('.search-input');
        const roleFilter = document.querySelector('.form-select:first-of-type');
        const statusFilter = document.querySelector('.form-select:last-of-type');
        const filterBtn = document.querySelector('.btn-secondary');

        if (searchInput) searchInput.addEventListener('input', () => this.applyFilters());
        if (roleFilter) roleFilter.addEventListener('change', () => this.applyFilters());
        if (statusFilter) statusFilter.addEventListener('change', () => this.applyFilters());
        if (filterBtn) filterBtn.addEventListener('click', () => this.applyFilters());
    }

    //  Initialisation des cases à cocher
    initCheckboxes() {
        const selectAll = document.getElementById('selectAll');
        const userCheckboxes = document.querySelectorAll('.user-checkbox:not(#selectAll)');

        if (selectAll) {
            selectAll.addEventListener('change', (e) => {
                userCheckboxes.forEach(checkbox => {
                    checkbox.checked = e.target.checked;
                });
                this.updateBulkActions();
            });
        }

        userCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.updateBulkActions();
                this.updateSelectAll();
            });
        });
    }

    //  Initialisation des actions en masse
    initBulkActions() {
        const bulkDeleteBtn = document.querySelector('.bulk-actions-buttons .btn-danger');
        const bulkEditBtn = document.querySelector('.bulk-actions-buttons .btn-secondary');

        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', () => this.deleteSelectedUsers());
        }

        if (bulkEditBtn) {
            bulkEditBtn.addEventListener('click', () => this.editSelectedUsers());
        }
    }

    //  Mise à jour des actions en masse
    updateBulkActions() {
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        const checkedCount = document.querySelectorAll('.user-checkbox:checked:not(#selectAll)').length;

        if (selectedCount) selectedCount.textContent = checkedCount;
        
        if (bulkActions) {
            if (checkedCount > 0) {
                bulkActions.classList.remove('hidden');
            } else {
                bulkActions.classList.add('hidden');
            }
        }
    }

    // Mise à jour de "Tout sélectionner"
    updateSelectAll() {
        const selectAll = document.getElementById('selectAll');
        const checkedCount = document.querySelectorAll('.user-checkbox:checked:not(#selectAll)').length;
        const totalCount = document.querySelectorAll('.user-checkbox:not(#selectAll)').length;

        if (selectAll) {
            if (checkedCount === 0) {
                selectAll.checked = false;
                selectAll.indeterminate = false;
            } else if (checkedCount === totalCount) {
                selectAll.checked = true;
                selectAll.indeterminate = false;
            } else {
                selectAll.checked = false;
                selectAll.indeterminate = true;
            }
        }
    }

    //  CRÉER un utilisateur
    createUser(userData) {
        const newUser = {
            id: Date.now(), // ID unique
            ...userData,
            avatar: this.generateAvatar(userData.name),
            avatarColor: this.getRandomColor(),
            lastLogin: "Jamais",
            registrationDate: new Date().toLocaleDateString('fr-FR', { 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric' 
            })
        };

        this.users.unshift(newUser); // Ajouter au début
        this.saveUsersToStorage();
        this.renderUsers();
        this.showNotification('Utilisateur créé avec succès', 'success');
    }

    //  MODIFIER un utilisateur
    updateUser(userId, userData) {
        const index = this.users.findIndex(u => u.id == userId);
        if (index !== -1) {
            this.users[index] = { 
                ...this.users[index], 
                ...userData,
                avatar: this.generateAvatar(userData.name)
            };
            this.saveUsersToStorage();
            this.renderUsers();
            this.showNotification('Utilisateur modifié avec succès', 'success');
        }
    }

    //  SUPPRIMER un utilisateur
    deleteUser(userId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
            this.users = this.users.filter(u => u.id != userId);
            this.saveUsersToStorage();
            this.renderUsers();
            this.showNotification('Utilisateur supprimé avec succès', 'success');
        }
    }

    //  SUPPRIMER plusieurs utilisateurs
    deleteSelectedUsers() {
        const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked:not(#selectAll)'))
            .map(cb => cb.dataset.id);

        if (selectedUsers.length === 0) {
            this.showNotification('Aucun utilisateur sélectionné', 'error');
            return;
        }

        if (confirm(`Êtes-vous sûr de vouloir supprimer ${selectedUsers.length} utilisateur(s) ?`)) {
            this.users = this.users.filter(u => !selectedUsers.includes(u.id.toString()));
            this.saveUsersToStorage();
            this.renderUsers();
            
            // Réinitialiser les sélections
            const selectAll = document.getElementById('selectAll');
            if (selectAll) selectAll.checked = false;
            this.updateBulkActions();
            
            this.showNotification(`${selectedUsers.length} utilisateur(s) supprimé(s) avec succès`, 'success');
        }
    }

    //  MODIFIER plusieurs utilisateurs
    editSelectedUsers() {
        const selectedUsers = Array.from(document.querySelectorAll('.user-checkbox:checked:not(#selectAll)'))
            .map(cb => cb.dataset.id);

        if (selectedUsers.length === 0) {
            this.showNotification('Aucun utilisateur sélectionné', 'error');
            return;
        }

        this.showBulkEditModal(selectedUsers);
    }

    //  AFFICHER les utilisateurs
    renderUsers() {
        const tbody = document.querySelector('.users-table tbody');
        if (!tbody) return;

        tbody.innerHTML = this.users.map(user => `
            <tr>
                <td>
                    <input type="checkbox" class="user-checkbox" data-id="${user.id}">
                </td>
                <td>
                    <div class="user-info-cell">
                        <div class="user-avatar-small ${user.avatarColor}">${user.avatar}</div>
                        <div class="user-details">
                            <div class="user-name">${user.name}</div>
                            <div class="user-email">${user.email}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="role-badge role-${user.role}">${this.getRoleLabel(user.role)}</span>
                </td>
                <td>
                    <span class="status-badge ${this.getStatusClass(user.status)}">${this.getStatusLabel(user.status)}</span>
                </td>
                <td>
                    <span class="user-date">${user.lastLogin}</span>
                </td>
                <td>
                    <span class="user-date">${user.registrationDate}</span>
                </td>
                <td>
                    <div class="user-actions">
                        <button class="action-btn action-btn-edit" title="Modifier" onclick="userManager.editUser(${user.id})">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button class="action-btn action-btn-delete" title="Supprimer" onclick="userManager.deleteUser(${user.id})">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
        `).join('');

        // Réinitialiser les écouteurs d'événements
        this.initCheckboxes();
        this.updateTableInfo();
    }

    //  ÉDITER un utilisateur
    editUser(userId) {
        const user = this.users.find(u => u.id == userId);
        if (user) {
            this.currentEditId = userId;
            this.showUserModal(user);
        }
    }

    //  MODAL d'utilisateur
    showUserModal(userData = null) {
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class="modal">
                <div class="modal-header">
                    <h3>${userData ? 'Modifier l\'utilisateur' : 'Nouvel utilisateur'}</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="userForm" class="user-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="userName">Nom complet *</label>
                                <input type="text" id="userName" name="name" value="${userData ? userData.name : ''}" required>
                            </div>
                            <div class="form-group">
                                <label for="userEmail">Email *</label>
                                <input type="email" id="userEmail" name="email" value="${userData ? userData.email : ''}" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="userRole">Rôle *</label>
                                <select id="userRole" name="role" required>
                                    <option value="">Sélectionner un rôle</option>
                                    <option value="admin" ${userData && userData.role === 'admin' ? 'selected' : ''}>Administrateur</option>
                                    <option value="moderator" ${userData && userData.role === 'moderator' ? 'selected' : ''}>Livreur</option>
                                    <option value="user" ${userData && userData.role === 'user' ? 'selected' : ''}>Vendeur</option>
                                    <option value="customer" ${userData && userData.role === 'customer' ? 'selected' : ''}>Client</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="userStatus">Statut *</label>
                                <select id="userStatus" name="status" required>
                                    <option value="">Sélectionner un statut</option>
                                    <option value="active" ${userData && userData.status === 'active' ? 'selected' : ''}>Actif</option>
                                    <option value="inactive" ${userData && userData.status === 'inactive' ? 'selected' : ''}>Inactif</option>
                                    <option value="suspended" ${userData && userData.status === 'suspended' ? 'selected' : ''}>Suspendu</option>
                                </select>
                            </div>
                        </div>
                        
                        ${!userData ? `
                        <div class="form-group">
                            <label for="userPassword">Mot de passe *</label>
                            <input type="password" id="userPassword" name="password" required minlength="6">
                            <small class="form-help">Minimum 6 caractères</small>
                        </div>
                        ` : ''}
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelBtn">Annuler</button>
                    <button class="btn btn-primary" id="saveBtn">${userData ? 'Modifier' : 'Créer'}</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Gestion des événements du modal
        const closeModal = () => document.body.removeChild(modal);
        
        modal.querySelector('.modal-close').addEventListener('click', closeModal);
        modal.querySelector('#cancelBtn').addEventListener('click', closeModal);
        
        modal.querySelector('#saveBtn').addEventListener('click', () => {
            const form = modal.querySelector('#userForm');
            if (form.checkValidity()) {
                const formData = new FormData(form);
                const userData = Object.fromEntries(formData);
                
                if (this.currentEditId) {
                    this.updateUser(this.currentEditId, userData);
                    this.currentEditId = null;
                } else {
                    this.createUser(userData);
                }
                closeModal();
            } else {
                form.reportValidity();
            }
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    }

    //  MODAL de modification en masse
    showBulkEditModal(userIds) {
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class="modal">
                <div class="modal-header">
                    <h3>Modifier ${userIds.length} utilisateur(s)</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="bulkUserForm" class="user-form">
                        <div class="form-group">
                            <label for="bulkUserRole">Rôle</label>
                            <select id="bulkUserRole" name="role">
                                <option value="">Ne pas modifier</option>
                                <option value="admin">Administrateur</option>
                                <option value="moderator">Livreur</option>
                                <option value="user">Vendeur</option>
                                <option value="customer">Client</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bulkUserStatus">Statut</label>
                            <select id="bulkUserStatus" name="status">
                                <option value="">Ne pas modifier</option>
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="suspended">Suspendu</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelBtn">Annuler</button>
                    <button class="btn btn-primary" id="saveBtn">Appliquer</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        const closeModal = () => document.body.removeChild(modal);
        
        modal.querySelector('.modal-close').addEventListener('click', closeModal);
        modal.querySelector('#cancelBtn').addEventListener('click', closeModal);
        
        modal.querySelector('#saveBtn').addEventListener('click', () => {
            const form = modal.querySelector('#bulkUserForm');
            const formData = new FormData(form);
            const bulkData = Object.fromEntries(formData);

            // Appliquer les modifications aux utilisateurs sélectionnés
            userIds.forEach(userId => {
                const user = this.users.find(u => u.id == userId);
                if (user) {
                    if (bulkData.role) user.role = bulkData.role;
                    if (bulkData.status) user.status = bulkData.status;
                }
            });

            this.saveUsersToStorage();
            this.renderUsers();
            this.showNotification(`Modifications appliquées à ${userIds.length} utilisateur(s)`, 'success');
            closeModal();
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeModal();
        });
    }

    //  FILTRER les utilisateurs
    applyFilters() {
        const searchTerm = document.querySelector('.search-input')?.value.toLowerCase() || '';
        const roleFilter = document.querySelector('.form-select:first-of-type')?.value || '';
        const statusFilter = document.querySelector('.form-select:last-of-type')?.value || '';

        const rows = document.querySelectorAll('.users-table tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const userName = row.querySelector('.user-name')?.textContent.toLowerCase() || '';
            const userEmail = row.querySelector('.user-email')?.textContent.toLowerCase() || '';
            const userRole = row.querySelector('.role-badge')?.textContent.toLowerCase() || '';
            const userStatus = row.querySelector('.status-badge')?.textContent.toLowerCase() || '';

            const matchesSearch = userName.includes(searchTerm) || userEmail.includes(searchTerm);
            const matchesRole = !roleFilter || userRole.includes(roleFilter.toLowerCase());
            const matchesStatus = !statusFilter || userStatus.includes(statusFilter.toLowerCase());

            if (matchesSearch && matchesRole && matchesStatus) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        this.updateTableInfo(visibleCount);
    }

    //  Mettre à jour les infos du tableau
    updateTableInfo(visibleCount = null) {
        const tableInfo = document.querySelector('.table-info');
        if (tableInfo) {
            const count = visibleCount !== null ? visibleCount : this.users.length;
            tableInfo.textContent = `Affichage de 1 à ${Math.min(count, this.users.length)} sur ${this.users.length} utilisateurs`;
        }
    }

    //  Générer avatar
    generateAvatar(name) {
        return name.split(' ').map(n => n[0]).join('').toUpperCase().substring(0, 2);
    }

    //  Couleur aléatoire pour avatar
    getRandomColor() {
        const colors = ['primary', 'secondary', 'accent', 'warning', 'success'];
        return colors[Math.floor(Math.random() * colors.length)];
    }

    //  Libellés des rôles
    getRoleLabel(role) {
        const roles = {
            'admin': 'Administrateur',
            'moderator': 'Livreur',
            'user': 'Vendeur',
            'customer': 'Client'
        };
        return roles[role] || role;
    }

    //  Libellés des statuts
    getStatusLabel(status) {
        const statuses = {
            'active': 'Actif',
            'inactive': 'Inactif',
            'suspended': 'Suspendu'
        };
        return statuses[status] || status;
    }

    //  Classes CSS pour statuts
    getStatusClass(status) {
        const classes = {
            'active': 'success',
            'inactive': 'warning',
            'suspended': 'error'
        };
        return classes[status] || 'warning';
    }

    //  EXPORTER les utilisateurs
    exportUsers() {
        const dataStr = JSON.stringify(this.users, null, 2);
        const dataBlob = new Blob([dataStr], { type: 'application/json' });
        
        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = `utilisateurs_${new Date().toISOString().split('T')[0]}.json`;
        link.click();
        
        this.showNotification('Export des utilisateurs terminé', 'success');
    }

    //  NOTIFICATIONS
    showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.innerHTML = `
            <div class="notification-content">
                <span class="notification-message">${message}</span>
                <button class="notification-close">&times;</button>
            </div>
        `;

        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#10b981' : type === 'error' ? '#ef4444' : '#3b82f6'};
            color: white;
            padding: 12px 16px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-width: 300px;
        `;

        document.body.appendChild(notification);

        notification.querySelector('.notification-close').addEventListener('click', () => {
            document.body.removeChild(notification);
        });

        setTimeout(() => {
            if (document.body.contains(notification)) {
                document.body.removeChild(notification);
            }
        }, 5000);
    }
}

//  Initialisation
const userManager = new UserManager();

// 🌐 Rendre disponible globalement
window.userManager = userManager;
    </script>
</body>
@endsection