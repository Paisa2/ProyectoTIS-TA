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
                <td>{{str_pad($cotizacion->id, 6, '0', STR_PAD_LEFT)}}</td>
                <td>{{$cotizacion->razon_social}}</td>
                <td>{{$cotizacion->fecha_cotizacion}}</td>   
                <td class="c-dark-theme options">
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
                        <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                      </svg>Agregar PDF
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