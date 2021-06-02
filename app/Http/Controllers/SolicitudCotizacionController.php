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
            'min'   => 'Introducir mínimo :min caracteres',
            'max'   => 'Introducir máximo :max caracteres',
            'regex' => 'El campo :attribute solo puede tener letras',
            'numero_cotizacion.numeric' => 'El campo Número Cotización solo puede tener números',
            'numero_cotizacion.digits_between'   => 'Número Cotización debe tener entre 6 y 8 dígitos',
                        
        ];
        $this->validate($request, [
            'razon_social'=>['required', 'min:2', 'max:40', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ-]))+$/'],
            'numero_cotizacion'=>['required', 'digits_between:6,8', 'numeric'], 
            'fecha_cotizacion'=>['required'], 
            ], $mensages);
        $cotizacion = new Solicitud_cotizacion;    
        $cotizacion->razon_social = $request->razon_social;
        $cotizacion->numero_cotizacion = $request->numero_cotizacion;
        $cotizacion->fecha_cotizacion = $request->fecha_cotizacion;
        $cotizacion->detalle_cotizacion = $request->detalle;

        $cotizacion->save();
        return redirect()->route('solicitudCotizacion.index')->with('confirm', 'Nuevo usuario registrado correctamente');           

    }
}
