<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Cart",
 *     title="Cart",
 *     description="Modèle de données pour un panier d'achat.",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         format="int64",
 *         description="ID unique du panier."
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         format="int64",
 *         description="ID de l'utilisateur associé à ce panier."
 *     ),
 *     @OA\Property(
 *         property="session_id",
 *         type="string",
 *         description="ID de session pour les utilisateurs non connectés."
 *     ),
 *     @OA\Property(
 *         property="items_count",
 *         type="integer",
 *         description="Nombre total d'articles dans le panier."
 *     ),
 *     @OA\Property(
 *         property="total",
 *         type="number",
 *         format="float",
 *         description="Prix total du panier."
 *     ),
 *     @OA\Property(
 *         property="items",
 *         type="array",
 *         description="Liste des articles dans le panier.",
 *         @OA\Items(ref="#/components/schemas/CartItem")
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
 *         "user_id": 101,
 *         "session_id": "abc123def456",
 *         "items_count": 3,
 *         "total": 149.97,
 *         "items": {},
 *         "created_at": "2024-01-15T10:30:00Z",
 *         "updated_at": "2024-01-15T10:35:00Z"
 *     }
 * )
 */
class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'session_id',
        'items_count',
        'total'
    ];

    /**
     * Get the user that owns the cart.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the items for the cart.
     */
    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id'); // Note: 'cartId' si c'est le nom de la colonne
    }

    /**
     * Calculate cart totals
     */
    public function calculateTotals()
    {
        $this->items_count = $this->items()->sum('quantity');
        $this->total = $this->items()->get()->sum(function($item) {
            return $item->unit_price * $item->quantity;
        });
        $this->save();
    }
}