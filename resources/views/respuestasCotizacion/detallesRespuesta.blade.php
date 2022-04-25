@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/crearSolicitudCotizacion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">


    <form>
      <h2 class="display-4">Detalle de solicitud de Cotización</h2>
      <h2 class="display-4">N°{{$cotizacion->codigo_cotizacion}}</h2>
      <br>
      <div class="row">
        <div class="mb-3 col-9">
          <div>
            <label for="NumeroCotizacion" class="form-label"><b>RAZON SOCIAL:</b></label>
            <span style="border-bottom: 1px dotted #fff; width: calc(100% - 110px); display: inline-block; padding-left:.5rem;">
                {{$cotizacion->razon_social}}
            </span>
          </div>  
        </div>
        <div class="mb-3 col-3">
          <div>
            <label class="form-label"><b>FECHA:</b></label>
            <label style="border-bottom: 1px dotted #fff; width: calc(100% - 55px); display: inline-block;text-align:center;">{{date("Y-m-d",strtotime($cotizacion->fecha_cotizacion))}}</label>
          </div>    
        </div>
      </div>


            <table class="cotizacion">
      <thead>
        <tr>
          <th class="c-1">N°</th>
          <th class="c-2">Cantidad</th>
          <th class="c-3">Unidad</th>
          <th class="c-4">DETALLE</th>
          <th class="c-5">Unitario</th>
          <th class="c-6">TOTAL</th>
        </tr>
      </thead>
      <tbody>
        @for($i=0; $i<10; $i++)
          <tr>
            <td>{{$detalles[0][$i]}}</td>
            <td>{{$detalles[1][$i]}}</td>
            <td>{{$detalles[2][$i]}}</td>
            <td class="d4"><span>{{$detalles[3][$i]}}</span></td>
            <td>{{$precios[0][$i]}}</td>
            <td>{{$precios[1][$i]}}</td>
          </tr>
        @endfor
      </tbody>
    </table>

            <div class='d-flex justify-content-center'>
            </div>     
    </form>
</br>

</div>


<!-- fin codigo impo-->

@endsection

@section("scripts")

@endsection