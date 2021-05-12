<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud_adquisicion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solicitudes_adquisiciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_solicitud_a', 'justificacion_solicitud_a', 'detalle_solicitud_a', 'fecha_entrega',
    ];
}
