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
        Schema::table('employees', function (Blueprint $table) {
            $table->foreignId('tier_level_id')
                ->nullable()
                ->constrained('tier_levels')
                ->onDelete('set null')
                ->after('hierarchical_level_id');

            $table->foreignId('salary_band_id')
                ->nullable()
                ->constrained('salary_bands')
                ->onDelete('set null')
                ->after('tier_level_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            //
        });
    }
};
