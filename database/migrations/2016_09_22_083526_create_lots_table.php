<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('products', 'published_date')) {
            Schema::table('products', function ($table) {
                $table->dropColumn('published_date');
            });
        }

        if (Schema::hasColumn('products', 'expiration_date')) {
            Schema::table('products', function ($table) {
                $table->dropColumn('expiration_date');
            });
        }

        if (! Schema::hasColumn('products', 'old_price')) {
            Schema::table('products', function ($table) {
                $table->string('old_price')->after('price')->nullable();
            });
        }

        if (Schema::hasColumn('products', 'type')) {
            Schema::table('products', function ($table) {
                $table->dropColumn('type');
            });
        }

        if (Schema::hasColumn('products', 'status')) {
            Schema::table('products', function ($table) {
                $table->dropColumn('status');
            });
        }

        if (Schema::hasColumn('products', 'vendor_id')) {
            Schema::table('products', function ($table) {
                $table->dropForeign(['vendor_id']);
            });
        }

        if (! Schema::hasColumn('products', 'sub_category_id')) {
            Schema::table('products', function ($table) {
                $table->integer('sub_category_id')->unsigned()->nullable();

                $table->foreign('sub_category_id')->references('id')->on('sub_categories')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }

        Schema::create('lots', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unsigned();
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('currency_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable();
            $table->timestamp('public_date')->nullable();
            $table->timestamp('expire_date')->nullable();
            $table->enum('status', [ 'publish', 'drafted' ])->default('drafted');
            $table->enum('verify_status', [ 'declined', 'pending', 'verified' ])->default('pending');
            $table->boolean('active')->default(1)->index();
            $table->timestamps();

            $table->foreign('vendor_id')->references('id')->on('vendors')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('currencies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('currency_id')->references('id')->on('categories')
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
        Schema::drop('lots');
    }
}
