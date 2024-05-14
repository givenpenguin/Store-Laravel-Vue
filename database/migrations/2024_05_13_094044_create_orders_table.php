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

            $table->string('last_name');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('city');
            $table->string('street');
            $table->string('house');
            $table->string('post_index');
            $table->string('comment')->nullable();

            $table->foreignId('delivery_method_id')->index()->constrained('delivery_methods')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('payment_method_id')->index()->constrained('payment_methods')->onDelete('cascade')->onUpdate('cascade');

            $table->string('promo_code')->nullable();

            $table->float('cost_of_products');
            $table->float('cost_of_delivery');
            $table->float('cost_of_discount');
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
