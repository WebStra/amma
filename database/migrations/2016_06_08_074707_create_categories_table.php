<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('show_in_sidebar')->default(0)->index();
            $table->boolean('show_in_footer')->default(0)->index();
            $table->boolean('active')->default(1)->index();
            $table->integer('rank');
            $table->timestamps();
        });

        Schema::create('category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('language_id')->unsigned();
            $table->string('name', 255);
            $table->string('slug', 255)->unique();

            $table->string('seo_title', 255);
            $table->text('seo_description');
            $table->string('seo_keywords', 255);

            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });

        Schema::create('categoryable', function (Blueprint $table) {
            $table->increments('id');

            $table->morphs('categoryable');

            $table->integer('category_id')->unsigned()->nullable();
            $table->enum('type', ['parent', 'child'])->nullable();
            $table->boolean('active')->default(1)->index();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('category_translations');
        Schema::drop('categoryable');
        Schema::drop('categories');
    }
}
