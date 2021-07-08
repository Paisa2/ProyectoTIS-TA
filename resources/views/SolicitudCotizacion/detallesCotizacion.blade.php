@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">
    <form>
      <h2 class="display-4">Detalle de solicitud de Cotización</h2>
      <div class="d-flex justify-content-center">
        <h2 class="display-4">N°{{$cotizacion->codigo_cotizacion}}</h2>
      </div>
      <div class="d-flex justify-content-end">
        <div class="align-self-center">
          <div class="d-flex">
            <div class="cotizacion-options">
              <a href="{{route('solicitudCotizacion.index')}}">
                <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Lista de cotizaciones">
                  <use xlink:href="{{asset('img/icons/list.svg#i-list')}}"></use>
                </svg>
              </a>
            </div>
            @if(session()->has('Crear solicitud de cotizacion'))
            <div class="cotizacion-options" id="event-print">
              <a href="{{ route('comparativo.detalle', $cotizacion->comparativo_id) }}">
                <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Imprimir" viewBox="0 0 32 32">
                  <!-- <use xlink:href="{{asset('img/icons/print.svg#i-print')}}"></use> -->
                  <path d="M6 2H26L26 8C26.8889 8 27.6424 8.18593 28.2558 8.56078C28.8744 8.93882 29.2772 9.46436 29.533 10.0184C30.0013 11.0332 30.0005 12.2207 30 12.9342C30 12.9566 30 12.9785 30 13V24H26V22H28V13C28 12.2046 27.984 11.4349 27.717 10.8566C27.5978 10.5981 27.4381 10.4049 27.2129 10.2673C26.9826 10.1266 26.6111 10 26 10H6C5.38887 10 5.01744 10.1266 4.78708 10.2673C4.56194 10.4049 4.40223 10.5981 4.28296 10.8566C4.01603 11.4349 4 12.2046 4 13V22H6V24H2V13C2 12.9785 1.99999 12.9566 1.99997 12.9342C1.99949 12.2207 1.99869 11.0332 2.46704 10.0184C2.72277 9.46436 3.12556 8.93882 3.74418 8.56078C4.35757 8.18593 5.11114 8 6 8V2ZM8 8H24V4H8V8ZM6 16H26V18H6V16Z"/>
                  <path class="paper" d="M8 18H10V28.1538H22V18H24V30H8V18Z"/>
                </svg>
              </a>
            </div>
            @endif
            @if($cotizacion->comparativo>0 && session()->has("Visualizar cuadro comparativo"))
            <div class="cotizacion-options">
              <a href="{{ route('comparativo.detalle', $cotizacion->comparativo_id) }}">
                <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Detalles del Cuadro Comparativo">
                  <use xlink:href="{{asset('img/icons/spreadsheet-details.svg#i-spreadsheet-details')}}"></use>
                </svg>
              </a>
            </div>
            @endif
            @if(session()->has('Crear cuadro comparativo'))
            <div class="cotizacion-options">
              <a href="{{$cotizacion->respuestas > 2 && $cotizacion->informes == 0 ? route('comparativo.generar', $cotizacion->id) : '#' }}" 
                class="{{$cotizacion->respuestas < 3 || $cotizacion->informes > 0 ? 'disabled' : ''}}" 
                data-toggle="{{$cotizacion->respuestas < 3 || $cotizacion->informes > 0 ? 'popover' : ''}}" data-placement="left" data-trigger="focus" title="{{$cotizacion->respuestas < 3 || $cotizacion->informes > 0 ? 'Deshabilitado' : ''}}"
                data-content="{{$cotizacion->respuestas < 3 ? 'La solicitud de cotización debe tener por lo menos 3 propuestas.' : ($cotizacion->informes > 0 ? 'La cotización ya fue concluida.' : '') }}"  >
                <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Generar cuadro comparativo">
                  <use xlink:href="{{asset('img/icons/spreadsheet.svg#i-spreadsheet')}}"></use>
                </svg>
              </a>
            </div>
            @endif
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="mb-3 col-sm-8 col-lg-9">
          <div>
            <label for="NumeroCotizacion" class="form-label"><b>RAZON SOCIAL:</b></label>
            <span style="border-bottom: 1px dotted #fff; width: calc(100% - 110px); display: inline-block;color:transparent !important;">l</span>
          </div>  
        </div>
        <div class="mb-3 col-sm-4 col-lg-3">
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
        <form action="{{ route('generarCotPdf') }}" method="post" id="generar-form" target="_blank">
          {{ csrf_field() }}
          <input type="text" name="cotizacion_id" class="d-none form-control" value="{{$cotizacion->id}}">
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
                <span class="search"><input type="text" class="form-control" placeholder="Buscar"></span>
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
<!-- fin codigo impo-->

@endsection

@section("scripts")

<script>
$(window).on("load", function(e){

  $("#with-business").on("click", function(){
    if ($('#with-business > input').is(':checked')){ 
      // con razon social on
      $("#business").removeClass("d-none");
      $("#razon_social").prop("disabled", false);
      $("#required-rs").addClass("d-none");
    }else{ 
      // con razon social off
      $("#business").addClass("d-none");
      $("#razon_social").prop("disabled", true);
      $("#required-rs").addClass("d-none");
    }
  });
  $("#generar-cot-pdf").on("click", function(e){
    if ($('#with-business > input').is(':checked')){ 
      // con razon social on
      if($("#razon_social").val() == ""){
        e.preventDefault();
        $("#required-rs").removeClass("d-none");
        setTimeout(function(){$("#required-rs").addClass("d-none")},3000);
      }
    }else {
      $("#required-rs").addClass("d-none");
    }
  });

});
</script>
@endsection