<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Clé étrangère vers la table users (le livreur)
            $table->foreignId('delivery_user_id')->nullable()->after('user_id')->constrained('users');
        

            // NOTE: Si vous voulez une colonne pour la preuve de livraison (à venir)
            // $table->text('proof_data')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Supprimer d'abord la clé étrangère
            $table->dropForeign(['delivery_user_id']);
            $table->dropColumn('delivery_user_id');
            
            // Revenir à l'ancien statut si nécessaire, ou simplement le supprimer
            // Si vous n'utilisiez pas la colonne status, vous pouvez la laisser ou la modifier selon l'état précédent.
        });
    }
};