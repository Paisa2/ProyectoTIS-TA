<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('detalle_solicitud_item', 2000);
            $table->integer('de_usuario_id')->unsigned();
            $table->foreign('de_usuario_id')->references('id')->on('usuarios');
            $table->integer('para_usuario_id')->unsigned();
            $table->foreign('para_usuario_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('solicitud_item');
    }
}
