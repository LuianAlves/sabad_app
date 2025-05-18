<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->string('name');
            $table->string('hierarchical_level');
            $table->date('hired_in');
            $table->date('fired_in')->nullable();
            $table->boolean('status');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
