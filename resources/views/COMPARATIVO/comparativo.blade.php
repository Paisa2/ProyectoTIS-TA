@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/comparativoCotizaciones.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container my-4">

    <form action="/solicitudCotizacion" method="post">
      {{csrf_field()}}
      <div class="titulo d-flex justify-content-center">
    <h1 class="display-4">Cuadro Comparativo de Cotizaciones</h1>
  </div>
  <div class="d-flex justify-content-end" style="margin-top:-5rem;">
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
      <label class="numero">N° {{$datoscomparativo->codigo_cotizacion}}</label>
    </div>
  </div>
  
  <div class="row-0">CASAS COMERCIALES</div>
  <table class="comparativo">
    <thead>
      <tr>
        <th class="c-1">CANT.</th>
        <th class="c-2">UND.</th>
        <th class="c-3">DESCRIPCION</th>
        <th class="c-4">1</th>
        <th class="c-4">2</th>
        <th class="c-4">3</th>
        <th class="c-4">4</th>
        <th class="c-4">5</th>
      </tr>
    </thead>
    <tbody>
      @for($i=0; $i<count($propuestas[2]); $i++)
        <tr>
          <td>{{$propuestas[0][$i]}}</td>
          <td>@if(is_array($propuestas[1]))
                {{$propuestas[1][$i]}}
              @endif
          </td>
          <td>@if(is_array($propuestas[2]))
                {{$propuestas[2][$i]}}
              @endif
          </td>
          <td>@if(is_array($propuestas[3]))
                {{$propuestas[3][$i]}}
              @endif
          </td>
          <td>@if(is_array($propuestas[4]))
                {{$propuestas[4][$i]}}
              @endif
          </td>
          <td>@if(is_array($propuestas[5]))
                {{$propuestas[5][$i]}}
              @endif
          </td>
          <td>@if(is_array($propuestas[6])
                {{$propuestas[6][$i]}}
              @endif
          </td>
          <td>@if(is_array($propuestas[7]))
                {{$propuestas[7][$i]}}
              @endif
          </td>
        </tr>
      @endfor
      @for($i=0; $i<16-count($propuestas[2]); $i++)
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
    </tbody>
  </table>
  <div class="observaciones mb-3">
    <label for="observaciones" class="form-label">Observaciones: </label>
    <input type="text" id="observaciones" name="observaciones" class="form-control">
  </div>
  <table class="informacion">
    <thead>
      <tr>
        <th>SECCION ADQUISICION</th>
        <th>JEFE DE UNIDAD</th>
        <th>TECNICO RESPONSABLE</th>
        <th>JEFE ADMINISTRATIVO</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
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