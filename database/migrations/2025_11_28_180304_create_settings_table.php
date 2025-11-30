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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('siteName');
            $table->string('logo');
            $table->string('favicon');
            $table->string('metaTitle');
            $table->string('metaDescription');
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->string('contact');
            $table->string('currency');
            $table->string('order_outside_time');
            $table->string('minOrder');
            $table->json('services');
            $table->json('openingHours');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
