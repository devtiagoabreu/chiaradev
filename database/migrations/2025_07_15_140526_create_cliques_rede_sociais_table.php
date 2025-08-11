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
        Schema::create('cliques_rede_sociais', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('tiktok')->default(0);
            $table->unsignedInteger('instagram')->default(0);
            $table->unsignedInteger('whatsapp')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliques_rede_sociais');
    }
};
