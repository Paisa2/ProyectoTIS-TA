<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CotizacionNuevo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes_cotizaciones', function (Blueprint $table) {
            $table->string('numero_cotizacion', 10)->nullable();
        });
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('telefono_usuario', 12)->nullable();
            $table->string('ci_usuario', 12)->nullable();
        });
        Schema::table('unidades', function (Blueprint $table) {
            $table->string('telefono_unidad', 12)->nullable();
        });
        Schema::table('presupuestos', function (Blueprint $table) {
            $table->boolean('estado')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
