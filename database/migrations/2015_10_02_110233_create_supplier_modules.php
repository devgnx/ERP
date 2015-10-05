<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_supplier', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('cnpj')->unique();
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('street');
            $table->string('street_number');
            $table->string('state_province');
            $table->string('country');
            $table->string('zip_code');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('module_product_in_supplier', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('supplier_id')->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('module_product')
                ->onDelete('cascade');

            $table->foreign('supplier_id')
                ->references('id')
                ->on('module_supplier')
                ->onDelete('cascade');
        });

        Schema::create('module_supplier_in_category', function(Blueprint $table){
            $table->increments('id');
            $table->integer('supplier_id')->unsigned();
            $table->integer('category_id')->unsigned();

            $table->foreign('supplier_id')
                ->references('id')
                ->on('module_supplier')
                ->onDelete('cascade');

            $table->foreign('category_id')
                ->references('id')
                ->on('module_product_category')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('module_supplier_in_category');
        Schema::drop('module_product_in_supplier');
        Schema::drop('module_supplier');
    }
}
