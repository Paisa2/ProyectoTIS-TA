@extends('base')

@section('head')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/crearSolicitudCotizacion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container my-4">

    <form>
        <div class='d-flex justify-content-center'>
            <h1 class="display-4">Detalle de solicitud de Cotización {{$cotizacion->codigo_cotizacion}}</h1>
        </div>
        <br>
            <div class="row">
                    <div class="mb-3 col-10">
                    <div>
                    <label for="NumeroCotizacion" class="form-label col-auto"><b>RAZON SOCIAL:</b></label>
                    <span style="border-bottom: 1px dotted #fff; width: 50%; display: inline-block;"></span>
                    </div>
                    
                </div>
                <div class="mb-3 col-2">
                    <div>
                    <label class="form-label col-auto"><b>FECHA:</b></label>
                    <label>{{date("Y-m-d",strtotime($cotizacion->fecha_cotizacion))}}</label>
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
            <td class="d4">{{$detalles[3][$i]}}</td>
            <td></td>
            <td></td>
						<!-- <td><input type="number" min="1" name="detalles[unitario][uo{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[total][t{{$i}}]"></td> -->
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