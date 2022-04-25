<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContenido extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tipo_contenido';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
