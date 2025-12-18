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
            // Assurez-vous d'avoir le paquet 'doctrine/dbal' installé
            // Si la colonne est définie comme string, augmentez sa longueur à 30
            $table->string('status', 30)->change();
            
            // Si la colonne était ENUM, vous devriez la redéfinir :
            // $table->enum('status', ['PENDING', 'PROCESSING', 'PAID', 'SHIPPED', 'DELIVERED', 'CANCELED', 'FAILED', 'PENDING_PAYMENT'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Inversez le changement pour revenir à la définition d'origine (par exemple 20)
            $table->string('status', 20)->change(); 
        });
    }
};