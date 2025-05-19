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
        Schema::create('emails', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');

            $table->unsignedBigInteger('license_id');
            $table->foreign('license_id')->references('id')->on('licenses')->onDelete('cascade');

            $table->string('user')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            $table->json('alias')->nullable();     // Já que um e-mail pode ter um ou vários alias, usamos json para que possamos ter controle
            
            $table->json('last_user')->nullable(); // Usando json podemos juntar todos os usuários que já usarão esse e-mail

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
