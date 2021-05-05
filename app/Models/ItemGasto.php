<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemGasto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'items_gasto';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipo_item', 'nombre_item',
    ];
}
