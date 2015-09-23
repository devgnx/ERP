<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductModules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('module_product', function(Blueprint $table){
            $table->increments('id');
            $table->string('code')->unique();
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('module_product_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('module_product_stock', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->unique();
            $table->string('sku');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('module_product')
                ->onDelete('cascade');
        });

        Schema::create('module_product_in_category', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('module_product')
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
        Schema::drop('module_product_in_category');
        Schema::drop('module_product_stock');
        Schema::drop('module_product_category');
        Schema::drop('module_product');
    }
}
