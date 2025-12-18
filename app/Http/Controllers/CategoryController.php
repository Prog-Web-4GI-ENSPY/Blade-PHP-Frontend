<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource; // Assurez-vous d'utiliser cette ressource
use App\Models\User; // Import du modèle User
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

/**
 * @OA\Tag(
 * name="Categories",
 * description="API Endpoints for Category Management and Public Access"
 * )
 */
class CategoryController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/categories",
     * summary="Get all categories (Public)",
     * tags={"Categories"},
     * @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", default=15)),
     * @OA\Response(
     * response=200,
     * description="List of categories",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Categories retrieved successfully"),
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/CategoryResource"))
     * )
     * )
     * )
     */
    public function index(Request $request)
    {
        $categories = Category::orderBy('position', 'asc')
            ->paginate($request->get('per_page', 15));

        return response()->json([
            'message' => 'Categories retrieved successfully',
            'data' => CategoryResource::collection($categories),
            'total' => $categories->total(),
            'per_page' => $categories->perPage(),
            'current_page' => $categories->currentPage(),
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/categories/{category}",
     * summary="Get category details (Public)",
     * tags={"Categories"},
     * @OA\Parameter(name="category", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(
     * response=200,
     * description="Category details",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Category retrieved successfully"),
     * @OA\Property(property="data", ref="#/components/schemas/CategoryResource")
     * )
     * )
     * )
     */
    public function show(Category $category)
    {
        // Chargement optionnel des produits (non nécessaire pour une simple vue de catégorie)
        // $category->load('products'); 

        return response()->json([
            'message' => 'Category retrieved successfully',
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * @OA\Post(
     * path="/api/categories",
     * summary="Create a new category (Admin only)",
     * tags={"Categories"},
     * security={{"bearerAuth":{}}},
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"name"},
     * @OA\Property(property="name", type="string", example="Electronics"),
     * @OA\Property(property="description", type="string", example="Electronic devices"),
     * @OA\Property(property="image", type="string", format="binary", description="Category image file")
     * )
     * )
     * ),
     * @OA\Response(response=201, description="Category created successfully"),
     * @OA\Response(response=403, description="Access denied. Admin role required."),
     * @OA\Response(response=422, description="Validation failed")
     * )
     */
    public function store(Request $request)
    {
        /** @var User|null $user */
        $user = $request->user();

        // 1. Vérification d'accès (Utilisation de $request->user() ou $user)
        if (!$user || !$user->isAdmin()) {
            return response()->json(['message' => 'Access denied. Admin role required.'], 403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string|max:500',
            // Image doit être 'nullable' pour la création si vous ne voulez pas la rendre obligatoire
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
            'position' => 'nullable|integer|min:0',
        ]);

        // 2. Gestion du slug unique
        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;
        while (Category::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        $validated['slug'] = $slug;

        // 3. Gestion de l'upload de l'image
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }

        $category = Category::create($validated);

        return response()->json([
            'message' => 'Category created successfully',
            'data' => new CategoryResource($category)
        ], 201);
    }

    /**
     * @OA\Post(
     * path="/api/categories/{category}",
     * summary="Update category (using POST with _method=PUT for file support) (Admin only)",
     * tags={"Categories"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="category", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data",
     * @OA\Schema(
     * required={"_method", "name"},
     * @OA\Property(property="_method", type="string", enum={"PUT"}, example="PUT", description="Required for method spoofing in multipart forms"),
     * @OA\Property(property="name", type="string", example="Electronics Updated"),
     * @OA\Property(property="description", type="string", example="Updated description"),
     * @OA\Property(property="image", type="string", format="binary", description="New image file (optional)"),
     * @OA\Property(property="remove_image", type="boolean", example=false, description="Set to true to remove the current image.")
     * )
     * )
     * ),
     * @OA\Response(response=200, description="Category updated successfully"),
     * @OA\Response(response=403, description="Access denied. Admin role required.")
     * )
     */
    public function update(Request $request, Category $category)
    {
        /** @var User|null $user */
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            return response()->json(['message' => 'Access denied. Admin role required.'], 403);
        }

        $validated = $request->validate([
            // Exclure l'ID actuel lors de la vérification d'unicité
            'name' => ['required', 'string', 'max:255', Rule::unique('categories', 'name')->ignore($category->id)],
            'description' => 'nullable|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'position' => 'nullable|integer|min:0',
            // La validation `boolean` gère 'true', 'false', '1', '0'
            'remove_image' => 'nullable|boolean', 
        ]);
        
        // 1. Suppression de l'ancienne image si demandée
        if (isset($validated['remove_image']) && $validated['remove_image'] && $category->image) {
            Storage::disk('public')->delete($category->image);
            $validated['image'] = null; // Champ mis à null pour la DB
        }

        // 2. Upload de la nouvelle image (Prioritaire sur la suppression)
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            // Stocker la nouvelle
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = $path;
        }


        // 3. Gestion du slug si le nom a changé
        if ($category->name !== $validated['name']) {
             $slug = Str::slug($validated['name']);
             $originalSlug = $slug;
             $counter = 1;
             // S'assurer que le nouveau slug est unique (excluant la catégorie actuelle)
             while (Category::where('slug', $slug)->where('id', '!=', $category->id)->exists()) {
                 $slug = $originalSlug . '-' . $counter;
                 $counter++;
             }
             $validated['slug'] = $slug;
        }

        $category->update($validated);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => new CategoryResource($category)
        ]);
    }

    /**
     * @OA\Delete(
     * path="/api/categories/{category}",
     * summary="Delete category (Admin only)",
     * tags={"Categories"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(name="category", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Response(response=200, description="Category deleted successfully"),
     * @OA\Response(response=403, description="Access denied. Admin role required."),
     * @OA\Response(response=422, description="Cannot delete category with associated products.")
     * )
     */
    public function destroy(Category $category, Request $request)
    {
        /** @var User|null $user */
        $user = $request->user();

        if (!$user || !$user->isAdmin()) {
            return response()->json(['message' => 'Access denied. Admin role required.'], 403);
        }

        // Vérifier si la catégorie a des produits (Protection de l'intégrité référentielle)
        if ($category->products()->exists()) {
            return response()->json([
                'message' => 'Cannot delete category with associated products. Please remove or reassign products first.'
            ], 422);
        }

        // Supprimer l'image si elle existe
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully'
        ]);
    }

    /**
     * @OA\Get(
     * path="/api/categories/{category}/products",
     * summary="Get products by category (Public)",
     * tags={"Categories"},
     * @OA\Parameter(name="category", in="path", required=true, @OA\Schema(type="integer")),
     * @OA\Parameter(name="per_page", in="query", @OA\Schema(type="integer", default=15)),
     * @OA\Response(
     * response=200,
     * description="List of products in category",
     * @OA\JsonContent(
     * @OA\Property(property="message", type="string", example="Products retrieved by category successfully"),
     * @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/ProductResource"))
     * )
     * )
     * )
     */
    public function products(Category $category, Request $request)
    {
        // Récupérer uniquement les produits visibles pour le public
        $products = $category->products()
            // Assurez-vous que la colonne 'is_visible' existe sur votre modèle Product
            ->where('is_visible', true) 
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 15));

        // Retourne la collection paginée avec la ProductResource
        return ProductResource::collection($products)->additional([
            'message' => 'Products retrieved by category successfully',
            'total' => $products->total(),
            'per_page' => $products->perPage(),
            'current_page' => $products->currentPage(),
        ]);
    }
}