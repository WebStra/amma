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
            $table->integer('vendor_id')->unsigned();
            $table->string('name', 255);
            $table->float('price');
            $table->integer('sale');
            $table->integer('count');
            $table->enum('type', ['old', 'new']);
            $table->enum('status', ['published', 'drafted', 'completed', 'notverified', 'deleted']);
            $table->boolean('active')->default(1)->index();
            $table->timestamp('published_date');
            $table->timestamp('expiration_date');

            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade')->onUpdate('CASCADE');
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
