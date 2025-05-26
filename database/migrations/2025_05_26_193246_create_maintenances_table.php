<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('device_control_id');
            $table->foreign('device_control_id')->references('id')->on('device_controls')->onDelete('cascade');

            $table->date('delivered_in')->nullable();
            $table->date('last_maintenance')->nullable();
            $table->date('next_maintenance')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
