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
        Schema::create('union_adjustments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('union_id')->constrained('unions')->onDelete('cascade');

            $table->integer('year');
            $table->decimal('percent', 5, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('union_adjustments');
    }
};
