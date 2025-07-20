<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            // adiciona a FK
            $table->foreignId('hierarchical_level_id')
                ->nullable()
                ->constrained('hierarchical_levels')
                ->onDelete('set null')
                ->after('department_id');
            // remove o campo string
            $table->dropColumn('hierarchical_level');
        });
    }

    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('hierarchical_level')->after('department_id');
            $table->dropConstrainedForeignId('hierarchical_level_id');
        });
    }
};
