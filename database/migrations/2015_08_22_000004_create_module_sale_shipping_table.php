<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleSaleShippingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleSaleShipping', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->date('shipping_date')->nullable();
            $table->decimal('shipping_price', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('address_id')
                ->references('id')
                ->on('ModuleCustomerAddress');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ModuleSaleShipping');
    }
}
