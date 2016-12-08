<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMethodDeliveryPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('method_delivery_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('active')->default(1)->index();
            $table->string('ico', 255);
            $table->timestamps();
        });
        Schema::create('method_delivery_payment_translations', function(Blueprint $table)
        {
            $table->increments('id');

            $table->unsignedInteger('method_delivery_payment_id');
            $table->unsignedInteger('language_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('method_delivery_payment');
        Schema::drop('method_delivery_payment_translations');
    }
}
