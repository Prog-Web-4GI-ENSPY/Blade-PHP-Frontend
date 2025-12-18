<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 * schema="Category",
 * title="Category",
 * description="Modèle de données pour une catégorie de produits.",
 * @OA\Property(
 * property="id",
 * type="integer",
 * format="int64",
 * description="ID unique de la catégorie."
 * ),
 * @OA\Property(
 * property="name",
 * type="string",
 * description="Nom de la catégorie."
 * ),
 * @OA\Property(
 * property="slug",
 * type="string",
 * description="Slug pour URL."
 * ),
 * @OA\Property(
 * property="description",
 * type="string",
 * nullable=true,
 * description="Description de la catégorie."
 * ),
 * @OA\Property(
 * property="image",
 * type="string",
 * nullable=true,
 * description="Chemin vers l'image de la catégorie."
 * ),
 * @OA\Property(
 * property="is_visible",
 * type="boolean",
 * description="Visibilité de la catégorie (true si visible)."
 * ),
 * @OA\Property(
 * property="position",
 * type="integer",
 * description="Ordre d'affichage de la catégorie."
 * ),
 * example={
 * "id": 1,
 * "name": "Électronique",
 * "slug": "electronique",
 * "description": "Appareils et gadgets électroniques.",
 * "image": "categories/electro.jpg",
 * "is_visible": true,
 * "position": 1
 * }
 * )
 * * * @OA\Schema(
 * schema="CategoryResource",
 * title="Category Resource",
 * description="Structure de données pour une catégorie dans les réponses API.",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Électronique"),
 * @OA\Property(property="slug", type="string", example="electronique"),
 * @OA\Property(property="description", type="string", example="Appareils et gadgets électroniques.", nullable=true),
 * @OA\Property(property="image", type="string", example="path/to/image.jpg", nullable=true),
 * @OA\Property(property="is_visible", type="boolean", example=true),
 * @OA\Property(property="position", type="integer", example=1),
 * @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-26T14:00:00.000000Z"),
 * @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-26T14:00:00.000000Z")
 * )
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image', // Assurez-vous d'avoir 'image' si le contrôleur l'utilise
        'is_visible',
        'position',
    ];
    
    /**
     * Une catégorie a plusieurs produits.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}