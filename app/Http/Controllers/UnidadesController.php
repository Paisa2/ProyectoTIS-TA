<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use App\Models\Presupuesto;
use Illuminate\Http\Request;

class UnidadesController extends Controller
{
    public function lista(){

        $unidad = Unidad::join('unidades as pertenece', 'unidades.unidad_id', '=', 'pertenece.id')->select('unidades.*','pertenece.nombre_unidad as pertenece_a')->orderBy('created_at','ASC')->get();
        foreach ($unidad as $un) {
            $un->presupuesto = Presupuesto::where('estado', true)->where('unidad_id', $un->id)->count();
        }
        return view('unidades', compact('unidad'));
    }
}
