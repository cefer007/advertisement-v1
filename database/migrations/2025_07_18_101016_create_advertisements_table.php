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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('car_id')->constrained('cars');
            $table->unsignedBigInteger('car_model_id')->constrained('car_models');
            $table->unsignedBigInteger('created_by')->constrained('site_users');
            $table->integer('status')->default(1);
            $table->dateTime('expire_date')->nullable();
            $table->integer('views')->default(0);
            $table->integer('price')->default(0);
            $table->unsignedBigInteger('currency_id')->constrained('currencies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
