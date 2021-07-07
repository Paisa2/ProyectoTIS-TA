<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTieneRol extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuario_tiene_roles';
    public $timestamps = false;
}
