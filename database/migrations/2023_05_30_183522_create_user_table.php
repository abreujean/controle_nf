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
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');

            /**
             * PROFILE FK
             */
            $table->unsignedBigInteger('id_profile');
            $table->foreign('id_profile')->references('id')->on('profile');

            $table->string('name', 100);
            $table->string('email', 40);
            $table->string('password', 50);
            $table->string('phone', 20);
            $table->enum('alert', ['desativado', 'sms', 'email']);
            $table->boolean('active');
            $table->string('codhash', 100);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
