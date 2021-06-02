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
            <h2>LISTA DE COTIZACIONES</h2>
        </div>    
        <table class="table">

            <div style="display:flex;justify-content:flex-end;" class="mb-3">
                <a class="btn btn-primary" href="{{url('solicitudCotizacion/create')}}">+ Nuevo</a>
            </div>
            <thead>
                <tr>
                    <th scope="col">NRO</th>
                    <th scope="col">NUMERO COTIZACIÓN</th>
                    <th scope="col">RAZÓN SOCIAL</th>
                    <th scope="col">FECHA</th> 
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($cotizaciones as $cotizacion)

            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{$cotizacion->numero_cotizacion}}</td>
                <td>{{$cotizacion->razon_social}}</td>
                <td>{{$cotizacion->fecha_cotizacion}}</td>   
                <td class="options">
                  <div class="dropdown dropleft">
                <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                  </svg>
                </span>
                <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                  <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                  <a class="dropdown-item" href="{{ route('formulario', $cotizacion->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/cloud-upload.svg#i-cloud-upload')}}"></use>
                    </svg>Agregar PDF
                  </a>
                  <a class="dropdown-item" href="{{asset('storage/ASO.pdf')}}" target="_blank">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/external-link.svg#i-external-link')}}"></use>
                    </svg>Visualizar PDF
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

