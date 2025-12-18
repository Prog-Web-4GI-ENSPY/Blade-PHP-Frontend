        //  GESTIONNAIRE DE PRODUITS
class ProductManager {
    constructor() {
        this.products = this.loadProductsFromStorage();
        this.currentEditId = null;
        this.initEventListeners();
        this.renderProducts();
    }

    //  Chargement depuis le localStorage
    loadProductsFromStorage() {
        const stored = localStorage.getItem('products');
        return stored ? JSON.parse(stored) : [
            {
                id: 1,
                name: "MacBook Pro 16\"",
                sku: "PRD001",
                price: "2 500 000 XAF",
                category: "Ordinateurs",
                stock: 45,
                status: "active",
                image: "https://i.pinimg.com/736x/6d/f6/84/6df684f8427dd671088a474ac9d8de93.jpg",
                date: "10/02/25"
            }
        ];
    }

    //  Sauvegarde dans le localStorage
    saveProductsToStorage() {
        localStorage.setItem('products', JSON.stringify(this.products));
    }

    // Initialisation des événements
    initEventListeners() {
        // Bouton d'ajout de produit
        const addProductBtn = document.getElementById('addProductBtn');
        if (addProductBtn) {
            addProductBtn.addEventListener('click', () => this.showProductModal());
        }

        // Bouton d'export
        const exportBtn = document.getElementById('exportBtn');
        if (exportBtn) {
            exportBtn.addEventListener('click', () => this.exportProducts());
        }

        // Filtres
        this.initFilters();

        // Gestion des cases à cocher
        this.initCheckboxes();
    }

    //  Initialisation des filtres
    initFilters() {
        const searchInput = document.querySelector('.search-input');
        const categoryFilter = document.querySelector('.form-select:first-of-type');
        const statusFilter = document.querySelector('.form-select:last-of-type');
        const filterBtn = document.querySelector('.btn-secondary');

        if (searchInput) searchInput.addEventListener('input', () => this.applyFilters());
        if (categoryFilter) {
            categoryFilter.addEventListener('change', () => this.applyFilters());
            console.log("une categorie trouvee");

        };
        if (statusFilter) statusFilter.addEventListener('change', () => this.applyFilters());
        if (filterBtn) {
            filterBtn.addEventListener('click', () => this.applyFilters());
            console.log("boutton filtre selectioner ");
        };
    }

    //  Initialisation des cases à cocher
    initCheckboxes() {
        const selectAll = document.getElementById('selectAll');
        const productCheckboxes = document.querySelectorAll('.product-checkbox:not(#selectAll)');
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');

        if (selectAll) {
            selectAll.addEventListener('change', (e) => {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = e.target.checked;
                });
                this.updateBulkActions();
            });
        }

        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                this.updateBulkActions();
                this.updateSelectAll();
            });
        });
    }

    //  Mise à jour des actions en masse
    updateBulkActions() {
        const bulkActions = document.getElementById('bulkActions');
        const selectedCount = document.getElementById('selectedCount');
        const checkedCount = document.querySelectorAll('.product-checkbox:checked:not(#selectAll)').length;

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
        const checkedCount = document.querySelectorAll('.product-checkbox:checked:not(#selectAll)').length;
        const totalCount = document.querySelectorAll('.product-checkbox:not(#selectAll)').length;

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

    //  CRÉER un produit
    createProduct(productData) {
        const newProduct = {
            id: Date.now(), // ID unique
            ...productData,
            date: new Date().toLocaleDateString('fr-FR')
        };

        this.products.unshift(newProduct); // Ajouter au début
        this.saveProductsToStorage();
        this.renderProducts();
        this.showNotification('Produit créé avec succès', 'success');
    }

    //  MODIFIER un produit
    updateProduct(productId, productData) {
        const index = this.products.findIndex(p => p.id == productId);
        if (index !== -1) {
            this.products[index] = { ...this.products[index], ...productData };
            this.saveProductsToStorage();
            this.renderProducts();
            this.showNotification('Produit modifié avec succès', 'success');
        }
    }

    //  SUPPRIMER un produit
    deleteProduct(productId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')) {
            this.products = this.products.filter(p => p.id != productId);
            this.saveProductsToStorage();
            this.renderProducts();
            this.showNotification('Produit supprimé avec succès', 'success');
        }
    }

    //  SUPPRIMER plusieurs produits
    deleteSelectedProducts() {
        const selectedProducts = Array.from(document.querySelectorAll('.product-checkbox:checked:not(#selectAll)'))
            .map(cb => cb.dataset.id);

        if (selectedProducts.length === 0) {
            this.showNotification('Aucun produit sélectionné', 'error');
            return;
        }

        if (confirm(`Êtes-vous sûr de vouloir supprimer ${selectedProducts.length} produit(s) ?`)) {
            this.products = this.products.filter(p => !selectedProducts.includes(p.id.toString()));
            this.saveProductsToStorage();
            this.renderProducts();
            
            // Réinitialiser les sélections
            const selectAll = document.getElementById('selectAll');
            if (selectAll) selectAll.checked = false;
            this.updateBulkActions();
            
            this.showNotification(`${selectedProducts.length} produit(s) supprimé(s) avec succès`, 'success');
        }
    }

    //  AFFICHER les produits
    renderProducts() {
        const tbody = document.querySelector('.products-table tbody');
        if (!tbody) return;

        tbody.innerHTML = this.products.map(product => `
            <tr>
                <td>
                    <input type="checkbox" class="product-checkbox" data-id="${product.id}">
                </td>
                <td>
                    <div class="product-info-cell">
                        <img src="${product.image}" alt="${product.name}" class="product-thumbnail" onerror="this.src='https://via.placeholder.com/40x40/cccccc/666666?text=IMG'">
                        <div class="product-details">
                            <div class="product-name">${product.name}</div>
                            <div class="product-sku">SKU: ${product.sku}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="product-price">${product.price}</span>
                </td>
                <td>
                    <span class="product-category">${product.category}</span>
                </td>
                <td>
                    <div class="stock-info">
                        <div class="stock-indicator ${this.getStockLevel(product.stock)}"></div>
                        <span>${product.stock} unités</span>
                    </div>
                </td>
                <td>
                    <span class="status-badge ${product.status === 'active' ? 'success' : 'warning'}">
                        ${product.status === 'active' ? 'Actif' : 'Inactif'}
                    </span>
                </td>
                <td>
                    <span class="product-date">${product.date}</span>
                </td>
                <td>
                    <div class="product-actions">
                        <button class="action-btn action-btn-edit" title="Modifier" onclick="productManager.editProduct(${product.id})">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.3333 1.99999C11.5084 1.82488 11.7163 1.686 11.945 1.59124C12.1737 1.49648 12.4189 1.44775 12.6667 1.44775C12.9144 1.44775 13.1596 1.49648 13.3883 1.59124C13.617 1.686 13.8249 1.82488 14 1.99999C14.1751 2.1751 14.314 2.38296 14.4087 2.61167C14.5035 2.84038 14.5522 3.08555 14.5522 3.33332C14.5522 3.58109 14.5035 3.82626 14.4087 4.05497C14.314 4.28368 14.1751 4.49154 14 4.66665L5 13.6667L1.33333 14.6667L2.33333 11L11.3333 1.99999Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </button>
                        <button class="action-btn action-btn-delete" title="Supprimer" onclick="productManager.deleteProduct(${product.id})">
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
    }

    //  ÉDITER un produit
    editProduct(productId) {
        const product = this.products.find(p => p.id == productId);
        if (product) {
            this.currentEditId = productId;
            this.showProductModal(product);
        }
    }

    //  MODAL de produit
    showProductModal(productData = null) {
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class="modal">
                <div class="modal-header">
                    <h3>${productData ? 'Modifier le produit' : 'Nouveau produit'}</h3>
                    <button class="modal-close">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="productForm" class="product-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="productName">Nom du produit *</label>
                                <input type="text" id="productName" name="name" value="${productData ? productData.name : ''}" required>
                            </div>
                            <div class="form-group">
                                <label for="productSku">SKU *</label>
                                <input type="text" id="productSku" name="sku" value="${productData ? productData.sku : ''}" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="productPrice">Prix *</label>
                                <input type="text" id="productPrice" name="price" value="${productData ? productData.price : ''}" placeholder="2 500 000 XAF" required>
                            </div>
                            <div class="form-group">
                                <label for="productStock">Stock *</label>
                                <input type="number" id="productStock" name="stock" value="${productData ? productData.stock : ''}" min="0" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="productCategory">Catégorie *</label>
                                <select id="productCategory" name="category" required>
                                    <option value="">Sélectionner une catégorie</option>
                                    <option value="Ordinateurs" ${productData && productData.category === 'Ordinateurs' ? 'selected' : ''}>Ordinateurs</option>
                                    <option value="Téléphones" ${productData && productData.category === 'Téléphones' ? 'selected' : ''}>Téléphones</option>
                                    <option value="Accessoires" ${productData && productData.category === 'Accessoires' ? 'selected' : ''}>Accessoires</option>
                                    <option value="Électronique" ${productData && productData.category === 'Électronique' ? 'selected' : ''}>Électronique</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="productStatus">Statut *</label>
                                <select id="productStatus" name="status" required>
                                    <option value="">Sélectionner un statut</option>
                                    <option value="active" ${productData && productData.status === 'active' ? 'selected' : ''}>Actif</option>
                                    <option value="inactive" ${productData && productData.status === 'inactive' ? 'selected' : ''}>Inactif</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="productImage">Image URL</label>
                            <input type="url" id="productImage" name="image" value="${productData ? productData.image : ''}" placeholder="https://example.com/image.jpg">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" id="cancelBtn">Annuler</button>
                    <button class="btn btn-primary" id="saveBtn">${productData ? 'Modifier' : 'Créer'}</button>
                </div>
            </div>
        `;

        document.body.appendChild(modal);

        // Gestion des événements du modal
        const closeModal = () => document.body.removeChild(modal);
        
        modal.querySelector('.modal-close').addEventListener('click', closeModal);
        modal.querySelector('#cancelBtn').addEventListener('click', closeModal);
        
        modal.querySelector('#saveBtn').addEventListener('click', () => {
            const form = modal.querySelector('#productForm');
            if (form.checkValidity()) {
                const formData = new FormData(form);
                const productData = Object.fromEntries(formData);
                productData.stock = parseInt(productData.stock);
                
                if (this.currentEditId) {
                    this.updateProduct(this.currentEditId, productData);
                    this.currentEditId = null;
                } else {
                    this.createProduct(productData);
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

    //  FILTRER les produits
    applyFilters() {
        const searchTerm = document.querySelector('.search-input')?.value.toLowerCase() || '';
        const categoryFilter = document.querySelector('.form-select:first-of-type')?.value || '';
        const statusFilter = document.querySelector('.form-select:last-of-type')?.value || '';

        const rows = document.querySelectorAll('.products-table tbody tr');
        let visibleCount = 0;

        rows.forEach(row => {
            const productName = row.querySelector('.product-name')?.textContent.toLowerCase() || '';
            const productSku = row.querySelector('.product-sku')?.textContent.toLowerCase() || '';
            const productCategory = row.querySelector('.product-category')?.textContent.toLowerCase() || '';
            const productStatus = row.querySelector('.status-badge')?.textContent.toLowerCase() || '';

            const matchesSearch = productName.includes(searchTerm) || productSku.includes(searchTerm);
            const matchesCategory = !categoryFilter || productCategory.includes(categoryFilter.toLowerCase());
            const matchesStatus = !statusFilter || productStatus.includes(statusFilter.toLowerCase());

            if (matchesSearch && matchesCategory && matchesStatus) {
                row.style.display = '';
                visibleCount++;
                console.log("dans le if");
                
            } else {
                row.style.display = 'none';
                console.log("dans le else");
            }
        });

        this.updateTableInfo(visibleCount);
    }

    // ℹ Mettre à jour les infos du tableau
    updateTableInfo(visibleCount) {
        const tableInfo = document.querySelector('.table-info');
        if (tableInfo) {
            tableInfo.textContent = `Affichage de 1 à ${Math.min(visibleCount, this.products.length)} sur ${this.products.length} produits`;
        }
    }

    //  Niveau de stock
    getStockLevel(stock) {
        if (stock > 20) return 'high';
        if (stock > 5) return 'medium';
        return 'low';
    }

    //  EXPORTER les produits
    exportProducts() {
        const dataStr = JSON.stringify(this.products, null, 2);
        const dataBlob = new Blob([dataStr], { type: 'application/json' });
        
        const link = document.createElement('a');
        link.href = URL.createObjectURL(dataBlob);
        link.download = `produits_${new Date().toISOString().split('T')[0]}.json`;
        link.click();
        
        this.showNotification('Export des produits terminé', 'success');
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
const productManager = new ProductManager();

//  Rendre disponible globalement
window.productManager = productManager;