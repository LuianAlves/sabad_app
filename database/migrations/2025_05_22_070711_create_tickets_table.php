<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('ticket_category_id');
            $table->foreign('ticket_category_id')->references('id')->on('ticket_categories')->onDelete('cascade');
            
            $table->string('title');
            $table->text('descreption');

            $table->timestamp('opened_at')->nullable(); // Quando foi realmente aberto
            $table->timestamp('closed_at')->nullable(); // Quando foi resolvido/fechado

            $table->enum('status', ['open', 'in progress', 'completed', 'canceled'])->default('open'); // Status do chamado

            $table->string('attachment_path')->nullable(); // Arquivo anexado (screenshot, PDF etc)

            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
