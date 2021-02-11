<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExcelOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('excel_ones', function (Blueprint $table) {
            $table->id();
            $table->string('first_column')->nullable();
            $table->string('second_column')->nullable();
            $table->string('third_column')->nullable();
            $table->string('forth_column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('excel_ones');
    }
}
