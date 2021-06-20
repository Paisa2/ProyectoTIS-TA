<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RespuestaCotizacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'respuestas_cotizacion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'razon_social', 'detalle_precios', 'cotizacion_id',
    ];
}
