<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsOperationsTable extends Migration
{
    public $table = 'payments_operations';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');

            $table->integer('transaction_id')->nullable();
            $table->string('transaction_type')->nullable();

            $table->integer('wallet_id')->unsigned();
            $table->boolean('amount');
            $table->enum('type', ['waste', 'refill']);
            $table->timestamps();

            $table->foreign('wallet_id')->references('id')->on('user_wallets')->onDelete('CASCADE')->onUpdate('CASCADE');
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
