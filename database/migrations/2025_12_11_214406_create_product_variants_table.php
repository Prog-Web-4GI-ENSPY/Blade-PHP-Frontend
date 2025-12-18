<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Vérifier d'abord si la table existe
        if (!Schema::hasTable('product_variants')) {
            Schema::create('product_variants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('productId')->constrained()->onDelete('cascade');
                $table->string('name');
                $table->string('sku')->unique();
                $table->decimal('price', 10, 2);
                $table->integer('stock')->default(0);
                $table->json('attributes')->nullable();
                $table->timestamps();
                
                $table->index(['productId', 'sku']);
            });
        } else {
            // Si la table existe, ajouter les colonnes manquantes
            Schema::table('product_variants', function (Blueprint $table) {
                if (!Schema::hasColumn('product_variants', 'name')) {
                    $table->string('name')->after('productId');
                }
                if (!Schema::hasColumn('product_variants', 'sku')) {
                    $table->string('sku')->after('name');
                }
                if (!Schema::hasColumn('product_variants', 'price')) {
                    $table->decimal('price', 10, 2)->after('sku');
                }
                if (!Schema::hasColumn('product_variants', 'stock')) {
                    $table->integer('stock')->default(0)->after('price');
                }
                if (!Schema::hasColumn('product_variants', 'attributes')) {
                    $table->json('attributes')->nullable()->after('stock');
                }
            });
        }
    }

    public function down()
    {
        // Ne pas supprimer la table, seulement les colonnes si nécessaire
        Schema::table('product_variants', function (Blueprint $table) {
            $columns = ['name', 'sku', 'price', 'stock', 'attributes'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('product_variants', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};