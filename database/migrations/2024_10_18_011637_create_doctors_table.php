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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->integer('cm')->unique();
            $table->date('birth_date');
            $table->string('address', 100);
            $table->string('status', 100);
            $table->string('education', 100);
            $table->date('hiring_date');
            $table->time('opening_time')->nullable()->default('08:00:00');
            $table->time('closing_time')->nullable()->default('12:00:00');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
