<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleSaleOrderItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleSaleOrderItems', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('sale_order_id')->unsigned();
            $table->timestamps();

            $table->foreign('sale_order_id')
                ->references('id')
                ->on('ModuleSaleOrder');

            $table->foreign('product_id')
                ->references('id')
                ->on('ModuleProduct');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ModuleSaleOrderItems');
    }
}
