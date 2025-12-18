
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gestion des produits">
    <title>Gestion des Produits - Administration</title>
    
    <!-- Fichiers CSS dans l'ordre d'importance -->
    <link rel="stylesheet" href="{{ asset('assets/css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/products.css') }}">
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
                            <a href="dashboard.html" class="menu-link">
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
                            <a href="products.html" class="menu-link active">
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
                        <button class="header-tab">ADMIN</button>
                        <button class="header-tab active">BOUTIQUE</button>
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
                
                <!-- En-tête de la page produits -->
                <div class="products-header">
                    <div class="page-title-section">
                        <h1 class="products-title">Gestion des Produits</h1>
                        <p class="products-subtitle">Gérez votre catalogue de produits</p>
                    </div>
                    <div class="products-actions">
                        <button class="btn" id="addProductBtn">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M8 3V13M13 8H3" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                            <span>Ajouter un produit</span>
                        </button>
                        <button class="btn">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 10V12.6667C14 13.0203 13.8595 13.3594 13.6095 13.6095C13.3594 13.8595 13.0203 14 12.6667 14H3.33333C2.97971 14 2.64057 13.8595 2.39052 13.6095C2.14048 13.3594 2 13.0203 2 12.6667V10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.3333 6.66667L8 10L4.66667 6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 10V2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Importer</span>
                        </button>
                        <button class="btn">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M14 6V3.33333C14 2.97971 13.8595 2.64057 13.6095 2.39052C13.3594 2.14048 13.0203 2 12.6667 2H3.33333C2.97971 2 2.64057 2.14048 2.39052 2.39052C2.14048 2.64057 2 2.97971 2 3.33333V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.66667 9.33333L8 6L11.3333 9.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8 6V14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span>Exporter</span>
                        </button>
                    </div>
                </div>
                
                <!-- BARRE D'OUTILS DE FILTRAGE -->
                <div class="products-toolbar">
                    <div class="toolbar-top">
                        
                        <!-- Barre de recherche -->
                        <div class="toolbar-search">
                            <div class="search-bar">
                                <svg class="search-icon" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14 14L11.1 11.1M12.6667 7.33333C12.6667 10.2789 10.2789 12.6667 7.33333 12.6667C4.38781 12.6667 2 10.2789 2 7.33333C2 4.38781 4.38781 2 7.33333 2C10.2789 2 12.6667 4.38781 12.6667 7.33333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                </svg>
                                <input type="text" class="search-input" placeholder="Rechercher un produit...">
                            </div>
                        </div>
                        
                        <!-- Filtres et vue -->
                        <div class="toolbar-filters">
                            <div class="filter-group">
                                <select class="form-select form-select-sm">
                                    <option value="">Toutes les catégories</option>
                                    <option value="electronique">Électronique</option>
                                    <option value="vetements">Vêtements</option>
                                    <option value="maison">Maison</option>
                                    <option value="sport">Sport</option>
                                </select>
                                
                                <select class="form-select form-select-sm">
                                    <option value="">Tous les statuts</option>
                                    <option value="active">Actif</option>
                                    <option value="inactive">Inactif</option>
                                    <option value="low-stock">Stock faible</option>
                                </select>
                                
                                <button class="btn btn-sm btn-secondary">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12.8333 1H1.16667C0.522333 1 1.04321e-06 1.52233 1.04321e-06 2.16667V3.5C1.04321e-06 3.86833 0.158 4.20167 0.408333 4.42633L4.08333 7.75967C4.33367 7.98433 4.5 8.31767 4.5 8.686V12.8333C4.5 13.0153 4.58833 13.1847 4.73533 13.2853C4.823 13.345 4.92567 13.375 5.029 13.375C5.11767 13.375 5.20633 13.355 5.28767 13.3147L7.95433 12.0313C8.27967 11.881 8.5 11.556 8.5 11.196V8.686C8.5 8.31767 8.66633 7.98433 8.91667 7.75967L12.5917 4.42633C12.842 4.20167 13 3.86833 13 3.5V2.16667C13 1.52233 12.4777 1 11.8333 1Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    <span>Filtrer</span>
                                </button>
                            </div>
                            
                            <!-- Toggle vue liste/grille -->
                            <div class="view-toggle">
                                <button class="view-toggle-btn active" data-view="list">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2 4H14M2 8H14M2 12H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </button>
                                <button class="view-toggle-btn" data-view="grid">
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6 2H3C2.44772 2 2 2.44772 2 3V6C2 6.55228 2.44772 7 3 7H6C6.55228 7 7 6.55228 7 6V3C7 2.44772 6.55228 2 6 2Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M13 2H10C9.44772 2 9 2.44772 9 3V6C9 6.55228 9.44772 7 10 7H13C13.5523 7 14 6.55228 14 6V3C14 2.44772 13.5523 2 13 2Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M6 9H3C2.44772 9 2 9.44772 2 10V13C2 13.5523 2.44772 14 3 14H6C6.55228 14 7 13.5523 7 13V10C7 9.44772 6.55228 9 6 9Z" stroke="currentColor" stroke-width="1.5"/>
                                        <path d="M13 9H10C9.44772 9 9 9.44772 9 10V13C9 13.5523 9.44772 14 10 14H13C13.5523 14 14 13.5523 14 13V10C14 9.44772 13.5523 9 13 9Z" stroke="currentColor" stroke-width="1.5"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
                <!-- ACTIONS EN MASSE (Masqué par défaut) -->
                <div class="bulk-actions hidden" id="bulkActions">
                    <span class="bulk-actions-text">
                        <strong id="selectedCount">0</strong> produits sélectionnés
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
                
                <!-- TABLEAU DES PRODUITS -->
                <div class="products-table-container" id="productsContainer">
                    
                    <!-- Vue Liste (par défaut) -->
                    <div class="products-list-view" id="listView">
                        <table class="products-table">
                            
                            <!-- En-tête du tableau -->
                            <thead>
                                <tr>
                                    <th style="width: 40px;">
                                        <input type="checkbox" class="product-checkbox" id="selectAll">
                                    </th>
                                    <th>Produit</th>
                                    <th>Prix</th>
                                    <th>Catégorie</th>
                                    <th>Stock</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            
                            <!-- Corps du tableau avec données -->
                            <tbody>
                                
                                <!-- Ligne produit 1 -->
                                <tr>
                                    <td>
                                        <input type="checkbox" class="product-checkbox" data-id="1">
                                    </td>
                                    <td>
                                        <div class="product-info-cell">
                                            <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-thumbnail">
                                            <div class="product-details">
                                                <div class="product-name">MacBook Pro 16"</div>
                                                <div class="product-sku">SKU: PRD001</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="product-price">2 500 000 XAF</span>
                                    </td>
                                    <td>
                                        <span class="product-category">Ordinateurs</span>
                                    </td>
                                    <td>
                                        <div class="stock-info">
                                            <div class="stock-indicator high"></div>
                                            <span>45 unités</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge success">Actif</span>
                                    </td>
                                    <td>
                                        <span class="product-date">10/02/25</span>
                                    </td>
                                    <td>
                                        <div class="product-actions">
                                            <button class="action-btn action-btn-edit" title="Modifier" id="mdf_btn">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                            <button class="action-btn action-btn-delete" title="Supprimer" id = 'rmv_btn'>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Ligne produit 2 -->
                                <tr>
                                    <td>
                                        <input type="checkbox" class="product-checkbox" data-id="2">
                                    </td>
                                    <td>
                                        <div class="product-info-cell">
                                            <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-thumbnail">
                                            <div class="product-details">
                                                <div class="product-name">iPhone 15 Pro</div>
                                                <div class="product-sku">SKU: PRD002</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="product-price">850 000 XAF</span>
                                    </td>
                                    <td>
                                        <span class="product-category">Téléphones</span>
                                    </td>
                                    <td>
                                        <div class="stock-info">
                                            <div class="stock-indicator medium"></div>
                                            <span>22 unités</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge success">Actif</span>
                                    </td>
                                    <td>
                                        <span class="product-date">08/02/25</span>
                                    </td>
                                    <td>
                                        <div class="product-actions">
                                            <button class="action-btn action-btn-edit" title="Modifier" id="mdf_btn">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                            <button class="action-btn action-btn-delete" title="Supprimer" id = 'rmv_btn'>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Ligne produit 3 -->
                                <tr>
                                    <td>
                                        <input type="checkbox" class="product-checkbox" data-id="3">
                                    </td>
                                    <td>
                                        <div class="product-info-cell">
                                            <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-thumbnail">
                                            <div class="product-details">
                                                <div class="product-name">Casque Sony WH-1000XM4</div>
                                                <div class="product-sku">SKU: PRD003</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="product-price">350 000 XAF</span>
                                    </td>
                                    <td>
                                        <span class="product-category">Audio</span>
                                    </td>
                                    <td>
                                        <div class="stock-info">
                                            <div class="stock-indicator low"></div>
                                            <span>8 unités</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge warning">Stock faible</span>
                                    </td>
                                    <td>
                                        <span class="product-date">05/02/25</span>
                                    </td>
                                    <td>
                                        <div class="product-actions">
                                            <button class="action-btn action-btn-edit" title="Modifier" id="mdf_btn">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                            <button class="action-btn action-btn-delete" title="Supprimer" id = 'rmv_btn'>
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M2 4H3.33333H14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                    <path d="M5.33333 4V2.66667C5.33333 2.48986 5.40357 2.32029 5.5286 2.19526C5.65362 2.07024 5.82319 2 6 2H10C10.1768 2 10.3464 2.07024 10.4714 2.19526C10.5964 2.32029 10.6667 2.48986 10.6667 2.66667V4M12.6667 4V13.3333C12.6667 13.5101 12.5964 13.6797 12.4714 13.8047C12.3464 13.9298 12.1768 14 12 14H4C3.82319 14 3.65362 13.9298 3.5286 13.8047C3.40357 13.6797 3.33333 13.5101 3.33333 13.3333V4H12.6667Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Ligne produit 4 -->
                                <tr>
                                    <td>
                                        <input type="checkbox" class="product-checkbox" data-id="4">
                                    </td>
                                    <td>
                                        <div class="product-info-cell">
                                            <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-thumbnail">
                                            <div class="product-details">
                                                <div class="product-name">Samsung Galaxy Watch</div>
                                                <div class="product-sku">SKU: PRD004</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="product-price">280 000 XAF</span>
                                    </td>
                                    <td>
                                        <span class="product-category">Montres</span>
                                    </td>
                                    <td>
                                        <div class="stock-info">
                                            <div class="stock-indicator out"></div>
                                            <span>0 unité</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="status-badge error">Rupture</span>
                                    </td>
                                    <td>
                                        <span class="product-date">01/02/25</span>
                                    </td>
                                    <td>
                                        <div class="product-actions">
                                            <button class="action-btn action-btn-edit" title="Modifier" id="mdf_btn">
                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </button>
                                            <button class="action-btn action-btn-delete" title="Supprimer" id = 'rmv_btn'>
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
                        
                        <!-- Pied de tableau avec pagination -->
                        <div class="table-footer">
                            <div class="table-info">
                                Affichage de 1 à 4 sur 47 produits
                            </div>
                            
                            <!-- Pagination -->
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
                    
                    <!-- Vue Grille (cachée par défaut) -->
                    <div class="products-grid-view hidden" id="gridView">
                        <div class="products-grid">
                            
                            <!-- Carte produit 1 -->
                            <div class="product-card">
                                <div class="product-card-header">
                                    <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-card-image">
                                    <div class="product-card-actions">
                                        <input type="checkbox" class="product-checkbox" data-id="1">
                                        <div class="card-actions">
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
                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-card-title">MacBook Pro 16"</div>
                                    <div class="product-card-sku">SKU: PRD001</div>
                                    <div class="product-card-price">2 500 000 XAF</div>
                                    <div class="product-card-category">Ordinateurs</div>
                                </div>
                                <div class="product-card-footer">
                                    <div class="stock-info">
                                        <div class="stock-indicator high"></div>
                                        <span>45 unités</span>
                                    </div>
                                    <span class="status-badge success">Actif</span>
                                </div>
                            </div>
                            
                            <!-- Carte produit 2 -->
                            <div class="product-card">
                                <div class="product-card-header">
                                    <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-card-image">
                                    <div class="product-card-actions">
                                        <input type="checkbox" class="product-checkbox" data-id="2">
                                        <div class="card-actions">
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
                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-card-title">iPhone 15 Pro</div>
                                    <div class="product-card-sku">SKU: PRD002</div>
                                    <div class="product-card-price">850 000 XAF</div>
                                    <div class="product-card-category">Téléphones</div>
                                </div>
                                <div class="product-card-footer">
                                    <div class="stock-info">
                                        <div class="stock-indicator medium"></div>
                                        <span>22 unités</span>
                                    </div>
                                    <span class="status-badge success">Actif</span>
                                </div>
                            </div>
                            
                            <!-- Carte produit 3 -->
                            <div class="product-card">
                                <div class="product-card-header">
                                    <img src="https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg" alt="Produit" class="product-card-image">
                                    <div class="product-card-actions">
                                        <input type="checkbox" class="product-checkbox" data-id="3">
                                        <div class="card-actions">
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
                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-card-title">Casque Sony WH-1000XM4</div>
                                    <div class="product-card-sku">SKU: PRD003</div>
                                    <div class="product-card-price">350 000 XAF</div>
                                    <div class="product-card-category">Audio</div>
                                </div>
                                <div class="product-card-footer">
                                    <div class="stock-info">
                                        <div class="stock-indicator low"></div>
                                        <span>8 unités</span>
                                    </div>
                                    <span class="status-badge warning">Stock faible</span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
                
            </div>
            
        </main>
        
    </div>
    
    <!-- MODAL AJOUT/ÉDITION PRODUIT 
    <div class="modal-overlay hidden" id="productModal">
        <div class="modal modal-lg">
            
            
            <div class="modal-header">
                <h2 class="modal-title">Ajouter un produit</h2>
                <button class="modal-close" id="modalClose" aria-label="Fermer">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 4L4 12M4 4L12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </div>
            
            Corps du modal avec formulaire
            <div class="modal-body">
                <form class="product-form" id="productForm">
                    
                    <div class="form-group">
                        <label class="form-label">Image du produit</label>
                        <div class="image-upload" id="imageUpload">
                            <div class="image-upload-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M23 19C23 19.5304 22.7893 20.0391 22.4142 20.4142C22.0391 20.7893 21.5304 21 21 21H3C2.46957 21 1.96086 20.7893 1.58579 20.4142C1.21071 20.0391 1 19.5304 1 19V8C1 7.46957 1.21071 6.96086 1.58579 6.58579C1.96086 6.21071 2.46957 6 3 6H7L9 3H15L17 6H21C21.5304 6 22.0391 6.21071 22.4142 6.58579C22.7893 6.96086 23 7.46957 23 8V19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M12 17C14.2091 17 16 15.2091 16 13C16 10.7909 14.2091 9 12 9C9.79086 9 8 10.7909 8 13C8 15.2091 9.79086 17 12 17Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            <p class="image-upload-text">
                                Cliquez pour télécharger une image<br>
                                <small>PNG, JPG jusqu'à 5MB</small>
                            </p>
                            <input type="file" id="productImage" accept="image/*" style="display: none;">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="productName">Nom du produit *</label>
                        <input type="text" id="productName" class="form-input" placeholder="Ex: Smartphone Galaxy S21" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="productPrice">Prix (XAF) *</label>
                            <input type="number" id="productPrice" class="form-input" placeholder="200000" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="productStock">Stock</label>
                            <input type="number" id="productStock" class="form-input" placeholder="100">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="productCategory">Catégorie</label>
                            <select id="productCategory" class="form-select">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="electronique">Électronique</option>
                                <option value="vetements">Vêtements</option>
                                <option value="maison">Maison</option>
                                <option value="sport">Sport</option>
                                <option value="autre">Autre</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="productSKU">SKU</label>
                            <input type="text" id="productSKU" class="form-input" placeholder="PRD001">
                        </div>
                    </div>
                    
                   
                    <div class="form-group">
                        <label class="form-label" for="productDescription">Description</label>
                        <textarea id="productDescription" class="form-textarea" placeholder="Description détaillée du produit..." rows="4"></textarea>
                    </div>
                    
                </form>
            </div>  
            
             Pied du modal avec actions 
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" id="cancelBtn">Annuler</button>
                <button class="btn btn-primary" type="submit" form="productForm">Enregistrer</button>
            </div> 
            
        </div>
    </div> -->
    
    <!-- SCRIPTS JAVASCRIPT -->
    <script>
        // Gestion du toggle de la sidebar

        // Gestion du modal produit
        /*
        const addProductBtn = document.getElementById('addProductBtn');
        const action_btn = document.getElementById('mdf_btn');
        const productModal = document.getElementById('productModal');
        const modalClose = document.getElementById('modalClose');
        const cancelBtn = document.getElementById('cancelBtn');
        const imageUpload = document.getElementById('imageUpload');
        const productImage = document.getElementById('productImage');
            
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const sidebarClose = document.querySelector('.sidebar-close');
            
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
            
            sidebarClose.addEventListener('click', function() {
                sidebar.classList.remove('active');
            });
            
            
            addProductBtn.addEventListener('click', function() {
                productModal.classList.remove('hidden');
            });
            action_btn.addEventListener('click', function(){
                productModal.classList.remove('hidden');
            })
            
            modalClose.addEventListener('click', function() {
                productModal.classList.add('hidden');
            });
            
            cancelBtn.addEventListener('click', function() {
                productModal.classList.add('hidden');
            });
            
            imageUpload.addEventListener('click', function() {
                productImage.click();
            });
            
            // Gestion du toggle de vue
            const viewToggleBtns = document.querySelectorAll('.view-toggle-btn');
            const listView = document.getElementById('listView');
            const gridView = document.getElementById('gridView');
            
            viewToggleBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    const view = this.getAttribute('data-view');
                    
                    // Mettre à jour les boutons actifs
                    viewToggleBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Afficher la vue correspondante
                    if (view === 'list') {
                        listView.classList.remove('hidden');
                        gridView.classList.add('hidden');
                    } else {
                        listView.classList.add('hidden');
                        gridView.classList.remove('hidden');
                    }
                });
            });
            
            // Gestion des cases à cocher
            const selectAll = document.getElementById('selectAll');
            const productCheckboxes = document.querySelectorAll('.product-checkbox:not(#selectAll)');
            const bulkActions = document.getElementById('bulkActions');
            const selectedCount = document.getElementById('selectedCount');
            
            selectAll.addEventListener('change', function() {
                const isChecked = this.checked;
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                updateBulkActions();
            });
            
            productCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateBulkActions();
                    updateSelectAll();
                });
            });
            
            function updateBulkActions() {
                const checkedCount = document.querySelectorAll('.product-checkbox:checked:not(#selectAll)').length;
                selectedCount.textContent = checkedCount;
                
                if (checkedCount > 0) {
                    bulkActions.classList.remove('hidden');
                } else {
                    bulkActions.classList.add('hidden');
                }
            }
            
            function updateSelectAll() {
                const checkedCount = document.querySelectorAll('.product-checkbox:checked:not(#selectAll)').length;
                const totalCount = productCheckboxes.length;
                
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
            
            // Fermer le modal en cliquant à l'extérieur
            productModal.addEventListener('click', function(e) {
                if (e.target === productModal) {
                    productModal.classList.add('hidden');
                }
            });
        });
*/



        //  GESTIONNAIRE DE PRODUITS
        

    </script>
</body>
@endsection