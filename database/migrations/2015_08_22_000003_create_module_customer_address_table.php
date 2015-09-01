<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleCustomerAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleCustomerAddress', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->string('street');
            $table->string('street_number');
            $table->string('state_province');
            $table->string('country');
            $table->string('zip_code');
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('ModuleCustomer')
                ->onDelte('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ModuleCustomerAddress');
    }
}
