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
        Schema::create('salary_bands', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hierarchical_level_id')->constrained('hierarchical_levels')->onDelete('cascade');

            $table->string('band');           // ex: “I”, “II”, “III”
            $table->decimal('salary', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salary_bands');
    }
};
