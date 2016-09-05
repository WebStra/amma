<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaggableTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taggable_tags', function (Blueprint $table) {
            $table->increments('tag_id');
//            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->string('normalized');
            $table->boolean('active')->default(1)->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('taggable_tag_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name');

            $table->foreign('tag_id')
                ->references('tag_id')
                ->on('taggable_tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('taggable_taggables', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tag_id');
            $table->unsignedInteger('taggable_id');
            $table->string('taggable_type');
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
        Schema::drop('taggable_tag_translations');
        Schema::drop('taggable_tags');
        Schema::drop('taggable_taggables');
    }
}
