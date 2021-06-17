<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bitacora;
use App\Models\InfoBitacora;

class BitacoraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bitacoras = InfoBitacora::paginate(10);
        if(count($bitacoras) > 0){
            return view('bitacora.visualizarBitacora', compact('bitacoras'));
        }else{
            abort(404);
        }
    }
}
