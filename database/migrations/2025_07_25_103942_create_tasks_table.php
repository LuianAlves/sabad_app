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
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('task_id')->primary();

            $table->uuid('task_status_id');
            $table->foreign('task_status_id')->references('task_status_id')->on('task_statuses')->onDelete('cascade');

            $table->integer('order')->default(0);

            $table->string('name');
            $table->text('description')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('priority',['low','medium','high','important'])->default('medium');
            $table->json('responsible');
            $table->json('attachments')->nullable();
            $table->json('tags')->nullable();
            $table->json('checklist')->nullable();
            $table->text('quick_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
