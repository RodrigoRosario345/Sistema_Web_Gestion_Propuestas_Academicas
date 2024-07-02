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
        Schema::create('tema_etiquetas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tema_id');
            $table->unsignedBigInteger('etiqueta_id');
            $table->timestamps();

            $table->foreign('tema_id')->references('id')->on('temas');
            $table->foreign('etiqueta_id')->references('id')->on('etiquetas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tema_etiquetas');
    }
};
