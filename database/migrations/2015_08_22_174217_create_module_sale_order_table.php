<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleSaleOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleSaleOrder', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seller_id')->unsigned();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('shipping_id')->unsigned()->nullable();
            $table->decimal('subtotal_price', 10, 2);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('ModuleCustomer');

            $table->foreign('seller_id')
                ->references('id')
                ->on('ModuleSeller');

            $table->foreign('shipping_id')
                ->references('id')
                ->on('ModuleSaleShipping');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ModuleSaleOrder');
    }
}
