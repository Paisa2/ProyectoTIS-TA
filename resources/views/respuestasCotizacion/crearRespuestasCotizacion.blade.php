@extends('base')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/forms.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Cotizacion/tablaCotizacion.css') }}">
@endsection

@section('main')

<!-- codigo importante -->


<div class="container-form">


    <form action='{{route("respuestasCotizacion.store", $cotizacion->id)}}' method="post">
      <h2 class="display-4">Solicitud de Cotización</h2>
      <h2 class="display-4">N°{{$cotizacion->codigo_cotizacion}}</h2>
      {{csrf_field()}}
      <br>
      <div class="row">
        <div class="mb-3 col-9">
          <div>
            <label for="razon_social" class="form-label"><b>RAZON SOCIAL:</b></label>
            <div class="select-editable" id="business" style="width: calc(100% - 110px); display: inline-block;">
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
              <input type="text" name="razon_social" id="razon_social" class="form-control bg-transparent" autocomplete='off' value="{{old('razon_social')}}">
            </div>
            @foreach($errors->get('razon_social') as $message) 
              <div class="alert alert-danger" role="alert">{{$message}}</div>
            @endforeach
          </div>  
        </div>
        <div class="mb-3 col-3">
          <div>
            <label class="form-label"><b>FECHA:</b></label>
            <label style="border-bottom: 1px dotted #fff; width: calc(100% - 55px); display: inline-block;text-align:center;">{{date("Y-m-d",strtotime($cotizacion->fecha_cotizacion))}}</label>
          </div>    
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
        @for($i=0; $i<count($detalles[3]); $i++)
          <tr>
            <td>{{$detalles[0][$i]}}</td>
            <td id="c-{{$i+1}}">{{$detalles[1][$i]}}</td>
            <td>{{$detalles[2][$i]}}</td>
            <td class="d4"><span>{{$detalles[3][$i]}}</span></td>
						<td><input type="number" min="1" name="detalles[unitario][uo{{$i}}]" value="{{old('detalles.unitario.uo'.$i)}}" class="{{$detalles[3][$i]}} ? '' : 'not' }}" id="u-{{$i+1}}" autocomplete='off'></td>
            <td><input type="number" min="1" name="detalles[total][t{{$i}}]" value="{{old('detalles.total.t'.$i)}}" class="{{$detalles[3][$i]}} ? '' : 'not' }}" id="t-{{$i+1}}" autocomplete='off'></td>
          </tr>
        @endfor
      </tbody>
    </table>

      <div class='d-flex justify-content-center'>
          <button id="registrar" type='submit' class="btn btn-primary">REGISTRAR</button>
      </div>  
    </form>

</br>

</div>


<!-- fin codigo impo-->

@endsection

@section("scripts")
<script type="text/javascript">

  $(window).on("load", function(){
    $("#cotizacion tbody td input[id*='u-']").on("keyup",function(){
      if($(this).val() != ""){
        let id=$(this).attr("id");
        let numero=id.charAt(id.length-1);
        if(id.charAt(id.length-2) != "-"){
          numero=id.charAt(id.length-2)+numero;
        }
        let total=0;
        let unitario = parseInt($(this).val());
        let cantidad = parseInt($("#c-"+numero).text());
        if(!isNaN(unitario) && !isNaN(cantidad)){//value es numero?
          total = unitario * cantidad;
        }
        if(total > 0){
          $('#t-'+numero).val(total);
        }else{
          $("#t-"+numero).val("");
        }
      }
    });
    $("#cotizacion tbody td:last-child, .not").on("keydown",function(e){
      e.preventDefault();
    });
  });

</script>
@endsection