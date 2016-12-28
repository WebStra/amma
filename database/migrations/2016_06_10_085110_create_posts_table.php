<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('status', ['published', 'drafted'])->default('published');
            $table->integer('view_count')->default(0);
            $table->boolean('active')->default(1)->index();
            $table->timestamps();
        });

        Schema::create('post_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned();
            $table->integer('language_id')->unsigned();

            $table->string('slug', 255);
            $table->string('title', 255);
            $table->text('body');
            $table->string('seo_title', 255);
            $table->text('seo_description');
            $table->string('seo_keywords', 255);

            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('post_translations');

        Schema::drop('posts');
    }
}
