<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InformeAutorizacion extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'informes_autorizacion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_informe', 'justificacion_informe', 'empresa_seleccionada', 
        'comparativo_id',
    ];
}
