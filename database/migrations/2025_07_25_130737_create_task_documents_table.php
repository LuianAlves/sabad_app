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
        Schema::create('task_documents', function (Blueprint $table) {
            $table->uuid('document_id')->primary();

            $table->uuid('task_id')->nullable();
            $table->foreign('task_id')->references('task_id')->on('tasks')->onDelete('cascade');

            $table->uuid('sub_task_id')->nullable();
            $table->foreign('sub_task_id')->references('subtask_id')->on('sub_tasks')->onDelete('cascade');

            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');

            $table->string('file_name');
            $table->string('url');
            $table->timestamp('uploaded_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_documents');
    }
};
