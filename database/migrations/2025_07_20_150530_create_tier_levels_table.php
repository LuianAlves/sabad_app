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
        Schema::create('tier_levels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hierarchical_level_id')->constrained('hierarchical_levels')->onDelete('cascade');

            $table->string('name');           // ex: "Junior", "Pleno", "Senior"
            $table->unsignedTinyInteger('order'); // 1=Junior, 2=Pleno, 3=Senior

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tier_levels');
    }
};
