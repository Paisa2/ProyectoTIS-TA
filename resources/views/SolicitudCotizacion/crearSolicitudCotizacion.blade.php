@extends('base')

@section('head')
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/crearSolicitudCotizacion.css') }}">
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
                <div class="mb-3 col-6 row">
                    <label for="RazonSocial" class="form-label col-auto">Razón Social:</label>
                    <input type="text" class="form-control col" name="razon_social" id="RazonSocial" value="{{old('razon_social')}}">
                    @foreach($errors->get('razon_social') as $message) 
                    <div class="alert alert-danger col-12" role="alert">{{$message}}</div>
                    @endforeach
                </div>

                <div class="mb-3 col-6 row">
                    <label for="Fechas" class="form-label col-auto">Fecha:</label>
                    <input class="form-control col" type="date" name="fecha_cotizacion">
                </div>
            </div>

            <input class="d-none" type="text" name="detalle" id="detalle">
            <div id="table-detalle">
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
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td class="d4" contenteditable="true"></td>
                    <td contenteditable="true"></td>
                    <td contenteditable="true"></td>
                </tr>
            @endfor
		</tbody>
	</table>
            </div>

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