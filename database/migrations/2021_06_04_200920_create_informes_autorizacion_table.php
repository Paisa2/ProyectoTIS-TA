<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformesAutorizacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informes_autorizacion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_informe', 100);
            $table->string('justificacion_informe', 1000);
            $table->string('empresa_seleccionada', 255)->nullable();
            $table->boolean('con_formato');
            $table->integer('comparativo_id')->unsigned();
            $table->foreign('comparativo_id')->references('id')->on('comparativo_cotizaciones');
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
        Schema::dropIfExists('informes_autorizacion');
    }
}
