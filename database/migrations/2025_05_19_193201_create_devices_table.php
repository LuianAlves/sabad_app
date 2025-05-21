<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->tinyInteger('device_type');
            $table->string('brand');
            $table->string('model');
            $table->tinyInteger('phone_type');
            $table->string('phone_model');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
