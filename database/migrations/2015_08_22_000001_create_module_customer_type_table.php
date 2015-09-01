<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleCustomerTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ModuleCustomerType', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('group_id')->unsigned();
            $table->timestamps();

            $table->foreign('group_id')
                ->references('id')
                ->on('ModuleCustomerTypeGroup');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ModuleCustomerType');
    }
}
