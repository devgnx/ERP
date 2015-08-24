<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleProduct', function(Blueprint $table){
            $table->increments('id');
            $table->string('code')->unique()->index();
            $table->string('sku')->index();
            $table->string('name')->index();
            $table->decimal('price', 11, 2);
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ModuleProduct');
    }
}
