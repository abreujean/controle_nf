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
        Schema::create('nota_fiscal', function (Blueprint $table) {
            $table->bigIncrements('id');

            /**
             * USUARIO (FK)
             */
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('usuario');

            /**
             * EMPRESA (FK)
             */
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('empresa');

            $table->string('numero', 100);
            $table->string('valor', 100);
            $table->date('mes_competencia');
            $table->date('mes_caixa');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nota_fiscal');
    }
};
