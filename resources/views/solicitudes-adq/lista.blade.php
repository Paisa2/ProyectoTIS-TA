@extends('base')
@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
@if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
<div style="width: 90%; margin:24px auto;" class="container-table">
  <div><h1 class="display-4">Solicitudes de Adquisiciones</h1></div>  
    <div class="row g-2">
      <div class="col-md" style="margin-bottom: 1rem;">
      <form action="" method="get">
      {{-- <div class="btn-group" role="group" aria-label="Basic outlined example">
        <input type="submit" value="compra" class="btn btn-outline-primary" name="compra" id="compra">
        <input type="submit" value="alquiler" class="btn btn-outline-primary" name="alquiler" id="alquiler">
      </div> --}}
      <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <input type="submit" class="btn btn-primary" name="todos" id="todos" value="Todos" checked>
      
        <input type="submit" class="btn btn-primary" name="compra" id="compra" value="Compra">
      
        <input type="submit" class="btn btn-primery" name="alquiler" id="compra" value="Alquiler" >
      </div>
      </form>
      </div>
      <div class="col-md">
      @if(session()->has('Crear solicitud de adquisicion'))
      <div class="d-flex justify-content-end mb-3">
        <a href="{{route('solicitud.create')}}" class="btn btn-primary">+ Nuevo</a>
      </div>
      @endif
      </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">NRO</th>
                <th scope="col">JUSTIFICACION</th>
                <th scope="col">CODIGO</th>
                <th scope="col">TIPO</th>
                <th scope="col">ESTADO</th>
                <th class="options"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($solicitudes as $listadb)
        <tr>
            <td scope="row">{{ $loop->index +1}}</td>
            <td>{{$listadb->justificacion_solicitud_a}}</td>
            <td>{{$listadb->codigo_solicitud_a}}</td>
            <td>{{$listadb->tipo_solicitud_a}}</td>
            <td>{{$listadb->estado_solicitud_a}}</td>
            <td class="c-dark-theme options">
              <div class="dropdown dropleft">
                <span id="dd-options{{$loop->index +1}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <svg class="c-icon mfe-2">
                    <use xlink:href="{{asset('img/icons/options.svg#i-options')}}"></use>
                  </svg>
                </span>
                <div class="dropdown-menu" aria-labelledby="dd-options{{$loop->index +1}}">
                  <div class="dropdown-header bg-light py-2"><strong>Opciones</strong></div>
                  <a class="dropdown-item" href="{{ route('solicitud.show', $listadb->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                  </svg>Detalles
                  </a>
                  @if($listadb->estado_solicitud_a=="Registrado" && session()->has('Editar solicitud de adquisicion') && session('id')==$listadb->de_usuario_id)
                  <a class="dropdown-item" href="{{ route('reenviar', $listadb->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/send.svg#i-send')}}"></use>
                    </svg>Enviar
                  </a>
                  @endif
                  @if($listadb->estado_solicitud_a=="Plazo de espera vencido" && session()->has('Editar solicitud de adquisicion') && session('id')==$listadb->de_usuario_id)
                  <a class="dropdown-item" href="{{ route('reenviar', $listadb->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/resend.svg#i-resend')}}"></use>
                    </svg>Reenviar
                  </a>
                  @endif
                  @if($listadb->estado_solicitud_a=="Pendiente" && session()->has('Editar solicitud de adquisicion') && session('tipo_unidad')!='unidad de gasto')
                  <a class="dropdown-item" href="{{ route('autopresupuesto', $listadb->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/details.svg#i-details')}}"></use>
                    </svg>Verificar
                  </a>
                  @endif
                  @if($listadb->estado_solicitud_a=="Proceso de cotizacion" && session()->has('Crear solicitud de cotizacion') && session('tipo_unidad')!='unidad de gasto' && $listadb->cotizacion < 1)
                  <a class="dropdown-item" href="{{ route('generarCotizacion', $listadb->id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/list-low-priority.svg#i-list-low-priority')}}"></use>
                    </svg>Generar Cotización
                  </a>
                  @endif
                  @if(session()->has('Visualizar solicitud de cotizacion') && $listadb->cotizacion > 0)
                  <a class="dropdown-item" href="{{ route('solicitudCotizacion.show', $listadb->cotizacion_id) }}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/quotation.svg#i-quotation')}}"></use>
                    </svg>Ver Cotización
                  </a>
                  @endif
                </div>
              </div>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{--  {!!$unidad->render()!!}  --}}
@endsection