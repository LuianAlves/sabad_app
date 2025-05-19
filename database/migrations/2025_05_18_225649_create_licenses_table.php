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
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');

            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->integer('quantity');

            $table->string('user')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            $table->string('contracted_in')->nullable();
            $table->decimal('price_per_unit', 10,2)->nullable();
            $table->enum('recurrence', ['monthly', 'yearly', 'lifetime'])->nullable();
            $table->string('payment_day')->nullable();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licenses');
    }
};
