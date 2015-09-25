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

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->timestamps();
        });

        Schema::create('module_sale_shipping', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->date('shipping_date')->nullable();
            $table->decimal('shipping_price', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('address_id')
                ->references('id')
                ->on('module_customer_address');
        });

        Schema::create('module_sale_order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('shipping_id')->unsigned()->nullable();
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
        });

        Schema::create('module_sale_order_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('sale_order_id')->unsigned();
            $table->timestamps();

            $table->foreign('sale_order_id')
                ->references('id')
                ->on('module_sale_order');

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
        Schema::drop('module_sale_order_items');
        Schema::drop('module_sale_order');
        Schema::drop('module_sale_shipping');
        Schema::drop('module_seller');
    }
}
