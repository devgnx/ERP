<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_seller', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('user_id')->unsigned()->unique()->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

        });

        Schema::create('module_sale_shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street');
            $table->string('street_number');
            $table->string('city');
            $table->string('state_province');
            $table->string('country');
            $table->string('postcode');
            $table->date('date')->nullable();
            $table->decimal('price', 10, 2)->nullable();
        });

        Schema::create('module_sale_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->char('code', 3);
        });

        Schema::create('module_sale', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('shipping_id')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();
            $table->decimal('subtotal_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('module_customer');

            $table->foreign('seller_id')
                ->references('id')
                ->on('module_seller');

            $table->foreign('shipping_id')
                ->references('id')
                ->on('module_sale_shipping');

            $table->foreign('status_id')
                ->references('id')
                ->on('module_sale_status');
        });

        Schema::create('module_sale_item', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('sale_id')->unsigned();
            $table->integer('quantity');
            $table->decimal('product_price', 10, 2);

            $table->foreign('sale_id')
                ->references('id')
                ->on('module_sale');

            $table->foreign('product_id')
                ->references('id')
                ->on('module_product');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('module_sale_item');
        Schema::drop('module_sale');
        Schema::drop('module_sale_status');
        Schema::drop('module_sale_shipping');
        Schema::drop('module_seller');
    }
}
