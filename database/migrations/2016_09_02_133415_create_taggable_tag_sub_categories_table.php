<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggableTagSubCategoriesTable extends Migration
{
    public $table = 'taggable_tag_sub_categories';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->integer('taggable_tag_id')->unsigned();
            $table->integer('sub_category_id')->unsigned();

            $table->foreign('taggable_tag_id')->references('id')->on('taggable_tags')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop($this->table);
    }
}
