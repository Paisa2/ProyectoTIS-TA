@extends('base')

@section('head')
  <link rel="stylesheet" href="{{ asset('css/tables.css') }}">
  <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
@if(session()->has('confirm'))
  <div class="alert alert-success" role="alert" id="confirm">
  {{session()->get('confirm')}}
  </div>
  <script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif

<div class="container-table">

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
                    <th scope="col">FECHA</th> 
                    <th class="options"></th>
                </tr>
            </thead>
            <tbody>
            @foreach($cotizaciones as $cotizacion)

            <tr>
                <td>{{ $loop->index +1 }}</td>
                <td>{{$cotizacion->codigo_cotizacion}}</td>
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
                  <button class="dropdown-item" data-toggle="modal" data-target="#generar-pdf" data-value="{{$cotizacion->id}}">
                    <svg class="c-icon mfe-2">
                      <use xlink:href="{{asset('img/icons/print.svg#i-print')}}"></use>
                    </svg>Imprimir
                  </button>
                </div>
              </div>
                </td>       
            </tr>
            @endforeach
            </tbody>    
        </table>                      

</br>
</div>

<div class="modal fade" id="generar-pdf" tabindex="-1" aria-labelledby="presupestoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title d-flex kustify-content-center" id="presupestoLabel">Generar cotizacion en pdf</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('generarCotPdf') }}" method="post" id="generar-form">
          {{ csrf_field() }}
          <input type="text" name="cotizacion_id" class="d-none form-control" id="cotizacion_id">
          <label class="c-switch c-switch-label c-switch-pill c-switch-success c-switch-sm float-right" id="with-business">
            <input class="c-switch-input" type="checkbox" checked="">
            <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
          </label>
          <label class="form-label">Razon social:</label>
          <div class="select-editable" id="business">
            <div class="dropdown">
              <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <span class="search"><input type="text" class="form-control" ></span>
                <span class="options">
                  @foreach($empresas as $empresa)
                  <span class="dropdown-item" id="{{str_replace(' ', '_', $empresa->nombre_empresa)}}">{{$empresa->nombre_empresa}}</span>
                  @endforeach
                </span>
                <span class="without d-none">Sin resultados</span>
              </div>
            </div>
            <input type="text" name="razon_social" id="razon_social" class="form-control bg-transparent">
          </div>
        </form>
        <div class="alert alert-danger d-none" role="alert" id="required-rs">El campo razon social es requerido</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="generar-cot-pdf" form="generar-form">Generar</button>
      </div>
    </div>
  </div>
</div>

<!-- fin codigo importante -->
@endsection

@section('scripts')
  <script src="{{asset('js/solicitudesCotizacion/visualizarSolicitudCotizacion.js')}}"></script>
@endsection