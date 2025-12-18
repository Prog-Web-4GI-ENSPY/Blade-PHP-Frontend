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
        Schema::table('carts', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('user_id');
            $table->integer('items_count')->default(0)->after('session_id');
            $table->decimal('total', 10, 2)->default(0)->after('items_count');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            if (!Schema::hasColumn('cart_items', 'unit_price')) {
            $table->decimal('unit_price', 10, 2)->after('quantity');
        }
        if (!Schema::hasColumn('cart_items', 'total')) {
            $table->decimal('total', 10, 2)->after('unit_price');
        }
            
        });
    }
};
