<?php
// database/migrations/..._add_proof_columns_to_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('proof_path')->nullable()->after('status');
            $table->string('proof_type')->nullable()->after('proof_path'); // 'photo', 'signature', 'qr'
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['proof_path', 'proof_type']);
        });
    }
};