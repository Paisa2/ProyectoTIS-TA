<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsGastoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_gasto', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('tipo_item');
            $table->string('nombre_item', 255);
            $table->integer('item_id')->unsigned();
            $table->foreign('item_id')->references('id')->on('items_gasto');
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
        Schema::dropIfExists('items_gasto');
    }
}
