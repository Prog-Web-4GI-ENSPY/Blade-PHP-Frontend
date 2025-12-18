<?php
// database/migrations/..._create_delivery_geolocations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_geolocations', function (Blueprint $table) {
            $table->id();
            // Clé étrangère vers l'utilisateur (le livreur)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Coordonnées GPS
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            
            // Timestamp de la mise à jour (important pour la fraîcheur des données)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_geolocations');
    }
};