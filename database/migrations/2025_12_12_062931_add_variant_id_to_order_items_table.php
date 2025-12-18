<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
// Fichier : ..._add_variant_id_to_order_items_table.php

public function up(): void
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->foreignId('product_variant_id')
              ->nullable() // Peut être null si l'article n'est pas une variante
              ->after('product_id')
              ->constrained('product_variants')
              ->onDelete('set null');
    });
}

public function down(): void
{
    Schema::table('order_items', function (Blueprint $table) {
        $table->dropForeign(['product_variant_id']);
        $table->dropColumn('product_variant_id');
    });
}
};
