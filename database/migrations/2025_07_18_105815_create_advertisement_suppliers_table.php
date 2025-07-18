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
        Schema::create('advertisement_suppliers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id')->constrained('advertisements');
            $table->unsignedBigInteger('supplier_id')->constrained('car_suppliers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisement_suppliers');
    }
};
