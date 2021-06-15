<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComparativoCotizacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comparativo_cotizaciones';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detalle_comparativo', 'cotizacion_id',
    ];
}
