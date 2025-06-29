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
        Schema::create('heritage_models', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('heritage_brand_id');
            $table->foreign('heritage_brand_id')->references('id')->on('heritage_brands')->onDelete('cascade');

            $table->string('name');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heritage_models');
    }
};
