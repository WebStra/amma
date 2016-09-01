<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCategoriesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sub_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->boolean('active')->default(1)->index();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('sub_category_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sub_category_id')->unsigned();
            $table->integer('language_id')->unsigned();

            $table->string('name', 255);
            $table->string('slug', 255)->unique();

            $table->string('seo_title', 255);
            $table->text('seo_description');
            $table->string('seo_keywords', 255);

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('categoryable', function(Blueprint $table){
            if(Schema::hasColumn('categoryable', 'type'))
                $table->dropColumn('type');
        });

        Schema::table('categories', function(Blueprint $table){
            if(Schema::hasColumn('categories', 'type'))
                $table->dropColumn('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
