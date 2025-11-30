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
            $table->string('name');
            $table->text('description');
            $table->decimal('price_delivery', 10, 2);
            $table->decimal('price_pickup', 10, 2);
            $table->integer('qty');
            $table->unsignedBigInteger('category_id');
            $table->boolean('isHighlighted')->default(false);
            $table->string('image')->nullable();
            $table->json('subMenu')->nullable();
            $table->timestamps();
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
