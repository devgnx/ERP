<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleProductStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleProductStock', function(Blueprint $table){
            $table->increments('id');
            $table->integer('product_id')->unsigned()->unique();
            $table->string('sku');
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('ModuleProduct')
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
        Schema::drop('ModuleProductStock');
    }
}
