<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaqTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faq', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1)->index();
            $table->integer('rank')->index()->nullable();
            $table->timestamps();
        });

        Schema::create('faq_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faq_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('title');
            $table->string('body');

            $table->foreign('faq_id')->references('id')->on('faq')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faq_translations');
        Schema::drop('faq');
    }
}
