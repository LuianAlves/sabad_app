<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->date('plan_validity');
            $table->date('last_payment');
            $table->date('next_payment');
            $table->boolean('is_active');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('domains');
    }
};
