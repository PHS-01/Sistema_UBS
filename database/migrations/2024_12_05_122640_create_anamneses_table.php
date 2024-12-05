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
        Schema::create('anamneses', function (Blueprint $table) {
            $table->id();
            $table->text('chief_complaint')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('lifestyle_habits')->nullable();
            $table->text('symptoms')->nullable();

            $table->unsignedBigInteger('schedulings_id');
            $table->foreign('schedulings_id')->references('id')->on('schedulings');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anamneses');
    }
};
