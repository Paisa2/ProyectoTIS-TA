<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComparativoCotizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comparativo_cotizaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->json('detalle_comparativo');
            $table->string('observaciones_comparativo', 500);
            $table->string('empresa_recomendad', 255);
            $table->integer('cotizacion_id')->unsigned();
            $table->foreign('cotizacion_id')->references('id')->on('solicitudes_cotizaciones');
            $table->integer('tecnico_responsable_id')->unsigned();
            $table->foreign('tecnico_responsable_id')->references('id')->on('usuarios');
            $table->integer('jefe_administrativo_id')->unsigned();
            $table->foreign('jefe_administrativo_id')->references('id')->on('usuarios');
            $table->integer('jefe_unidad_id')->unsigned();
            $table->foreign('jefe_unidad_id')->references('id')->on('usuarios');
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
        Schema::dropIfExists('comparativo_cotizaciones');
    }
}
