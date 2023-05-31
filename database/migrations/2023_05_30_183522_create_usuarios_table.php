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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('email');
            $table->string('senha');
            $table->boolean('ativo');
            $table->unsignedBigInteger('id_perfil');
            
            $table->timestamps();

            $table->foreign('id_perfil')->references('id')->on('perfil');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
