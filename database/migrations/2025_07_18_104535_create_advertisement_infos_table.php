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
        Schema::create('advertisement_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id')->constrained('advertisements');
            $table->unsignedBigInteger('fuel_type_id');
            $table->unsignedBigInteger('ban_id');
            $table->integer('year');
            $table->unsignedBigInteger('color_id');
            $table->integer('distance')->default(0);
            $table->integer('vin_code')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_infos');
    }
};
