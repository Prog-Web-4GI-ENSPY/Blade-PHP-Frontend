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
        Schema::table('cart_items', function (Blueprint $table) {
            // Ajout uniquement de 'total', car 'unit_price' provoque l'erreur 1060.
            $table->decimal('total', 8, 2)->after('unit_price'); 
        });
    }
    
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('total'); // On ne supprime que ce qu'on a ajouté ici.
        });
    }
};