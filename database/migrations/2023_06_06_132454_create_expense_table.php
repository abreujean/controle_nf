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
        Schema::create('expense', function (Blueprint $table) {
            $table->bigIncrements('id');

            /**
             * user (FK)
             */
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('user');

            /**
             * COMPANY (FK)
             */
            $table->unsignedBigInteger('id_company')->nullable();
            $table->foreign('id_company')->references('id')->on('company');

            /**
             * CATEGORY (FK)
             */
            $table->unsignedBigInteger('id_category')->nullable();
            $table->foreign('id_category')->references('id')->on('category');
            
            $table->string('value', 100);
            $table->string('expense', 100);
            $table->date('competition_date');
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
        Schema::dropIfExists('expense');
    }
};
