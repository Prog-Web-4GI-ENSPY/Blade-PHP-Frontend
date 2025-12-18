<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\Tag(
 * name="Products",
 * description="API Endpoints for Products"
 * )
 */
class ProductController extends Controller
{

    /**
     * Génère un slug unique pour le produit.
     * @param string $name
     * @return string
     */
    protected function generateUniqueSlug(string $name): string
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $count = 1;

        // boucle tant que le slug existe deja dans la table products
        while (Product::where('slug', $slug)->exists()){
            $slug = $originalSlug .'-'.$count;
            $count++;
        }
        return $slug;
    }
    
    /**
     * @OA\Get(
     * path="/api/products",
     * summary="Get a list of all visible products (Public Access)",
     * tags={"Products"},
     * @OA\Parameter(name="search", in="query", @OA\Schema(type="string"), description="Search term for product name/description."),
     * @OA\Parameter(name="category", in="query", @OA\Schema(type="integer"), description="Filter by category ID."),
     * @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", default=10), description="Number of products per page."),
     * @OA\Response(
     * response=200,
     * description="Products retrieved successfully",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="message", type="string", example="Products retrieved successfully"),
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Product")),
     * @OA\Property(property="meta", type="object")
     * )
     * )
     * )
     */
    public function index(Request $request)
    {
        $query = Product::query();
        
        // 1. Filtrage par Visibilité
        $query->where('is_visible', true);
        
        // 2. Filtrage par Catégorie
        if ($request->has('category')) {
            $categoryId = $request->query('category');
            if (Category::where('id', $categoryId)->exists()) {
                $query->where('category_id', $categoryId);
            }
        }
        
        // 3. Recherche (par nom ou description)
        if ($request->has('search')) {
            $search = $request->query('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        // 4. Tri par défaut
        $query->orderBy('is_featured', 'desc')
              ->orderBy('updated_at', 'desc');

        // 5. Pagination
        $perPage = $request->get('per_page', 10);
        $products = $query->paginate($perPage);
        
        // CORRECTION: Utiliser la Resource Collection directement sur l'objet paginé
        return ProductResource::collection($products)
            ->additional([
               'status' => 'success',
                'message' => 'Products retrieved successfully',
                'code' => 200,
            ])
            ->response()
            ->setStatusCode(200);
    }
    
    /**
     * @OA\Get(
     * path="/api/products/{slug}",
     * summary="Get product details by slug (Public Access)",
     * tags={"Products"},
     * @OA\Parameter(
     * name="slug",
     * in="path",
     * required=true,
     * description="Product slug (e.g., iphone-15-pro)",
     * @OA\Schema(type="string")
     * ),
     * @OA\Response(
     * response=200,
     * description="Product details retrieved successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Product retrieved successfully"),
     * @OA\Property(property="data", ref="#/components/schemas/Product")
     * )
     * ),
     * @OA\Response(
     * response=404,
     * description="Product not found"
     * )
     * )
     */
    public function show(string $slug)
    {
        try {
            // Récupère le produit visible par le slug
            $product = Product::where('slug', $slug)
                ->where('is_visible', true)
                ->firstOrFail();

                return response()->json([
                    'status' => 'success', // Ajouté
                    'data' => new ProductResource($product), // Renommé 'data'
                    'message' => 'Product retrieved successfully',
                    'code' => 200 // Ajouté
                ], 200);
                
            } catch (ModelNotFoundException $e) {
                return response()->json([
                    'status' => 'error', // Ajouté
                    'data' => null, // Ajouté
                    'message' => 'Product not found or not visible.',
                    'code' => 404 // Ajouté
                ], 404);
            }
        }

    /**
     * @OA\Post(
     * path="/api/products",
     * summary="Create a new product",
     * tags={"Products"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"name", "price", "stock", "category_id"},
     * @OA\Property(property="name", type="string", example="New Product"),
     * @OA\Property(property="description", type="string", example="Product description"),
     * @OA\Property(property="price", type="number", format="float", example=99.99),
     * @OA\Property(property="compare_price", type="number", format="float", example=129.99),
     * @OA\Property(property="stock", type="integer", example=100),
     * @OA\Property(property="sku", type="string", example="SKU12345"),
     * @OA\Property(property="category_id", type="integer", example=1),
     * @OA\Property(property="is_visible", type="boolean", example=true),
     * @OA\Property(property="is_featured", type="boolean", example=false),
     * @OA\Property(property="image", type="string", format="binary", description="Product image file (max 2MB)")
     * )
     * )
     * ),
     * @OA\Response(
     * response=201,
     * description="Product created successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Product created successfully"),
     * @OA\Property(property="data", ref="#/components/schemas/Product")
     * )
     * ),
     * @OA\Response(
     * response=403,
     * description="Access denied. Admin or Vendor role required."
     * )
     * )
     */
    public function store(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        if (!$user || (!$user->isAdmin() && !$user->isVendor())) {
            return response()->json([
                'status' => 'error', // Ajouté
                'data' => null, // Ajouté
                'message' => 'Access denied. Admin or Vendor role required.',
                'code' => 403 // Ajouté
            ], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'is_visible' => 'nullable|in:true,false,1,0', 
            'is_featured' => 'nullable|in:true,false,1,0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Conversion explicite des chaînes en booléens PHP avant l'enregistrement
        if (isset($validated['is_visible'])) {
            $validated['is_visible'] = filter_var($validated['is_visible'], FILTER_VALIDATE_BOOLEAN);
        }
        if (isset($validated['is_featured'])) {
            $validated['is_featured'] = filter_var($validated['is_featured'], FILTER_VALIDATE_BOOLEAN);
        }

        // Gestion de l'image (si présente)
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path;
        }

        // Les vendeurs ne peuvent créer que des produits visibles par défaut (si non spécifié)
        if ($user->isVendor() && !isset($validated['is_visible'])) {
            $validated['is_visible'] = true;
        } elseif (!isset($validated['is_visible'])) {
            // Par défaut à false si non spécifié (seul l'admin devrait pouvoir contrôler ça finement)
            $validated['is_visible'] = false;
        }
        
        $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        
        $product = Product::create($validated);
        
        

        return response()->json([
            'status' => 'success', // Ajouté
            'data' => new ProductResource($product), // Renommé 'data'
            'message' => 'Product created successfully',
            'code' => 201 // Ajouté
        ], 201);
    }

    /**
     * @OA\Post(
     * path="/api/products/{id}",
     * summary="Update product (Use POST with _method=PUT for file upload)",
     * tags={"Products"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="Product ID",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * @OA\Property(property="_method", type="string", example="PUT", description="Required for method spoofing"),
     * @OA\Property(property="name", type="string", example="Updated Product Name"),
     * @OA\Property(property="description", type="string", example="Updated description"),
     * @OA\Property(property="price", type="number", format="float", example=89.99),
     * @OA\Property(property="compare_price", type="number", format="float", example=119.99),
     * @OA\Property(property="stock", type="integer", example=50),
     * @OA\Property(property="sku", type="string", example="SKU12345-UPDATED"),
     * @OA\Property(property="category_id", type="integer", example=1),
     * @OA\Property(property="is_visible", type="boolean", example=true),
     * @OA\Property(property="is_featured", type="boolean", example=true),
     * @OA\Property(property="image", type="string", format="binary", nullable=true, description="New product image file"),
     * @OA\Property(property="remove_image", type="boolean", nullable=true, description="Set to true to delete current image.")
     * )
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Product updated successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Product updated successfully"),
     * @OA\Property(property="data", ref="#/components/schemas/Product")
     * )
     * ),
     * @OA\Response(
     * response=403,
     * description="Access denied"
     * )
     * )
     */
    public function update(Request $request, Product $product)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        // Contrôle d'accès : Seuls Admin et Vendor sont autorisés
        if (!$user || (!$user->isAdmin() && !$user->isVendor())) {
            return response()->json([
                'message' => 'Access denied. Admin or Vendor role required.'
            ], 403);
        }
        
        // Si c'est un Vendor, il doit être le propriétaire du produit (Ajouter la vérification si vous avez un champ vendor_id sur Product)
        // if ($user->isVendor() && $product->vendor_id !== $user->id) {
        //     return response()->json(['message' => 'Access denied. You do not own this product.'], 403);
        // }


        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255', // 'sometimes' car la méthode est PUT/PATCH
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'sku' => ['nullable', 'string', Rule::unique('products', 'sku')->ignore($product->id)],
            'category_id' => 'sometimes|required|exists:categories,id',
           'is_visible' => 'nullable|in:true,false,1,0',
            'is_featured' => 'nullable|in:true,false,1,0',
            // Pour le fichier, le nom d'annotation Swagger est 'image' mais pour la validation, on utilise l'attribut du formulaire
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
           'remove_image' => 'nullable|in:true,false,1,0',
        ]);
        
        // Conversion explicite
        if (isset($validated['is_visible'])) {
            $validated['is_visible'] = filter_var($validated['is_visible'], FILTER_VALIDATE_BOOLEAN);
        }
        if (isset($validated['is_featured'])) {
            $validated['is_featured'] = filter_var($validated['is_featured'], FILTER_VALIDATE_BOOLEAN);
        }
        // 1. Mise à jour du Slug si le nom change
        if (isset($validated['name']) && $validated['name'] !== $product->name) {
            $validated['slug'] = $this->generateUniqueSlug($validated['name']);
        }
        
        // 2. Gestion de l'Image
        
        // Suppression de l'ancienne image si demandée (remove_image=true)
        if ($request->boolean('remove_image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = null; // Enregistre null dans la DB
        }

        // Upload de la nouvelle image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe et n'a pas été supprimée explicitement
            if ($product->image && !$request->boolean('remove_image')) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = $path; // Enregistre le nouveau chemin
        }
        
        // S'assurer que 'image' n'est pas inclus dans $validated si l'image n'est pas mise à jour et n'est pas supprimée
        if (!$request->hasFile('image') && !$request->boolean('remove_image')) {
             unset($validated['image']);
        }


        $product->update($validated);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => new ProductResource($product)
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/products/{id}",
     * summary="Delete product",
     * tags={"Products"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="id",
     * in="path",
     * required=true,
     * description="Product ID",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Product deleted successfully",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Product deleted successfully")
     * )
     * ),
     * @OA\Response(
     * response=403,
     * description="Access denied"
     * ),
     * @OA\Response(
     * response=404,
     * description="Product not found"
     * )
     * )
     */
    public function destroy(Product $product)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        if (!$user || (!$user->isAdmin() && !$user->isVendor())) {
            return response()->json([
                'status' => 'error', // Ajouté
                'data' => null, // Ajouté
                'message' => 'Access denied. Admin or Vendor role required.',
                'code' => 403 // Ajouté
            ], 403);
        }

        // Supprimer l'image du disque avant de supprimer l'enregistrement
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return response()->json([
            'status' => 'success', // Ajouté
            'data' => null, // Ajouté
            'message' => 'Product deleted successfully',
            'code' => 200 // Ajouté
        ], 200);
    }

    /**
     * @OA\Get(
     * path="/api/products/vendor/my-products",
     * summary="Get vendor's products (Minimal Pagination) - Visible to Admin/Vendor",
     * tags={"Products"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", default=12), description="Number of products per page."),
     * @OA\Response(
     * response=200,
     * description="Vendor's products list",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="message", type="string", example="Products retrieved successfully"),
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Product")),
     * @OA\Property(property="total", type="integer", example=100),
     * @OA\Property(property="per_page", type="integer", example=12)
     * )
     * ),
     * @OA\Response(
     * response=403,
     * description="Access denied. Vendor or Admin role required."
     * )
     * )
     */
    public function myProducts(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        if (!$user || (!$user->isVendor() && !$user->isAdmin())) {
            return response()->json([
                'status' => 'error', // Ajouté
                'data' => null, // Ajouté
                'message' => 'Access denied. Vendor or Admin role required.',
                'code' => 403 // Ajouté
            ], 403);
        }

        // Si vous avez un champ 'vendor_id' dans la table 'products', décommentez la ligne suivante:
        // $productsQuery = Product::where('vendor_id', $user->id);
        
        $products = Product::orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 12));
        
            return response()->json([
                'status' => 'success', // Ajouté
                'data' => ProductResource::collection($products->items()),
                'message' => 'Products retrieved successfully', // Ajouté
                'code' => 200, // Ajouté
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
            ], 200);
    }

    /**
     * @OA\Get(
     * path="/api/products/vendor/stats",
     * summary="Get product statistics (Admin/Vendor)",
     * tags={"Products"},
     * security={{"bearerAuth":{}}},
     * @OA\Response(
     * response=200,
     * description="Vendor statistics",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="message", type="string", example="Statistics retrieved successfully"),
     * @OA\Property(property="data", type="object",
     * @OA\Property(property="total_products", type="integer", example=50),
     * @OA\Property(property="visible_products", type="integer", example=45),
     * @OA\Property(property="featured_products", type="integer", example=10),
     * @OA\Property(property="out_of_stock", type="integer", example=5)
     * )
     * )
     * ),
     * @OA\Response(
     * response=403,
     * description="Access denied. Admin or Vendor role required."
     * )
     * )
     */
    public function vendorStats()
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();
        
        if (!$user || (!$user->isAdmin() && !$user->isVendor())) {
            return response()->json([
                'status' => 'error', // Ajouté
                'data' => null, // Ajouté
                'message' => 'Access denied. Admin or Vendor role required.',
                'code' => 403 // Ajouté
            ], 403);
        }

        // Si vous avez un champ 'vendor_id', filtrez les statistiques par ce champ.
        $baseQuery = Product::query();
        // if ($user->isVendor()) {
        //     $baseQuery->where('vendor_id', $user->id);
        // }

        $stats = [
            'total_products' => $baseQuery->count(),
            'visible_products' => $baseQuery->clone()->where('is_visible', true)->count(),
            'featured_products' => $baseQuery->clone()->where('is_featured', true)->count(),
            'out_of_stock' => $baseQuery->clone()->where('stock', 0)->count(),
        ];

        return response()->json([
            'status' => 'success', // Ajouté
            'data' => $stats, // Renommé 'data'
            'message' => 'Statistics retrieved successfully',
            'code' => 200 // Ajouté
        ], 200);
    }

  /**
     * @OA\Get(
     * path="/api/products/featured",
     * summary="Get a list of featured products (Public Access)",
     * tags={"Products"},
     * @OA\Parameter(name="limit", in="query", @OA\Schema(type="integer", default=8), description="Maximum number of products to return."),
     * @OA\Response(
     * response=200,
     * description="Featured products retrieved successfully",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Product")),
     * @OA\Property(property="message", type="string", example="Featured products retrieved successfully"),
     * @OA\Property(property="code", type="integer", example=200)
     * )
     * )
     * )
     */
    public function featured(Request $request)
    {
        // Limite par défaut à 8 produits, modifiable via le paramètre de requête 'limit'
        $limit = $request->get('limit', 8); 
        
        try {
            $products = Product::where('is_visible', true)
                               ->where('is_featured', true)
                               ->orderBy('updated_at', 'desc')
                               ->take($limit)
                               ->get();

            return response()->json([
                'status' => 'success',
                'data' => ProductResource::collection($products),
                'message' => 'Featured products retrieved successfully',
                'code' => 200
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'data' => null,
                'message' => 'Error retrieving featured products: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}