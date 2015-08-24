<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleStock', function(Blueprint $table){
            $table->increments('id');
            $table->string('product_code')->unique()->index();
            $table->integer('quantity');
            $table->timestamps();

            $table->foreign('product_code')
                ->references('code')
                ->on('ModuleProduct')
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
        Schema::drop('ModuleStock');
    }
}
