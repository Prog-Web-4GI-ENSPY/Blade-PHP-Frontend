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
       Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('order_number')->unique();
    $table->enum('status', ['pending','processing','shipped','completed','cancelled'])->default('pending');
    $table->decimal('subtotal', 10, 2)->default(0);
    $table->decimal('shipping', 10, 2)->default(0);
    $table->decimal('tax', 10, 2)->default(0);
    $table->decimal('total', 10, 2)->default(0);
    $table->string('customer_first_name');
    $table->string('customer_last_name');
    $table->string('customer_email');
    $table->string('customer_phone')->nullable();
    $table->string('shipping_address');
    $table->string('shipping_city');
    $table->string('shipping_zipcode');
    $table->string('shipping_country');
    $table->string('billing_address')->nullable();
    $table->string('billing_city')->nullable();
    $table->string('billing_zipcode')->nullable();
    $table->string('billing_country')->nullable();
    $table->string('payment_method')->nullable();
    $table->text('notes')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
