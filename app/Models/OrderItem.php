<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 * schema="OrderItem",
 * title="OrderItem",
 * description="Modèle de données pour un article spécifique dans une commande.",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * description="ID unique de l'article de commande."
 * ),
 * @OA\Property(
 * property="order_id",
 * type="integer",
 * format="int64",
 * description="ID de la commande parente."
 * ),
 * @OA\Property(
 * property="product_id",
 * type="integer",
 * format="int64",
 * description="ID du produit original."
 * ),
 * @OA\Property(
 * property="product_name",
 * type="string",
 * description="Nom du produit au moment de la commande."
 * ),
 * @OA\Property(
 * property="product_sku",
 * type="string",
 * description="SKU du produit au moment de la commande."
 * ),
 * @OA\Property(
 * property="quantity",
 * type="integer",
 * format="int32",
 * description="Quantité commandée."
 * ),
 * @OA\Property(
 * property="unit_price",
 * type="number",
 * format="float",
 * description="Prix unitaire du produit au moment de la commande."
 * ),
 * @OA\Property(
 * property="total",
 * type="number",
 * format="float",
 * description="Prix total (quantité * prix unitaire)."
 * ),
 * example={
 * "id": 1,
 * "order_id": 10,
 * "product_id": 5,
 * "product_name": "T-Shirt Bleu",
 * "product_sku": "TSH-BLU-SM",
 * "quantity": 2,
 * "unit_price": 25.00,
 * "total": 50.00
 * }
 * )
 *
 * /**
 * * Schéma de ressource API pour un article de commande (utilisé dans OrderResource).
 * * @OA\Schema(
 * * schema="OrderItemResource",
 * * title="OrderItem Resource",
 * * description="Représentation d'un article de commande dans les réponses API.",
 * * @OA\Property(property="id", type="integer", example=1),
 * * @OA\Property(property="product_id", type="integer", example=5),
 * * @OA\Property(property="product_name", type="string", example="T-Shirt Bleu"),
 * * @OA\Property(property="product_sku", type="string", example="TSH-BLU-SM"),
 * * @OA\Property(property="quantity", type="integer", example=2),
 * * @OA\Property(property="unit_price", type="number", format="float", example=25.00),
 * * @OA\Property(property="total", type="number", format="float", example=50.00)
 * * )
 * */
class OrderItem extends Model
{
    use HasFactory;
    
    // Assurez-vous d'avoir les relations et $fillable nécessaires ici
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'unit_price',
        'total',
        'product_name',
        'product_sku',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product variant associated with the order item.
     */
    public function productVariant()
    {
        // Supposons que la clé étrangère est 'product_variant_id'
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    /**
     * Get the product associated with the order item.
     */
    public function product()
    {
        // Supposons que la clé étrangère est 'product_id'
        return $this->belongsTo(Product::class, 'product_id');
    }
}