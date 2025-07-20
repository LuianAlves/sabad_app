<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('salary_bands', function (Blueprint $table) {
            // adiciona fk para tier_levels
            $table->foreignId('tier_level_id')
                ->nullable()
                ->constrained('tier_levels')
                ->onDelete('cascade')
                ->after('id');
            // remove fk antiga
            $table->dropForeign(['hierarchical_level_id']);
            $table->dropColumn('hierarchical_level_id');
        });
    }

    public function down()
    {
        Schema::table('salary_bands', function (Blueprint $table) {
            $table->foreignId('hierarchical_level_id')
                ->constrained('hierarchical_levels')
                ->onDelete('cascade')
                ->after('id');
            $table->dropForeign(['tier_level_id']);
            $table->dropColumn('tier_level_id');
        });
    }
};
