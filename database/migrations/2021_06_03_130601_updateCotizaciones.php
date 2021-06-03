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
        Schema::create('solicitudes_cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero_cotizacion', 10);
            $table->timestamp('fecha_cotizacion');
            $table->json('detalle_cotizacion');
            $table->integer('para_usuario_id');
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
        Schema::drop('cotizaciones_pdf');
        Schema::drop('solicitudes_cotizaciones');
    }
}
