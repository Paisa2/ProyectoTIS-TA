<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    public function lista(){

        $unidad = Unidad::join('unidades as pertenece', 'unidades.unidad_id', '=', 'pertenece.id')->select('unidades.*','pertenece.nombre_unidad as pertenece_a')->orderBy('created_at','ASC')->get();
        return view('unidades', compact('unidad'));
    }
}
