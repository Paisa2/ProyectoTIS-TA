<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitudesCotizacionesTable extends Migration
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
            $table->string('codigo_cotizacion', 10);
            $table->timestamp('fecha_cotizacion');
            $table->json('detalle_cotizacion');
            $table->integer('solicitud_a_id')->unsigned()->nullable();
            $table->foreign('solicitud_a_id')->references('id')->on('solicitudes_adquisiciones');
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
        Schema::dropIfExists('solicitudes_cotizaciones');
    }
}
