<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOnDeleteForeing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rol_tiene_permisos', function (Blueprint $table) {
            $table->dropForeign(['rol_id']);
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
            $table->dropForeign(['permiso_id']);
            $table->foreign('permiso_id')->references('id')->on('permisos')->onDelete('cascade');
        });
        Schema::table('usuario_tiene_permisos', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->dropForeign(['permiso_id']);
            $table->foreign('permiso_id')->references('id')->on('permisos')->onDelete('cascade');
        });
        Schema::table('usuario_tiene_roles', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
            $table->dropForeign(['rol_id']);
            $table->foreign('rol_id')->references('id')->on('roles')->onDelete('cascade');
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
