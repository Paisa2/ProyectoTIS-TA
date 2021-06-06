@extends('base')

@section('head')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/crearSolicitudCotizacion.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
@endsection

@section('main')

<!-- codigo importante -->
<div class="container my-4">

    <form action="/solicitudCotizacion" method="post">
        {{csrf_field()}}
        <div class='d-flex justify-content-center'>
            <h1>SOLICITUD DE COTIZACIÓN</h1>
        </div>
        <br>
            <div class="row">
                    <div class="mb-3 col-6">
                    <div>
                    <label for="NumeroCotizacion" class="form-label col-auto">Número Cotización:</label>
                    <input type="text" class="form-control col" name="numero_cotizacion" id="NumeroCotizacion" autocomplete="off" value="{{old('numero_cotizacion')}}">
                    </div>
                    @foreach($errors->get('numero_cotizacion') as $message) 
                    <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="mb-3 col-6">
                    <div>
                    <label for="Fechas" class="form-label col-auto">Fecha:</label>
                    <input class="form-control col" type="date" name="fecha_cotizacion">
                    </div>
                    @foreach($errors->get('fecha_cotizacion') as $message) 
                    <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
                    @endforeach
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
        @for($i=0; $i<16; $i++)
          <tr>
            <td><input type="number" min="1" max="16" name="detalles[numero][n{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[cantidad][c{{$i}}]"></td>
            <td><input type="text" name="detalles[unidad][ud{{$i}}]"></td>
            <td class="d4"><input type="text" name="detalles[detalle][d{{$i}}]"></td>
            <td></td>
            <td></td>
						<!-- <td><input type="number" min="1" name="detalles[unitario][uo{{$i}}]"></td>
            <td><input type="number" min="1" name="detalles[total][t{{$i}}]"></td> -->
          </tr>
        @endfor
      </tbody>
    </table>

            <div class='d-flex justify-content-center'>
                <button id="registrar" type='submit' class="btn btn-primary">Registrar</button>
            </div>     
    </form>
</br>

</div>


<!-- fin codigo impo-->

@endsection

@section("scripts")
<script type="text/javascript">

  $("#registrar").on("focus", function(){
    let html = $("#table-detalle").html();
    html = html.replace(/contenteditable="true"/g, "")
    .replace(/  /g, "");
    $("#detalle").val(html);
  });

</script>
@endsection