@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@if(session()->has('confirm'))
  <div class="alert alert-success" role="alert" id="confirm">
      {{session()->get('confirm')}}
  </div>
  <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

@section('main')

<!-- codigo importante -->

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
                </tr>
            </thead>
            <tbody>
            @foreach($cotizaciones as $cotizacion)

            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{$cotizacion->numero_cotizacion}}</td>
                <td>{{$cotizacion->razon_social}}</td>
                <td>{{$cotizacion->fecha_cotizacion}}</td>          
            </tr>
            @endforeach
            </tbody>    
        </table>                      
    </form>
</br>
</div>

<!-- fin codigo importante -->
@endsection