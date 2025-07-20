<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->foreignId('union_id')
                ->nullable()
                ->constrained('unions')
                ->onDelete('set null')
                ->after('id');
        });
    }

    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropConstrainedForeignId('union_id');
        });
    }
};
