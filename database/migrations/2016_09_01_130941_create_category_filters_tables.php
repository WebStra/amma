<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryFiltersTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('filterable');
            $table->enum('filter_type', ['checkbox', 'select']);
            $table->string('filter_attributes')->nullable();
            $table->string('group')->nullable();
            $table->boolean('active')->default(1)->index();
        });

        Schema::create('category_filter_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_filter_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name');

            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_filter_id')->references('id')->on('category_filters')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_filter_translations');
        Schema::drop('category_filters');
    }
}
