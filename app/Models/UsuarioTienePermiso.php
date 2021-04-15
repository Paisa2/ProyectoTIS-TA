<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsuarioTienePermiso extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuario_tiene_permisos';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
