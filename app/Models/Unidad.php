<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'unidades';
    protected $fillable = ['tipo_unidad','nombre_unidad','unidad_id'];
}
