<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCotizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {    
        Schema::drop('solicitudes_adquisiciones');
        Schema::drop('cotizaciones_pdf');
        Schema::drop('solicitudes_cotizaciones');
        Schema::create('solicitudes_adquisiciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_solicitud_a', 100);
            $table->string('estado_solicitud_a', 100);
            $table->string('numero_solicitud_a', 10);
            $table->string('justificacion_solicitud_a', 800);
            $table->json('detalle_solicitud_a');
            $table->timestamp('fecha_entrega');
            $table->integer('de_usuario_id')->unsigned();
            $table->foreign('de_usuario_id')->references('id')->on('usuarios');
            $table->integer('para_unidad_id')->unsigned();
            $table->foreign('para_unidad_id')->references('id')->on('unidades');
            $table->timestamps();
        });
        Schema::create('solicitudes_cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_cotizacion', 10);
            $table->timestamp('fecha_cotizacion');
            $table->json('detalle_cotizacion');
            $table->integer('solicitud_a_id')->unsigned();
            $table->foreign('solicitud_a_id')->references('id')->on('solicitudes_adquisiciones');
            $table->timestamps();
        });
        Schema::create('respuestas_cotizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('razon_social', 255);
            $table->json('detalle_precios');
            $table->integer('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('solicitudes_cotizaciones');
        });
        Schema::create('cotizaciones_pdf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ruta', 255);
            $table->integer('resp_cot_id')->unsigned();
            $table->foreign('resp_cot_id')->references('id')->on('respuestas_cotizacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('respuestas_cotizacion');
    }
}
