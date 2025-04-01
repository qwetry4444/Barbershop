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
        Schema::create('barber_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barber_id');
            $table->foreign('barber_id')->references('id')->on('users');
            $table->string('image_path');
            $table->string('title')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barber_galleries');
    }
};
