<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordens_servico', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->constrained('clientes')->onDelete('cascade');
            $table->foreignId('veiculo_id')->constrained('veiculos')->onDelete('cascade');
            $table->text('descricao');
            $table->string('status', 30)->default('ABERTA');
            $table->decimal('valor', 10, 2)->nullable();
            $table->date('data_entrega')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordens_servico');
    }
};
