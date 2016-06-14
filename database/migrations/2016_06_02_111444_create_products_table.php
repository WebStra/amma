<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Table name.
     * 
     * @var string
     */
    protected $table = 'products';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->float('price');
            $table->integer('sale');
            $table->integer('count');
            $table->enum('type', ['old', 'new']);
            $table->enum('status', ['published', 'drafted', 'completed']);
            $table->boolean('active')->default(1)->index();
            $table->timestamp('published_date');
            $table->timestamp('expiration_date');

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
        Schema::drop($this->table);
    }
}
