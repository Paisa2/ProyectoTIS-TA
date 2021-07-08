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
        $bitacoras = InfoBitacora::orderBy('created_at', 'desc')->paginate(10);
        if($bitacoras->count() == 0 && $bitacoras->currentPage() > 1) {
            abort(404);
        }
        return view('bitacora.visualizarBitacora', compact('bitacoras'));
        
    }
}
