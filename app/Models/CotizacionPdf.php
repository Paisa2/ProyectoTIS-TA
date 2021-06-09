<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CotizacionPdf extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cotizaciones_pdff';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ruta', 'cotizacion_id',
    ];
    public $timestamps = false;
}
