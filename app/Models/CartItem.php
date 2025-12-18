<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="CartItem",
 *     title="CartItem",
 *     description="Modèle de données pour un article dans un panier.",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="ID unique de l'article"
 *     ),
 *     @OA\Property(
 *         property="cart_id",
 *         type="integer",
 *         format="int64",
 *         description="ID du panier"
 *     ),
 *     @OA\Property(
 *         property="product_variant_id",
 *         type="integer",
 *         format="int64",
 *         description="ID du produit (ou variante) - À CHANGER"
 *     ),
 *     @OA\Property(
 *         property="quantity",
 *         type="integer",
 *         description="Quantité de ce produit dans le panier."
 *     ),
 *     @OA\Property(
 *         property="unit_price",
 *         type="number",
 *         format="float",
 *         description="Prix unitaire au moment de l'ajout."
 *     ),
 *     @OA\Property(
 *         property="total",
 *         type="number",
 *         format="float",
 *         description="Prix total pour cet article"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         description="Date de création"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         description="Date de mise à jour"
 *     ),
 *     example={
 *         "id": 1,
 *         "cart_id": 5,
 *         "product_variant_id": 10,
 *         "quantity": 2,
 *         "unit_price": 24.99,
 *         "total": 49.98,
 *         "created_at": "2024-01-15T10:30:00Z",
 *         "updated_at": "2024-01-15T10:35:00Z"
 *     }
 * )
 */
class CartItem extends Model
{
    use HasFactory;
    
    // TES COLONNES RÉELLES
    protected $fillable = [
        "quantity",
        "cart_id",
        "product_variant_id", // C'est product_variant_id, pas product_variant_id
        "unit_price",
        "total"
    ];

    // Ajoute un attribut calculé pour total si nécessaire
    protected $appends = ['total'];

    public function getTotalAttribute()
    {
        return $this->unit_price * $this->quantity;
    }

    /**
     * Get the cart that owns the item.
     */
    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    /**
     * Relation vers le produit parent.
     */
    public function product()
    {
        // Assurez-vous que la colonne 'product_id' existe dans la table 'cart_items'
        return $this->belongsTo(Product::class, 'product_id'); 
    }
    /**
     * Get the product VARIANT (pas le produit).
     * Note: la colonne s'appelle product_variant_id mais devrait référencer product_variants
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    /**
     * Calculate item total
     */
    public function calculateTotal()
    {
        $this->total = $this->unit_price * $this->quantity;
        $this->save();
    }
}