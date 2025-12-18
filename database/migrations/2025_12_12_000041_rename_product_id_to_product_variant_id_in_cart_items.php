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
             // Renommer la colonne
            $table->renameColumn('product_id', 'product_variant_id');
            
            // Optionnel : renommer la clé étrangère si elle existe
            $table->dropForeign(['product_id']);
            $table->foreign('product_variant_id')->references('id')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->renameColumn('product_variant_id', 'product_id');
            $table->dropForeign(['product_variant_id']);
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }
};
