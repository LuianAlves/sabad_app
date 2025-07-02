<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->date('creation_date');
            $table->date('renewal_date');
            $table->date('last_renovation');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
