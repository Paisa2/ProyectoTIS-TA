<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud_cotizacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solicitudes_cotizaciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detalle_cotizacion', 'numero_cotizacion', 
        'fecha_cotizacion', 'para_usuario_id',
    ];
}
