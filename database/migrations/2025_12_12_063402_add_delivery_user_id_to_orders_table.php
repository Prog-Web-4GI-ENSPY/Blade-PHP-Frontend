<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   // Fichier : ..._add_delivery_user_id_to_orders_table.php

public function up(): void
{
    Schema::table('orders', function (Blueprint $table) {
        // Ajout de la condition pour vérifier si la colonne n'existe PAS
        if (!Schema::hasColumn('orders', 'delivery_user_id')) {
            $table->foreignId('delivery_user_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained('users')
                  ->onDelete('set null');
        }
    });
}

public function down(): void
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropForeign(['delivery_user_id']);
        $table->dropColumn('delivery_user_id');
    });
}
};
