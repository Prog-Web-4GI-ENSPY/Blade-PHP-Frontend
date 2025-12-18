<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder; // Import de Builder pour le type hint

/**
 * @OA\Schema(
 * schema="User",
 * title="User",
 * description="Modèle de données pour un utilisateur",
 * @OA\Property(
 * property="id",
 * type="integer",
 * description="ID de l'utilisateur"
 * ),
 * @OA\Property(
 * property="name",
 * type="string",
 * description="Nom complet de l'utilisateur"
 * ),
 * @OA\Property(
 * property="email",
 * type="string",
 * format="email",
 * description="Adresse email unique"
 * ),
 * @OA\Property(
 * property="phone",
 * type="string",
 * format="string",
 * description="Numero de telephone",
 * nullable=true
 * ),
 * @OA\Property(
 * property="address",
 * type="string",
 * format="string",
 * description="Adresse",
 * nullable=true
 * ),
 * @OA\Property(
 * property="role",
 * type="string",
 * description="Rôle de l'utilisateur",
 * enum={"ADMIN", "VENDOR", "CUSTOMER", "DELIVERY", "MANAGER", "SUPERVISOR"}
 * ),
 * @OA\Property(
 * property="created_at",
 * type="string",
 * format="date-time",
 * description="Date de création de l'utilisateur"
 * ),
 * @OA\Property(
 * property="updated_at",
 * type="string",
 * format="date-time",
 * description="Date de dernière mise à jour"
 * )
 * )
 *
 * @OA\Schema(
 * schema="UserResource",
 * title="User Resource",
 * description="Structure de données utilisateur utilisée dans les réponses API (masque le mot de passe)",
 * @OA\Property(property="id", type="integer", example=1),
 * @OA\Property(property="name", type="string", example="Alice Smith"),
 * @OA\Property(property="email", type="string", format="email", example="alice@example.com"),
 * @OA\Property(property="role", type="string", enum={"ADMIN", "VENDOR", "CUSTOMER", "DELIVERY", "MANAGER", "SUPERVISOR"}, example="CUSTOMER"),
 * @OA\Property(property="phone", type="string", nullable=true, example="+33612345678"),
 * @OA\Property(property="address", type="string", nullable=true, example="123 Rue de la Liberté"),
 * @OA\Property(property="created_at", type="string", format="date-time"),
 * @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Définition des constantes de rôles (Utilisation de 'CUSTOMER' au lieu de 'CLIENT' pour la cohérence avec votre constante)
    public const ROLE_ADMIN = 'ADMIN';
    public const ROLE_VENDOR = 'VENDOR';
    public const ROLE_CLIENT = 'CUSTOMER'; // La constante ROLE_CLIENT est 'CUSTOMER'
    public const ROLE_DELIVERY = 'DELIVERY';
    public const ROLE_MANAGER = 'MANAGER';
    public const ROLE_SUPERVISOR = 'SUPERVISOR';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
        'address'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
    ];

    /**
     * Vérifie si l'utilisateur possède l'un des rôles spécifiés.
     * @param array|string $roles Les rôles à vérifier (un seul rôle ou un tableau de rôles).
     * @return bool
     */
    public function hasAnyRole(array|string $roles): bool
    {
        // Convertit le rôle unique en tableau si nécessaire
        if (is_string($roles)) {
            $roles = [$roles];
        }

        // Vérifie si le rôle de l'utilisateur est inclus dans la liste des rôles requis
        return in_array($this->role, $roles);
    }
    // --- RELATIONS ---

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function geolocation()
    {
        // Supposons que DeliveryGeolocation existe
        return $this->hasOne(DeliveryGeolocation::class);
    }

    // --- UTILITAIRES / ACCESSEURS ---

    /**
     * Méthode utilitaire pour obtenir le panier actif (si le modèle Cart est bien défini).
     */
    public function cart()
    {
        return $this->carts()->latest()->first();
    }
    
    // --- VÉRIFICATIONS DE RÔLES ---

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isVendor(): bool
    {
        return $this->role === self::ROLE_VENDOR;
    }

    public function isDelivery(): bool
    {
        return $this->role === self::ROLE_DELIVERY;
    }

    public function isClient(): bool
    {
        // Utilise la constante ROLE_CLIENT ('CUSTOMER')
        return $this->role === self::ROLE_CLIENT; 
    }

    public function isSupervisor(): bool
    {
        return $this->role === self::ROLE_SUPERVISOR;
    }
    public function isManager(): bool
    {
        return $this->role === self::ROLE_MANAGER;
    }

    // --- SCOPES ---

    /**
     * Scope pour filtrer par rôle (méthode scope[NomDuScope])
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdmins(Builder $query): Builder
    {
        return $query->where('role', self::ROLE_ADMIN);
    }

    public function scopeVendors(Builder $query): Builder
    {
        return $query->where('role', self::ROLE_VENDOR);
    }

    public function scopeDelivery(Builder $query): Builder
    {
        return $query->where('role', self::ROLE_DELIVERY);
    }

    public function scopeClients(Builder $query): Builder
    {
        // Utilise la constante ROLE_CLIENT ('CUSTOMER')
        return $query->where('role', self::ROLE_CLIENT); 
    }
    
    public function scopeManagers(Builder $query): Builder
    {
        return $query->where('role', self::ROLE_MANAGER);
    }

    public function scopeSupervisors(Builder $query): Builder
    {
        return $query->where('role', self::ROLE_SUPERVISOR);
    }
}