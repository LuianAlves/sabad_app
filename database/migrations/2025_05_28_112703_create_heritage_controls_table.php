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
        Schema::create('heritage_controls', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('heritage_id');
            $table->foreign('heritage_id')->references('id')->on('heritages')->onDelete('cascade');

            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            $table->string('heritage_code');

            $table->date('delivered_in')->nullable();
            $table->date('returned_in')->nullable();

            $table->decimal('estimated_price', 10, 2)->nullable();
            $table->date('purchased_in')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heritage_controls');
    }
};
