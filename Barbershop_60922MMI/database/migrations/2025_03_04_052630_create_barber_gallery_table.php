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
        Schema::create('barber_gallery', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('barber_id');
            $table->foreign('barber_id')->references('id')->on('barber');
            $table->bigInteger('work_image_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barber_gallery');
    }
};
