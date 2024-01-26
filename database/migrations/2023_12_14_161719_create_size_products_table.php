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
        Schema::create('size_product', function (Blueprint $table) {
            $table->id();

            $table->foreignId('size_id')->nullable()->index()->constrained('sizes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('product_id')->nullable()->index()->constrained('products')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('size_product');
    }
};
