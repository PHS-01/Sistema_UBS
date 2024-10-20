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
        Schema::create('service__sheets', function (Blueprint $table) {
            $table->id();

            $table->integer('number')->nullable()->default(0);          // Número com valor padrão 0
            $table->time('timeout')->nullable()->default('00:30:00');   // Valor padrão de 30 minutos
            $table->string('name');                                     // Nome do usuário
            $table->string('sus_card', 15)->nullable()->unique();       // Número do cartão SUS com 15 dígitos
            $table->string('email')->nullable()->unique();              // E-mail único e opcional
            $table->string('phone_number', 17)->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service__sheets');
    }
};
