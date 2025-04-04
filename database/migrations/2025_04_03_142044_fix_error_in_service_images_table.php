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
        Schema::table('service_images', function (Blueprint $table) {
            $table->unsignedBigInteger("service_id");
            $table->foreign('service_id')->references('id')->on('services');

            $table->string("image_path");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_images', function (Blueprint $table) {
            //
        });
    }
};
