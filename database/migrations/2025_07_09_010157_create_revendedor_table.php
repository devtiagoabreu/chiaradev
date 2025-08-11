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
        Schema::create('revendedor', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf', 11)->unique();
            $table->string('cidade_estado');
            $table->string('whatsapp');
            $table->string('instagram')->nullable();
            $table->enum('tipo_vendedor', ['Atacado', 'Varejo'])->default('Varejo');
            $table->enum('status', ['Pendente', 'Aprovado', 'Rejeitado'])->default('Pendente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revendedor');
    }
};
