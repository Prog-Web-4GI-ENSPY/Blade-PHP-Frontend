<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryGeolocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'latitude',
        'longitude',
    ];

    /**
     * Une géolocalisation appartient à un utilisateur (livreur).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}