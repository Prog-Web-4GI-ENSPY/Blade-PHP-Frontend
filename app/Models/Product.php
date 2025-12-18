<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

/**
 * @OA\Schema(
 * schema="Product",
 * title="Product",
 * description="Modèle de données pour un produit de la boutique",
 * @OA\Property(property="id", type="integer", description="ID du produit"),
 * @OA\Property(property="category_id", type="integer", nullable=true, description="ID de la catégorie associée"),
 * @OA\Property(property="name", type="string", description="Nom du produit"),
 * @OA\Property(property="slug", type="string", description="Slug unique pour l'URL"),
 * @OA\Property(property="description", type="string", nullable=true, description="Description détaillée"),
 * @OA\Property(property="price", type="number", format="float", description="Prix actuel"),
 * @OA\Property(property="compare_price", type="number", format="float", nullable=true, description="Ancien prix pour afficher une réduction"),
 * @OA\Property(property="stock", type="integer", description="Quantité en stock"),
 * @OA\Property(property="sku", type="string", nullable=true, description="Code SKU"),
 * @OA\Property(property="barcode", type="string", nullable=true, description="Code-barres"),
 * @OA\Property(property="is_visible", type="boolean", description="Visibilité sur la boutique (true/false)"),
 * @OA\Property(property="is_featured", type="boolean", description="Produit mis en avant sur la page d'accueil"),
 * @OA\Property(property="published_at", type="string", format="date-time", nullable=true, description="Date de publication"),
 * @OA\Property(property="meta_title", type="string", nullable=true, description="Titre SEO"),
 * @OA\Property(property="meta_description", type="string", nullable=true, description="Description SEO"),
 * @OA\Property(property="image", type="string", nullable=true, description="Chemin de l'image principale"),
 * @OA\Property(property="gallery", type="array", @OA\Items(type="string"), description="Galerie d'images"),
 * @OA\Property(property="created_at", type="string", format="date-time"),
 * @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * * @OA\Schema(
 * schema="ProductResource",
 * title="Product Resource",
 * description="Structure de données d'un produit dans les réponses API (utilisée par ProductResource).",
 * @OA\Property(property="id", type="integer", example=101),
 * @OA\Property(property="category_id", type="integer", example=5),
 * @OA\Property(property="name", type="string", example="Smartphone X10"),
 * @OA\Property(property="slug", type="string", example="smartphone-x10"),
 * @OA\Property(property="price", type="number", format="float", example=799.99),
 * @OA\Property(property="formatted_price", type="string", example="799,99 €", description="Prix formaté par l'accessoire"),
 * @OA\Property(property="has_discount", type="boolean", example=true),
 * @OA\Property(property="discount_percentage", type="integer", example=10, nullable=true),
 * @OA\Property(property="image", type="string", example="/storage/products/x10.jpg", nullable=true),
 * @OA\Property(property="is_visible", type="boolean", example=true),
 * @OA\Property(property="created_at", type="string", format="date-time"),
 * )
 */
class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'compare_price', 'stock',
        'sku', 'barcode', 'is_visible', 'is_featured', 'published_at',
        'meta_title', 'meta_description', 'image', 'gallery', 'category_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'compare_price' => 'decimal:2',
        'is_visible' => 'boolean',
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'gallery' => 'array',
    ];

    protected $appends = [
        'formatted_price', 
        'has_discount', 
        'discount_percentage'
    ];

    



      /**
     * Get the variants for the product.
     */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    /**
     * Mutator: Assure que le slug est généré automatiquement si non fourni.
     * @param string $value
     */
    public function setNameAttribute(string $value): void
    {
        $this->attributes['name'] = $value;
        if (!isset($this->attributes['slug']) || is_null($this->attributes['slug'])) {
            $this->attributes['slug'] = Str::slug($value);
        }
    }

    // Relation avec Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relation avec CartItem
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Relation avec OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopeVisible($query)
    {
        return $query->where('is_visible', true)
                    ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Accessors
    
    /**
     * Accesseur: Retourne le prix formaté en devise.
     */
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2, ',', ' ') . ' €';
    }

    /**
     * Accesseur: Indique si le produit a un prix de comparaison.
     */
    public function getHasDiscountAttribute(): bool
    {
        return !is_null($this->compare_price) && $this->compare_price > $this->price;
    }

    /**
     * Accesseur: Calcule le pourcentage de réduction.
     */
    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->has_discount) return null;
        
        return round(($this->compare_price - $this->price) / $this->compare_price * 100);
    }
}