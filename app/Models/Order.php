<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @OA\Schema(
 * schema="Order",
 * title="Order Model",
 * description="Modèle de données complet pour une commande client.",
 * @OA\Property(property="id", type="integer", format="int64", description="ID unique de la commande."),
 * @OA\Property(property="user_id", type="integer", format="int64", description="ID de l'utilisateur qui a passé la commande."),
 * @OA\Property(property="order_number", type="string", description="Numéro unique de la commande (ex: ORD-20251114-abcxyz)."),
 * @OA\Property(
 * property="status",
 * type="string",
 * description="Statut de la commande.",
 * enum={"PENDING", "PROCESSING", "PAID", "SHIPPED", "DELIVERED", "CANCELED", "FAILED", "IN_DELIVERY"}
 * ),
 * @OA\Property(property="subtotal", type="number", format="float", description="Sous-total des articles."),
 * @OA\Property(property="shipping", type="number", format="float", description="Frais de livraison."),
 * @OA\Property(property="tax", type="number", format="float", description="Taxes appliquées."),
 * @OA\Property(property="total", type="number", format="float", description="Prix total final de la commande."),
 * @OA\Property(property="customer_first_name", type="string", description="Prénom du client."),
 * @OA\Property(property="customer_last_name", type="string", description="Nom de famille du client."),
 * @OA\Property(property="customer_email", type="string", format="email", description="Email du client."),
 * @OA\Property(property="customer_phone", type="string", description="Téléphone du client."),
 * @OA\Property(property="shipping_address", type="string", description="Adresse de livraison."),
 * @OA\Property(property="shipping_city", type="string", description="Ville de livraison."),
 * @OA\Property(property="shipping_zipcode", type="string", description="Code postal de livraison."),
 * @OA\Property(property="shipping_country", type="string", description="Pays de livraison."),
 * @OA\Property(property="payment_method", type="string", description="Méthode de paiement utilisée."),
 * @OA\Property(
 * property="items",
 * type="array",
 * description="Articles inclus dans la commande (relation OrderItem).",
 * @OA\Items(ref="#/components/schemas/OrderItem")
 * ),
 * @OA\Property(property="created_at", type="string", format="date-time"),
 * @OA\Property(property="updated_at", type="string", format="date-time"),
 * )
 *
 * /**
 * * Schéma nécessaire pour les réponses de l'API (ex: OrderController->myOrders)
 * * @OA\Schema(
 * * schema="OrderResource",
 * * title="Order Resource",
 * * description="Structure de données pour une commande retournée par l'API (inclut les relations items)",
 * * @OA\Property(property="id", type="integer", example=1),
 * * @OA\Property(property="order_number", type="string", example="ORD-20251114-ABCDEF"),
 * * @OA\Property(property="status", type="string", enum={"PENDING", "PROCESSING", "PAID", "SHIPPED", "DELIVERED", "CANCELED", "FAILED", "IN_DELIVERY"}, example="PAID"),
 * * @OA\Property(property="total", type="number", format="float", example=125.00),
 * * @OA\Property(property="customer_email", type="string", format="email", example="jane.doe@example.com"),
 * * @OA\Property(property="shipping_city", type="string", example="Paris"),
 * * @OA\Property(property="created_at", type="string", format="date-time"),
 * * @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/OrderItemResource"), description="Articles inclus dans la commande"),
 * * )
 * */
class Order extends Model
{
    use HasFactory;

    // --- Constantes de Statut corrigées ---
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_PROCESSING = "PROCESSING";
    public const STATUS_PENDING_PAYMENT = 'PENDING_PAYMENT';
    public const STATUS_PAID = 'PAID';
    public const STATUS_ASSIGNED = 'ASSIGNED';
    public const STATUS_EN_ROUTE = 'EN_ROUTE';
    public const STATUS_SHIPPED='SHIPPED';
    public const STATUS_DELIVERED='DELIVERED'; // Corrigé de 'DELIVERY'
    public const STATUS_CANCELED='CANCELED';   // Corrigé de 'CABCELED'
    public const STATUS_FAILED='FAILED';
    public const STATUS_IN_DELIVERY ='IN_DELIVERY';

    protected $fillable = [
        'order_number', 'status', 'subtotal', 'shipping', 'tax', 'discount', 'total',
        'user_id', 'customer_email', 'customer_name', 'customer_phone',
        'shipping_address', 'shipping_city', 'shipping_zipcode', 'shipping_country',
        'billing_address', 'billing_city', 'billing_zipcode', 'billing_country',
        'payment_method', 'payment_status', 'transaction_id', 'shipping_method', 'notes',
        'processed_at', 'completed_at', 'cancelled_at','delivery_user_id','proof_path' ,'proof_type'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'tax' => 'decimal:2',
        'discount' => 'decimal:2',
        'total' => 'decimal:2',
        'processed_at' => 'datetime',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    // Relations
/**
     * Get the user who placed the order (customer).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    /**
     * Get the delivery user (e.g., driver, logistic manager) for the order.
     */
    public function deliveryUser()
    {
        // Supposons que votre table 'orders' possède une colonne 'delivery_user_id'
        return $this->belongsTo(User::class, 'delivery_user_id'); 
    }

    /**
     * Get the items for the order.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}