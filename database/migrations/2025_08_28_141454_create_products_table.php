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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('code', 255)->unique();
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->string('product_image', 255)->nullable();
            $table->decimal('purchase_price', 10,2)->default(0);
            $table->decimal('selling_price', 10,2)->default(0);
            $table->integer('min_stock')->default(0);
            $table->integer('max_stock')->default(0);
            $table->string('presentation', 50)->default('unidad');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
