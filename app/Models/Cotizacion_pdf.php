<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cotizacion_pdf extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cotizaciones_pdf';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ruta', 'cotizacion_id',
    ];
}
