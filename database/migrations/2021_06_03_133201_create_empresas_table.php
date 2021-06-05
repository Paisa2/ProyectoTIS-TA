<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre_empresa', 255);
            $table->string('representante_legal', 255);
            $table->string('direccion_empresa', 255);
            $table->string('nit_empresa', 15);
            $table->string('rubro_empresa', 255);
            $table->string('telefono_empresa', 12);
            $table->string('email_empresa', 255);
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
        Schema::dropIfExists('empresas');
    }
}
