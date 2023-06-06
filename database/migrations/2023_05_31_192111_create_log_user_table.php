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
        Schema::create('log_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            /**
             * user (FK)
             */
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user');

            $table->string('event_type', 100);
            $table->string('event', 100);
            $table->string('codhash', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_user');
    }
};
