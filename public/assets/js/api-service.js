// api-service.js
class ApiService {
    constructor() {
        this.baseURL = 'https://shopecart-web-project-tp-4-laravel-full-pyh9fx.laravel.cloud/api';
        this.token = localStorage.getItem('auth_token');
        this.storageURL = 'https://shopecart-web-project-tp-4-laravel-full-pyh9fx.laravel.cloud/storage/';
        this.categoriesCache = null;
    }

    /**
     * Helper pour construire les URLs d'images complètes
     */
    getImageUrl(path) {
        if (!path) return '/assets/images/placeholder.png';
        if (path.startsWith('http')) return path;
        return `${this.storageURL}${path}`;
    }
    async request(endpoint, options = {}) {
        const url = `${this.baseURL}${endpoint}`;
        const config = {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': ''
            },
            ...options
        };

        if (this.token) {
            config.headers['Authorization'] = `Bearer ${this.token}`;
        }

        try {
            const response = await fetch(url, config);
            
            if (response.status === 401) {
                this.handleUnauthorized();
                throw new Error('Session expirée');
            }

            if (!response.ok) {
                const errorData = await response.json().catch(() => ({}));
                throw new Error(errorData.message || `HTTP error! status: ${response.status}`);
            }

            return await response.json();
        } catch (error) {
            console.error('API Request failed:', error);
            throw error;
        }
    }

    handleUnauthorized() {
        localStorage.removeItem('auth_token');
        localStorage.removeItem('user');
        // Rediriger seulement si on n'est pas déjà sur login
        if (!window.location.pathname.includes('login.html')) {
            window.location.href = '/login.html';
        }
    }

    // ==================== MÉTHODES CATÉGORIES ====================
    
    /**
     * Récupère TOUTES les catégories
     */
    async getAllCategories() {
        try {
            console.log('📥 Récupération de toutes les catégories...');
            const response = await this.request('/categories');
            
            if (response && response.message === "Categories retrieved successfully") {
                this.categoriesCache = response.data;
                console.log('reponse',response);
                console.log(`✅ ${response.data.length} catégories récupérées`);
                return response.data;
            }
            throw new Error('Format de réponse invalide');
        } catch (error) {
            console.error('❌ Erreur lors de la récupération des catégories:', error);
            throw error;
        }
    }

    /**
     * Affiche toutes les catégories pour débogage
     */
    async debugCategories() {
        try {
            const categories = await this.getAllCategories();
            
            console.log('📊 === LISTE DES CATÉGORIES ===');
            categories.forEach(cat => {
                console.log(`ID: ${cat.id} | Nom: "${cat.name}" | Slug: ${cat.slug}`);
            });
            console.log('===============================');
            
            return categories;
        } catch (error) {
            console.error('Erreur debugCategories:', error);
            return [];
        }
    }

    /**
     * Cherche une catégorie par son nom (exact ou approchant)
     */
    async findCategoryByName(categoryName) {
        try {
            console.log(`🔍 Recherche catégorie: "${categoryName}"`);
            
            // Récupérer toutes les catégories
            const allCategories = await this.getAllCategories();
            
            if (!allCategories || allCategories.length === 0) {
                console.error('❌ Aucune catégorie disponible');
                return null;
            }
            
            const searchLower = categoryName.toLowerCase().trim();
            
            // 1. Recherche exacte (insensible à la casse)
            let category = allCategories.find(cat => 
                cat.name.toLowerCase() === searchLower
            );
            
            // 2. Recherche par slug
            if (!category) {
                category = allCategories.find(cat => 
                    cat.slug && cat.slug.toLowerCase() === searchLower
                );
            }
            
            // 3. Recherche partielle
            if (!category) {
                category = allCategories.find(cat => 
                    cat.name.toLowerCase().includes(searchLower) ||
                    searchLower.includes(cat.name.toLowerCase())
                );
            }
            
            if (category) {
                console.log(`✅ Catégorie trouvée: "${category.name}" (ID: ${category.id})`);
                return category;
            } else {
                console.warn(`❌ Catégorie "${categoryName}" non trouvée`);
                console.log('📋 Catégories disponibles:');
                allCategories.forEach(cat => {
                    console.log(`  • "${cat.name}" (ID: ${cat.id})`);
                });
                return null;
            }
            
        } catch (error) {
            console.error('Erreur findCategoryByName:', error);
            return null;
        }
    }

    /**
     * Récupère l'ID d'une catégorie par son nom
     */
    async getCategoryIdByName(categoryName) {
        const category = await this.findCategoryByName(categoryName);
        return category ? category.id : null;
    }

    /**
     * Récupère les produits d'une catégorie par son ID
     */
    async getProductsByCategoryId(categoryId, options = {}) {
        try {
            const { page = 1, limit = 12, filters = {} } = options;
            
            const params = new URLSearchParams({
                page: page.toString(),
                per_page: limit.toString()
            });
            
            // Ajouter les filtres
            Object.entries(filters).forEach(([key, value]) => {
                if (value !== undefined && value !== null) {
                    params.append(key, value.toString());
                }
            });
            
            const endpoint = `/categories/${categoryId}/products?${params.toString()}`;
            
            console.log(`📦 Chargement produits - Catégorie ID: ${categoryId}`);
            
            const response = await this.request(endpoint);
            
            if (response && response.message && response.message.includes("successfully")) {
                console.log(`✅ ${response.data?.length || 0} produits chargés`);
                return response;
            } else {
                throw new Error(response?.message || 'Réponse API invalide');
            }
            
        } catch (error) {
            console.error(`❌ Erreur getProductsByCategoryId:`, error);
            throw error;
        }
    }

    /**
     * Méthode complète: nom → catégorie → produits
     */
    async getProductsByCategoryName(categoryName, options = {}) {
        console.log('🚀 Processus complet de chargement');
        
        // 1. Trouver la catégorie
        const category = await this.findCategoryByName(categoryName);
        if (!category) {
            throw new Error(`Catégorie "${categoryName}" non trouvée`);
        }
        
        // 2. Charger les produits
        const productsResponse = await this.getProductsByCategoryId(category.id, options);
        
        return {
            category: category,
            productsResponse: productsResponse
        };
    }

    // ==================== AUTRES MÉTHODES ====================
    
    async getProducts() {
        return await this.request('/products', { method: 'GET' });
    }

    async getFeaturedProducts() {
        return await this.request('/products/featured');
    }

    async getProduct(id) {
        return await this.request(`/products/${id}`);
    }

    async addToCart(productId, quantity = 1) {
        return await this.request(`/cart/add/${productId}`, {
            method: 'POST',
            body: JSON.stringify({ quantity })
        });
    }

    async getCart() {
        return await this.request('/cart');
    }

    async updateCartItem(cartItemId, quantity) {
        return await this.request(`/cart/items/${cartItemId}`, {
            method: 'PUT',
            body: JSON.stringify({ quantity })
        });
    }

    async removeCartItem(cartItemId) {
        return await this.request(`/cart/items/${cartItemId}`, {
            method: 'DELETE'
        });
    }

    async clearCart() {
        return await this.request('/cart/clear', { method: 'DELETE' });
    }

    // Authentification
    async register(userData) {
        return await this.request('/register', {
            method: 'POST',
            body: JSON.stringify(userData)
        });
    }

    async login(credentials) {
        const data = await this.request('/login', {
            method: 'POST',
            body: JSON.stringify(credentials)
        });
        
        if (data.token) {
            this.token = data.token;
            localStorage.setItem('auth_token', data.token);
            localStorage.setItem('user', JSON.stringify(data.user));
        }
        
        return data;
    }

    async logout() {
        try {
            await this.request('/logout', { method: 'POST' });
        } catch (error) {
            console.error('Logout error:', error);
        } finally {
            this.token = null;
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
        }
    }

    async getCurrentUser() {
        return await this.request('/user');
    }

    // ==================== PANIER (BACKEND) ====================
    async getCart() {
        return await this.request('/cart');
    }

    async addToCart(productId, quantity = 1) {
        return await this.request('/cart/add', {
            method: 'POST',
            body: JSON.stringify({ product_id: productId, quantity })
        });
    }

    async updateCartItem(itemId, quantity) {
        return await this.request(`/cart/update/${itemId}`, {
            method: 'PUT',
            body: JSON.stringify({ quantity })
        });
    }

    async removeCartItem(itemId) {
        return await this.request(`/cart/remove/${itemId}`, { method: 'DELETE' });
    }


}

window.handleCheckout = function() {
    console.log("🚀 Redirection vers la page de commande...");
    // Si l'utilisateur n'est pas connecté, on le redirige vers login
    if (!window.apiService.token) {
        alert("Veuillez vous connecter pour passer commande.");
        window.location.href = '/login';
        return;
    }
    // Sinon direction checkout
    window.location.href = '/checkout';
};
// Instance globale
window.apiService = new ApiService();