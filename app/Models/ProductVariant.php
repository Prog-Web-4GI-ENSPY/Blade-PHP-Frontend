<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="ProductVariant",
 *     title="ProductVariant",
 *     description="Modèle de données pour une variante de produit",
 *     required={"productId", "name", "sku", "price", "stock", "color"},
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="ID unique"
 *     ),
 *     @OA\Property(
 *         property="productId",
 *         type="integer",
 *         description="ID du produit parent"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nom de la variante"
 *     ),
 *     @OA\Property(
 *         property="sku",
 *         type="string",
 *         description="Code SKU"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="number",
 *         format="float",
 *         description="Prix"
 *     ),
 *     @OA\Property(
 *         property="stock",
 *         type="integer",
 *         description="Quantité en stock"
 *     ),
 *     @OA\Property(
 *         property="color",
 *         type="string",
 *         description="Couleur"
 *     ),
 *     @OA\Property(
 *         property="attributes",
 *         type="object",
 *         description="Attributs de la variante"
 *     ),
 *     @OA\Property(
 *         property="image",
 *         type="string",
 *         description="Image de la variante"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time"
 *     ),
 *     example={
 *         "id": 1,
 *         "productId": 5,
 *         "name": "T-Shirt Rouge - L",
 *         "sku": "TSH-RED-L",
 *         "price": 29.99,
 *         "stock": 50,
 *         "color": "red",
 *         "attributes": {"color": "red", "size": "L"},
 *         "image": "tshirt-red-l.jpg",
 *         "created_at": "2024-01-15T10:30:00Z",
 *         "updated_at": "2024-01-15T10:35:00Z"
 *     }
 * )
 */
class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'productId',
        'name',
        'sku',
        'price',
        'stock',
        'color',
        'attributes',
        'image'
    ];

    protected $casts = [
        'attributes' => 'array',
        'price' => 'decimal:2'
    ];

    protected $attributes = [
        'color' => '',
        'attributes' => null,
        'image' => null
    ];

    /**
     * Get the product that owns the variant.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    /**
     * Get the images for the variant.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_variant_id');
    }

    /**
     * Get the cart items for this variant.
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'productVariantId');
    }
}