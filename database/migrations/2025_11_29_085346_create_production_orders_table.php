<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_orders', function (Blueprint $table) {
            // PK UUID (ok deixar uuid aqui)
            $table->uuid('id')->primary();

            // Dados básicos da OF (gerente)
            $table->date('order_date');                  // Data da OF
            $table->string('order_number', 50);          // Nº da OF
            $table->string('client_name');               // Cliente
            $table->date('expedition_date');             // Data de expedição

            // Status do fluxo
            // not_started | separated | in_production | finished
            $table->string('status', 30)->default('not_started');

            // Usuários envolvidos (mesmo tipo de users.id -> bigInt)
            $table->foreignId('created_by_id')
                ->nullable()
                ->constrained('users')   // references 'id' on 'users'
                ->nullOnDelete();

            $table->foreignId('stock_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('production_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Nome digitado do operador
            $table->string('production_operator_name')->nullable();

            // Datas de eventos no fluxo
            $table->timestamp('stock_separated_at')->nullable();
            $table->timestamp('production_started_at')->nullable();
            $table->timestamp('production_finished_at')->nullable();

            $table->timestamps();

            // Índices úteis
            $table->index('status');
            $table->index(['status', 'order_date']);
            $table->index(['status', 'expedition_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_orders');
    }
};
