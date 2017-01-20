<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });

        Schema::create('units_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('language_id');

            $table->string('name', 255);
            $table->unique(['unit_id', 'language_id']);

            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('units');
        Schema::drop('units_translations');
    }
}
