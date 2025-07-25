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
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->uuid('subtask_id')->primary();

            $table->uuid('parent_task_id');
            $table->foreign('parent_task_id')->references('task_id')->on('tasks')->onDelete('cascade');

            $table->uuid('task_status_id');
            $table->foreign('task_status_id')->references('task_status_id')->on('task_statuses')->onDelete('cascade');

            $table->unsignedBigInteger('responsible');
            $table->foreign('responsible')->references('id')->on('users')->onDelete('cascade');

            $table->string('name');
            $table->date('due_date')->nullable();
            $table->json('attachments')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tasks');
    }
};
