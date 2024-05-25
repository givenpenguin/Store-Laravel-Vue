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
            $table->foreignId('customer_id')->index()->constrained('customers');

            $table->jsonb('products');

            $table->string('comment')->nullable();

            $table->string('delivery_method');
            $table->string('payment_method');

            $table->float('amount_of_products');
            $table->float('amount_of_delivery');
            $table->float('amount_of_discount');
            $table->float('total_price');

            $table->string('order_status')->default('Создан');
            $table->string('track_number')->nullable();

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
