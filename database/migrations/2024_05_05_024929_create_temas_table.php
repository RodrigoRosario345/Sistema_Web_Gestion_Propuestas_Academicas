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
        Schema::create('temas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->string('codigo', 10);
            $table->string('documento', 200);
            $table->string('preview_img', 200);
            $table->unsignedBigInteger('carrera_id');
            $table->date('fecha');
            $table->string('estudiante', 100);
            $table->string('tipo', 50);
            $table->string('tutor', 100);
            $table->string('asesor', 100);
            $table->string('problematica', 4000);
            $table->string('estado', 50);
            $table->timestamps();

            $table->foreign('carrera_id')->references('id')->on('carreras');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temas');
    }
};
