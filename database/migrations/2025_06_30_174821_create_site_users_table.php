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
        Schema::create('site_users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname',50);
            $table->string('email',100);
            $table->string('phone',30)->nullable();
            $table->dateTime('email_verified_at')->nullable();
            $table->integer('email_verified_code')->nullable();
            $table->integer('email_verified_code_expire')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_users');
    }
};
