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
        'razon_social', 'detalle_cotizacion',
    ];
}
