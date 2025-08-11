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
        Schema::create('garantia', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf', 11);
            $table->string('instagram');
            $table->string('produto_codigo');
            $table->date('data_da_compra');
            $table->string('nome_da_revendedora')->nullable();
            $table->string('whatsapp');
            $table->boolean('aceite_termos');   // aceitar termos
            $table->boolean('aceite_whatsapp'); // aceitar promoções via whatsapp
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('garantia');
    }
};
