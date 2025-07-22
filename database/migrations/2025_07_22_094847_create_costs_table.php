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
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('device_control_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('heritage_control_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('salary_band_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('total', 10, 2)->default(0.00);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
