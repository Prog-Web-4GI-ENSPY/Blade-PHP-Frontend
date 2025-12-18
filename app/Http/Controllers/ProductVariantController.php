<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

/**
 * @OA\Tag(
 * name="Product Variants",
 * description="Gestion des variantes (tailles, couleurs, etc.) d'un produit."
 * )

 */
class ProductVariantController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/products/{product}/variants",
     * summary="Get all variants for a product",
     * tags={"Product Variants"},
     * @OA\Parameter(
     * name="product",
     * in="path",
     * required=true,
     * description="Product ID",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="List of product variants",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(
     * property="data",
     * type="array",
     * @OA\Items(ref="#/components/schemas/ProductVariant")
     * ),
     * @OA\Property(property="message", type="string", example="Variantes récupérées"),
     * @OA\Property(property="code", type="integer", example=200)
     * )
     * ),
     * @OA\Response(
     * response=404,
     * description="Product not found"
     * )
     * )
     */
    public function index($productId)
    {
        try {
            $product = Product::findOrFail($productId);
            // Charger la relation 'images' si elle existe (ou 'image' si c'est un champ direct)
            $variants = ProductVariant::where('productId', $productId)
                ->get();
            
            return response()->json([
                'status' => 'success',
                'data' => $variants,
                'message' => 'Variantes récupérées',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produit non trouvé',
                'code' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

  /**
 * @OA\Post(
 * path="/api/products/{product}/variants",
 * summary="Create a new product variant",
 * tags={"Product Variants"},
 * security={{"bearerAuth":{}}},
 * @OA\Parameter(
 * name="product",
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
 * required={"name", "sku", "price", "stock", "color"},
 * @OA\Property(
 * property="name",
 * type="string",
 * example="T-Shirt Rouge - L"
 * ),
 * @OA\Property(
 * property="sku",
 * type="string",
 * example="TSH-RED-L"
 * ),
 * @OA\Property(
 * property="price",
 * type="number",
 * format="float",
 * example=29.99
 * ),
 * @OA\Property(
 * property="stock",
 * type="integer",
 * example=50
 * ),
 * @OA\Property(
 * property="color",
 * type="string",
 * example="red"
 * ),
 * @OA\Property(
 * property="attributes",
 * type="object",
 * example={"color": "red", "size": "L"}
 * ),
 * @OA\Property(
 * property="image",
 * type="string",
 * format="binary", 
 * nullable=true,
 * description="Main variant image file"
 * )
 * )
 * )
 * ),
 * @OA\Response(
 * response=201,
 * description="Variant created successfully",
 * @OA\JsonContent(
 * type="object",
 * @OA\Property(property="status", type="string", example="success"),
 * @OA\Property(property="data", ref="#/components/schemas/ProductVariant"),
 * @OA\Property(property="message", type="string", example="Variante créée avec succès"),
 * @OA\Property(property="code", type="integer", example=201)
 * )
 * ),
 * @OA\Response(
 * response=422,
 * description="Validation error"
 * )
 * )
 */
    public function store(Request $request, $productId)
    {
        try {
            $product = Product::findOrFail($productId);
            
            // CORRECTION: Convertir la chaîne JSON 'attributes' en tableau PHP avant la validation
            if ($request->has('attributes') && is_string($request->input('attributes'))) {
                $decodedAttributes = json_decode($request->input('attributes'), true);
                if (is_array($decodedAttributes)) {
                    $request->merge(['attributes' => $decodedAttributes]);
                }
            }

            $request->validate([
                'name' => 'required|string|max:255',
                'sku' => [
                    'required',
                    'string',
                    'max:100',
                    Rule::unique('product_variants')->where(function ($query) use ($productId) {
                        return $query->where('productId', $productId);
                    })
                ],
                'price' => 'required|numeric|min:0',
                'stock' => 'required|integer|min:0',
                'color' => 'required|string|max:50',
                'attributes' => 'nullable|array',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            ]);
            
            DB::beginTransaction();

            // LOGIQUE D'UPLOAD DE L'IMAGE
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Stocke le fichier sur le disque 'public' dans le dossier 'variants'
                $imagePath = $request->file('image')->store('variants', 'public');
            }
            
            $variant = ProductVariant::create([
                'productId' => $productId,
                'name' => $request->name,
                'sku' => $request->sku,
                'price' => $request->price,
                'stock' => $request->stock,
                'color' => $request->color,
                'attributes' => $request->attributes ?? [],
                'image' => $imagePath, // ENREGISTRE LE CHEMIN
            ]);
            
            // Mettre à jour le stock du produit
            $totalStock = ProductVariant::where('productId', $productId)->sum('stock');
            $product->update(['stock' => $totalStock]);
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'data' => $variant,
                'message' => 'Variante créée avec succès',
                'code' => 201
            ], 201);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
                'code' => 422
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Produit non trouvé',
                'code' => 404
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * @OA\Get(
     * path="/api/variants/{variant}",
     * summary="Get a specific product variant",
     * tags={"Product Variants"},
     * @OA\Parameter(
     * name="variant",
     * in="path",
     * required=true,
     * description="Variant ID",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Variant details",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="data", ref="#/components/schemas/ProductVariant"),
     * @OA\Property(property="message", type="string", example="Variante récupérée"),
     * @OA\Property(property="code", type="integer", example=200)
     * )
     * ),
     * @OA\Response(
     * response=404,
     * description="Variant not found"
     * )
     * )
     */
    public function show($variantId)
    {
        try {
            $variant = ProductVariant::findOrFail($variantId);
            
            return response()->json([
                'status' => 'success',
                'data' => $variant,
                'message' => 'Variante récupérée',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Variante non trouvée',
                'code' => 404
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * @OA\Post(
     * path="/api/variants/{variant}",
     * summary="Update a product variant (Use POST with _method=PUT for file upload)",
     * tags={"Product Variants"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="variant",
     * in="path",
     * required=true,
     * description="Variant ID",
     * @OA\Schema(type="integer")
     * ),
     * @OA\RequestBody(
     * required=true,
     * @OA\MediaType(
     * mediaType="multipart/form-data", 
     * @OA\Schema(
     * @OA\Property(property="_method", type="string", example="PUT", description="Required for method spoofing with multipart/form-data"), 
     * @OA\Property(property="name", type="string", example="T-Shirt Rouge - L"),
     * @OA\Property(property="sku", type="string", example="TSH-RED-L"),
     * @OA\Property(property="price", type="number", format="float", example=29.99),
     * @OA\Property(property="stock", type="integer", example=50),
     * @OA\Property(property="color", type="string", example="red"),
     * @OA\Property(property="attributes", type="object", example={"color": "red", "size": "L"}),
     * @OA\Property(property="image", type="string", format="binary", nullable=true, description="New variant image file"), 
     * @OA\Property(property="remove_image", type="boolean", nullable=true, example=false, description="Set to true to delete current image.") 
     * )
     * )
     * ),
     * @OA\Response(
     * response=200,
     * description="Variant updated successfully",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="data", ref="#/components/schemas/ProductVariant"),
     * @OA\Property(property="message", type="string", example="Variante mise à jour"),
     * @OA\Property(property="code", type="integer", example=200)
     * )
     * ),
     * @OA\Response(
     * response=422,
     * description="Validation error"
     * )
     * )
     */
    public function update(Request $request, $variantId)
    {
        try {
            $variant = ProductVariant::findOrFail($variantId);
            
            // CORRECTION: Convertir la chaîne JSON 'attributes' en tableau PHP avant la validation
            if ($request->has('attributes') && is_string($request->input('attributes'))) {
                $decodedAttributes = json_decode($request->input('attributes'), true);
                if (is_array($decodedAttributes)) {
                    $request->merge(['attributes' => $decodedAttributes]);
                }
            }

            $request->validate([
                'name' => 'sometimes|string|max:255',
                'sku' => [
                    'sometimes',
                    'string',
                    'max:100',
                    Rule::unique('product_variants')
                        ->ignore($variantId)
                        ->where(function ($query) use ($variant) {
                            return $query->where('productId', $variant->productId);
                        })
                ],
                'price' => 'sometimes|numeric|min:0',
                'stock' => 'sometimes|integer|min:0',
                'color' => 'sometimes|string|max:50',
                'attributes' => 'sometimes|array',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
                'remove_image' => 'sometimes|boolean', 
            ]);
            
            DB::beginTransaction();
            
            $validatedData = $request->only(['name', 'sku', 'price', 'stock', 'color', 'attributes']);

            // LOGIQUE DE MISE À JOUR DE L'IMAGE
            // 1. Suppression de l'ancienne image si demandée
            if ($request->boolean('remove_image')) {
                if ($variant->image) {
                    Storage::disk('public')->delete($variant->image);
                }
                $validatedData['image'] = null;
            }

            // 2. Upload de la nouvelle image
            if ($request->hasFile('image')) {
                // Supprimer l'ancienne image si elle existe
                if ($variant->image) {
                    Storage::disk('public')->delete($variant->image);
                }
                $path = $request->file('image')->store('variants', 'public');
                $validatedData['image'] = $path;
            }

            $variant->update($validatedData);
            
            // Mettre à jour le stock du produit parent
            $product = Product::find($variant->productId);
            if ($product) {
                $totalStock = ProductVariant::where('productId', $variant->productId)->sum('stock');
                $product->update(['stock' => $totalStock]);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'data' => $variant,
                'message' => 'Variante mise à jour',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur de validation',
                'errors' => $e->errors(),
                'code' => 422
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Variante non trouvée',
                'code' => 404
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    /**
     * @OA\Delete(
     * path="/api/variants/{variant}",
     * summary="Delete a product variant",
     * tags={"Product Variants"},
     * security={{"bearerAuth":{}}},
     * @OA\Parameter(
     * name="variant",
     * in="path",
     * required=true,
     * description="Variant ID",
     * @OA\Schema(type="integer")
     * ),
     * @OA\Response(
     * response=200,
     * description="Variant deleted successfully",
     * @OA\JsonContent(
     * type="object",
     * @OA\Property(property="status", type="string", example="success"),
     * @OA\Property(property="message", type="string", example="Variante supprimée"),
     * @OA\Property(property="code", type="integer", example=200)
     * )
     * ),
     * @OA\Response(
     * response=404,
     * description="Variant not found"
     * )
     * )
     */
    public function destroy($variantId)
    {
        try {
            $variant = ProductVariant::findOrFail($variantId);
            
            DB::beginTransaction();
            
            $productId = $variant->productId;
            
            // LOGIQUE DE SUPPRESSION DE L'IMAGE
            if ($variant->image) {
                Storage::disk('public')->delete($variant->image);
            }

            $variant->delete();
            
            // Mettre à jour le stock du produit parent
            $product = Product::find($productId);
            if ($product) {
                $totalStock = ProductVariant::where('productId', $productId)->sum('stock');
                $product->update(['stock' => $totalStock]);
            }
            
            DB::commit();
            
            return response()->json([
                'status' => 'success',
                'message' => 'Variante supprimée',
                'code' => 200
            ], 200);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Variante non trouvée',
                'code' => 404
            ], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur serveur: ' . $e->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}