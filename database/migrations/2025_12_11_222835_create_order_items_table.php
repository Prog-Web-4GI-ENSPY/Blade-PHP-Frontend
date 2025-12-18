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
        // La table s'appelle généralement 'order_items' dans Laravel pour le modèle OrderItem
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Clé étrangère vers la commande parente
            $table->foreignId('order_id')
                  ->constrained('orders') // Assurez-vous que la table 'orders' existe déjà
                  ->onDelete('cascade');

            // Clé étrangère vers le produit (peut être null si le produit est supprimé)
            $table->foreignId('product_id')
                  ->nullable()
                  ->constrained('products') // Assurez-vous que la table 'products' existe déjà
                  ->onDelete('set null');

            // Détails du produit au moment de la commande (pour historisation)
            $table->string('product_name'); 
            $table->string('product_sku')->nullable();

            // Détails de l'article
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2); // Prix unitaire au moment de la commande
            $table->decimal('total', 10, 2); // Prix total (quantity * unit_price)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};