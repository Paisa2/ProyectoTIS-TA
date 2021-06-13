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
        <table class="table">

          @if(session()->has('Crear solicitud de cotizacion'))
          <div style="display:flex;justify-content:flex-end;" class="mb-3">
            <a class="btn btn-primary" href="{{url('solicitudCotizacion/create')}}">+ Nuevo</a>
          </div>
          @else
          <br><br>
          @endif
            <thead>
                <tr>
                    <th scope="col">NRO</th>
                    <th scope="col">CODIGO DE COTIZACIÓN</th>
                    <th scope="col">CANTIDAD DE RESPUESTAS</th>
                    <th scope="col">FECHA</th> 
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($cotizaciones as $cotizacion)

            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{$cotizacion->codigo_cotizacion}}</td>
                <td>{{$cotizacion->respuestas}}</td>
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
                  <a class="dropdown-item" href="{{ route('solicitudCotizacion.show', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles
                  </a>
                  @if($cotizacion->respuestas>0)
                  <a class="dropdown-item" href="{{ route('respuestasCotizacion.index', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Ver Propuestas
                  </a>                  
                  @endif
                  @if($cotizacion->respuestas<5)
                  <a class="dropdown-item" href="{{ route('respuestasCotizacion.create', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/plus.svg#i-plus')}}"></use>
                  </svg>Añadir Respuesta
                  </a>                  
                  @endif
                  <a class="dropdown-item" href="{{ route('comparativo.generar', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/list-low-priority.svg#i-list-low-priority')}}"></use>
                  </svg>Generar Cuadro Comparativo
                  </a>     
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

