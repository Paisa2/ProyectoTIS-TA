<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'empresas';
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
