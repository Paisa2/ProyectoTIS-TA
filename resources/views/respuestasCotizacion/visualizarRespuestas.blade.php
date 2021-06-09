@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
@if(session()->has('confirm'))
  <div class="alert alert-success" role="alert" id="confirm">
  {{session()->get('confirm')}}
  </div>
  <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

<div class="container my-4 container-table">

    <form action="/SolicitudCotizacion" method="table">
        {{csrf_field()}}
        <div class='d-flex justify-content-center'>
            <h2 class="display-4">Lista de Cotizaciones</h2>
        </div>    
        <br><br>
        <table class="table">
          
            <thead>
                <tr>
                    <th scope="col">NRO</th>
                    <th scope="col">CODIGO DE COTIZACIÓN</th>
                    <th scope="col">RAZON SOCIAL</th>
                    <th scope="col">FECHA</th>  
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($cotizaciones as $cotizacion)

            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{$cotizacion->codigo_cotizacion}}</td>
                <td>{{$cotizacion->razon_social}}</td>
                <td>{{date("Y-m-d",strtotime($cotizacion->fecha_cotizacion))}}</td>   
                <td class="options">
                  <div class="dropdown dropleft">
                <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                  </svg>
                </span>
                <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                  <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                  <a class="dropdown-item" href="{{ route('respuestasCotizacion.show', $cotizacion->resp_cot_id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles
                  </a>              
                  @if($cotizacion->pdf < 1)
                  <a class="dropdown-item" href="{{ route('formulario', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/cloud-upload.svg#i-cloud-upload')}}"></use>
                    </svg>Agregar PDF
                  </a>
                  @endif
                  @if($cotizacion->pdf > 0)
                  <a class="dropdown-item" href="{{asset($cotizacion->pdf_ruta)}}" target="_blank">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/external-link.svg#i-external-link')}}"></use>
                    </svg>Visualizar PDF
                  </a>
                  @endif
                </div>
              </div>
                </td>       
            </tr>
            @endforeach
            </tbody>    
        </table>                      
    </form>
</br>
</div>

<!-- fin codigo importante -->
@endsection