<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudItem extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'solicitud_item';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'para_usuario_id', 'de_usuario_id', 'detalle_solicitud_item',
    ];
}
