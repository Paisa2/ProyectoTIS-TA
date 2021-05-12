<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesAdquisicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_adquisiciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_solicitud_a', 100);
            $table->string('estado_solicitud_a', 100);
            $table->string('justificacion_solicitud_a', 800);
            $table->string('detalle_solicitud_a', 6000);
            $table->string('fecha_entrega');
            $table->integer('de_usuario_id')->unsigned();
            $table->foreign('de_usuario_id')->references('id')->on('usuarios');
            $table->integer('para_unidad_id')->unsigned();
            $table->foreign('para_unidad_id')->references('id')->on('unidades');
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
        Schema::dropIfExists('solicitudes_adquisiciones');
    }
}
