<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'nombre_empresa', 'representante_legal', 'direccion_empresa', 
        'nit_empresa', 'rubro_empresa', 'telefono_empresa', 'email_empresa',
    ];
}
