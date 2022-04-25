@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/comparativoCotizaciones.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">

    <form action="{{route('comparativo.update',$datoscomparativo->id)}}" method="get">
      {{csrf_field()}}
      <div class="titulo d-flex justify-content-center">
    <h1 class="display-4">Detalles del Cuadro Comparativo</h1>
  </div>
  <div class="d-flex justify-content-end" style="margin-top:-3rem;">
    <div class="fecha">
      <table>
        <thead>
          <tr>
            <th colspan="3">EMISION</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{date("d",strtotime($datoscomparativo->fecha_comparativo))}}</td>
            <td>{{date("m",strtotime($datoscomparativo->fecha_comparativo))}}</td>
            <td>{{date("Y",strtotime($datoscomparativo->fecha_comparativo))}}</td>
          </tr>
        </tbody>
      </table>
      <label class="numero"><b>N°</b> {{$datoscomparativo->codigo_cotizacion}}</label>
    </div>
  </div>
  <div class="d-flex justify-content-between">
    <div class="mb-3">
      <div class="mb-3">
        <label for="observaciones" class="labelcompad"><b>DESICION:&nbsp;</b></label>
        <label class="labelcompad"> {{$datoscuadrocomparativo->empresa_recomendada?"Adquisicion Aceptada":"Adquisicion Rechazada"}}</label>
      </div>
      <div>
        <label for="observaciones" class="labelcompad"><b>EMPRESA SELECCIONADA:&nbsp;</b></label>
        <label class="labelcompad">{{$datoscuadrocomparativo->empresa_recomendada ? $datoscuadrocomparativo->empresa_recomendada : 'Ninguna empresa'}}</label>
      </div>
    </div>
    <div class="d-flex align-items-center mb-3">
      @if(session()->has('Visualizar solicitud de cotizacion'))
      <div class="comparativo-options">
        <a href="{{route('solicitudCotizacion.index')}}">
          <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Lista de cotizaciones">
            <use xlink:href="{{asset('img/icons/list.svg#i-list')}}"></use>
          </svg>
        </a>
      </div>
      @endif
      <div class="comparativo-options">
        <a href="{{$datoscomparativo->informe_id ? route('detalleinforme', $datoscomparativo->informe_id) : route('emitirinforme', $datoscomparativo->id)}}">
          <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="{{$datoscomparativo->informe_id? 'Ver informe' : 'Emitir informe' }}">
            <use xlink:href="{{$datoscomparativo->informe_id ? asset('img/icons/clipboard-details.svg#i-clipboard-details') : asset('img/icons/clipboard.svg#i-clipboard') }}"></use>
          </svg>
        </a>
      </div>
      @if(session('tipo_unidad') != 'unidad de gasto' && session()->has('Crear cuadro comparativo'))
      <div class="comparativo-options" id="event-print">
        <a href="{{route('comparativo.generarpdf', $datoscomparativo->id)}}" target="_blank">
          <svg class="c-icon c-icon-lg" data-toggle="tooltip" data-placement="top" title="Imprimir" viewBox="0 0 32 32">
            <!-- <use xlink:href="{{asset('img/icons/print.svg#i-print')}}"></use> -->
            <path d="M6 2H26L26 8C26.8889 8 27.6424 8.18593 28.2558 8.56078C28.8744 8.93882 29.2772 9.46436 29.533 10.0184C30.0013 11.0332 30.0005 12.2207 30 12.9342C30 12.9566 30 12.9785 30 13V24H26V22H28V13C28 12.2046 27.984 11.4349 27.717 10.8566C27.5978 10.5981 27.4381 10.4049 27.2129 10.2673C26.9826 10.1266 26.6111 10 26 10H6C5.38887 10 5.01744 10.1266 4.78708 10.2673C4.56194 10.4049 4.40223 10.5981 4.28296 10.8566C4.01603 11.4349 4 12.2046 4 13V22H6V24H2V13C2 12.9785 1.99999 12.9566 1.99997 12.9342C1.99949 12.2207 1.99869 11.0332 2.46704 10.0184C2.72277 9.46436 3.12556 8.93882 3.74418 8.56078C4.35757 8.18593 5.11114 8 6 8V2ZM8 8H24V4H8V8ZM6 16H26V18H6V16Z"/>
            <path class="paper" d="M8 18H10V28.1538H22V18H24V30H8V18Z"/>
          </svg>
        </a>
      </div>
      @endif
    </div>
  </div>
  <div class="row-0"><b>CASAS COMERCIALES</b></div>
  <table class="comparativo">
    <thead>
      <tr>
        <th class="c-1"><b>CANT.</b></th>
        <th class="c-2"><b>UND.</b></th>
        <th class="c-3"><b>DESCRIPCION</b></th>
        <th class="c-4 r-1">
              @if(0<count($empresas))
                {{$empresas[0][0]}}
              @endif
              <br><b>1</b></th>
        <th class="c-4 r-2">
              @if(1<count($empresas))
                {{$empresas[1][0]}}
              @endif
              <br><b>2</b></th>
        <th class="c-4 r-3">
              @if(2<count($empresas))
                {{$empresas[2][0]}}
              @endif
              <br><b>3</b></th>
        <th class="c-4 r-4">
              @if(3<count($empresas))
                {{$empresas[3][0]}}
              @endif
              <br><b>4</b></th>
        <th class="c-4 r-5">
              @if(4<count($empresas))
                {{$empresas[4][0]}}
              @endif
              <br><b>5</b></th>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i<count($propuestas[2]); $i++)
        <tr>
          <td>{{$propuestas[1][$i]}}</td>
          <td>@if(2<count($propuestas))
                {{$propuestas[2][$i]}}
              @endif
          </td>
          <td class="dd">@if(3<count($propuestas))
                {{$propuestas[3][$i]}}
              @endif
          </td>
          <td>@if(4<count($propuestas))
                {{$propuestas[4][$i]}}
              @endif
          </td>
          <td>@if(5<count($propuestas))
                {{$propuestas[5][$i]}}
              @endif
          </td>
          <td>@if(6<count($propuestas))
                {{$propuestas[6][$i]}}
              @endif
          </td>
          <td>@if(7<count($propuestas))
                {{$propuestas[7][$i]}}
              @endif
          </td>
          <td>@if(8<count($propuestas))
                {{$propuestas[8][$i]}}
              @endif
          </td>
        </tr>
      @endfor
      @for($i=0; $i<10-count($propuestas[2]); $i++)
       <tr>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       </tr>
      @endfor
      <tr>
       <td colspan="3"><b>TOTALES</b></td>
       <td class="r-1">
       @if(0<count($empresas))
          {{$empresas[0][1]}}
       @endif
        </td>
       <td class="r-2">
       @if(1<count($empresas))
          {{$empresas[1][1]}}
       @endif
        </td>
       <td class="r-3">
       @if(2<count($empresas))
          {{$empresas[2][1]}}
       @endif
        </td>
       <td class="r-4">
       @if(3<count($empresas))
          {{$empresas[3][1]}}
       @endif
        </td>
       <td class="r-5">
       @if(4<count($empresas))
          {{$empresas[4][1]}}
       @endif
        </td>
       </tr>
    </tbody>
  </table>
  <div class="mb-3">
    <label for="observaciones" class="labelcompad"><b>OBSERVACIONES:</b> </label>
    <label class="labelcompad">{{$datoscuadrocomparativo->observaciones_comparativo ? $datoscuadrocomparativo->observaciones_comparativo : 'Sin observaciones'}}</label>
  </div>
  <table class="informacion">
    <thead>
      <tr>
        <th><b>SECCION ADQUISICION</b></th>
        <th><b>JEFE DE UNIDAD</b></th>
        <th><b>TECNICO RESPONSABLE</b></th>
        <th><b>JEFE ADMINISTRATIVO</b></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>{{$datoscomparativo->unidad_solicitante}}</td>
        <td>{{$datoscomparativo->nombre_jefe_solicitante}}</td>
        <td>{{$datoscomparativo->nombre_tecnico_responsable}}</td>
        <td>{{$datoscomparativo->nombre_jefe_administrativo}}</td>
      </tr>
    </tbody>
  </table>   
    </form>
</br>

</div>


<!-- fin codigo impo-->

@endsection

@section("scripts")

@endsection