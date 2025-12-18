<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            // Rendre la colonne image nullable
            $table->string('image')->nullable()->change();
            
            // Optionnel: renommer productId en productId si nécessaire
            if (Schema::hasColumn('product_variants', 'productId') && 
                !Schema::hasColumn('product_variants', 'productId')) {
                $table->renameColumn('productId', 'productId');
            }
        });
    }

    public function down()
    {
        Schema::table('product_variants', function (Blueprint $table) {
            // Revenir à non nullable
            $table->string('image')->nullable(false)->change();
            
            // Re-renommer si nécessaire
            if (Schema::hasColumn('product_variants', 'productId') && 
                !Schema::hasColumn('product_variants', 'productId')) {
                $table->renameColumn('productId', 'productId');
            }
        });
    }
};