<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')->references('id')->on('companies');

            $table->string('name');

            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
