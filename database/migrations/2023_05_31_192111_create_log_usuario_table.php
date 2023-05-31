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
        Schema::create('log_usuario', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            /**
             * USUARIO (FK)
             */
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('usuario');

            $table->string('tipo_evento', 100);
            $table->string('evento', 100);
            $table->string('codhash', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_usuario');
    }
};
