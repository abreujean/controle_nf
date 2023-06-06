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
        Schema::create('invoice', function (Blueprint $table) {
            $table->bigIncrements('id');

            /**
             * USER (FK)
             */
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user');

            /**
             * COMPANY (FK)
             */
            $table->unsignedBigInteger('id_company');
            $table->foreign('id_company')->references('id')->on('company');

            $table->string('number', 100);
            $table->string('value', 100);
            $table->date('month_competency');
            $table->date('receipt_date');
            $table->string('codhash', 100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
