@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container-form">
    <form action="/solicitudCotizacion" method="post" novalidate>
      {{csrf_field()}}
      <h1 class="display-4">Solicitud de Cotización</h1>
      <br>
      <div class="row">
        <div class="mb-3 col-lg-6">
          <div class="row align-items-center">
          <label for="NumeroCotizacion" class="col-auto" style="margin: 0;">Número Cotización:</label>
          <input type="text" class="form-control col" name="numero_cotizacion" id="NumeroCotizacion" autocomplete="off" value="{{old('codigo_cotizacion')? old('codigo_cotizacion') : $codigo }}" style="margin-right:1rem;">
          </div>
          @foreach($errors->get('numero_cotizacion') as $message) 
          <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
          @endforeach
        </div>
        <div class="mb-3 col-lg-6">
            <div class="row align-items-center">
            <label for="Fechas" class="col-auto" style="margin: 0;">Fecha:</label>
            <input class="form-control col" type="date" name="fecha_cotizacion" style="margin-right:1rem;">
            </div>
            @foreach($errors->get('fecha_cotizacion') as $message) 
            <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
            @endforeach
        </div>
      </div>



    <table class="cotizacion" id="cotizacion">
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
        @for($i=0; $i<16; $i++)
          <tr>
            <td><input id="n-{{$i+1}}" type="text" name="detalles[numero][n{{$i}}]" value="{{old('detalles.numero.n'.$i)}}" autocomplete="off"></td>
            <td><input type="number" min="1" name="detalles[cantidad][c{{$i}}]" value="{{old('detalles.cantidad.c'.$i)}}" autocomplete="off"></td>
            <td><input type="text" name="detalles[unidad][ud{{$i}}]" value="{{old('detalles.unidad.ud'.$i)}}" autocomplete="off"></td>
            <td class="d4"><input id="d-{{$i+1}}" type="text" name="detalles[detalle][d{{$i}}]" value="{{old('detalles.detalle.d'.$i)}}" autocomplete="off"></td>
            <td></td>
            <td></td>
						<!-- <td><input type="number" min="1" name="detalles[unitario][uo{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[total][t{{$i}}]"></td> -->
          </tr>
        @endfor
      </tbody>
    </table>
    @foreach($errors->get('detalles.numero.*') as $message)
    <div class="alert alert-danger" role="alert">{{$message}}</div>
    @endforeach

      <div class='d-flex justify-content-center'>
          <button id="registrar" type='submit' class="btn btn-primary">REGISTRAR</button>
      </div>     
    </form>

</div>

<!-- fin codigo impo-->

@endsection

@section("scripts")
<script type="text/javascript">

  $(window).on("load", function(){
    $("#cotizacion .d4 input").on("keypress",function(){
      if($(this).val() == ""){
        let id=$(this).attr("id");
        let numero=id.charAt(id.length-1);
        if(id.charAt(id.length-2) != "-"){
          numero=id.charAt(id.length-2)+numero;
        }
        $('#n-'+numero).val(numero);
      }
    });
    $("table tbody tr td:first-child").on("keydown",function(e){
      e.preventDefault();
    });
  });

</script>
@endsection