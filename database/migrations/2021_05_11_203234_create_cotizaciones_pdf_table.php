<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCotizacionesPdfTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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
        Schema::dropIfExists('cotizaciones_pdf');
    }
}
