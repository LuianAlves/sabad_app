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
        Schema::create('chip_controls', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('chip_id');
            $table->foreign('chip_id')->references('id')->on('chips')->onDelete('cascade');

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedInteger('ddd')->nullable();
            $table->unsignedInteger('number');

            $table->date('delivered_in')->nullable();
            $table->date('returned_in')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chip_controls');
    }
};
