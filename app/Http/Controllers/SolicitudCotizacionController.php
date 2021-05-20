<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Solicitud_cotizacion;

class SolicitudCotizacionController extends Controller
{
    public function index(){
        $cotizaciones = Solicitud_cotizacion::all();
        return view("SolicitudCotizacion.visualizarSolicitudCotizacion", compact("cotizaciones"));
    }

    public function create(){
        return view("SolicitudCotizacion.crearSolicitudCotizacion");
    }

    public function store(Request $request)
    {
        $mensages = [
            'required' => 'El campo :attribute es requerido',
            'min'   => 'El campo :attribute debe tener por lo menos :min caracteres',
            'max'   => 'El campo :attribute no puede tener más de :max caracteres',
            'regex' => 'El campo :attribute solo puede tener letras',
                        
        ];
        $this->validate($request, [
            'razon_social'=>['required', 'min:2', 'max:255', 'regex:/^[\pL\s\-]+$/u'], 
            ], $mensages);
        $cotizacion = new Solicitud_cotizacion;    
        $cotizacion->razon_social = $request->razon_social;
        $cotizacion->fecha_cotizacion = $request->fecha_cotizacion;
        $cotizacion->detalle_cotizacion = $request->detalle;

        $cotizacion->save();
        return redirect()->route('solicitudCotizacion.index')->with('confirm', 'Nuevo usuario registrado correctamente');           

    }
}
