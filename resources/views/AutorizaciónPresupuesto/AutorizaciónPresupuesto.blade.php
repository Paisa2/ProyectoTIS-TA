@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/AutorizaciónSolicitud.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset('css/solicitarAdq.css') }}">

@endsection
@section('main')
<div class="container ">

  <div class="row">
  <div class="col-8">
  <form >
    <div>
      <h2 class="display-4">Detalle de la Solicitud de Adquisición N° {{$autopre->codigo_solicitud_a}}</h2>
      <br>
      <label  for="exampleInputEmail1" class="form-label"><b>TIPO:</b></label>
      <label>{{$autopre->tipo_solicitud_a}}</label>

    <div class='row'>
    <div class='col-6'>
    <label  for="exampleInputEmail1" class="form-label"><b>UNIDAD SOLICITANTE:</b></label>
    <label>{{$autopre->nombre_unidad}}</label>
    </div>

    <div class='col-6'>
    <label  for="exampleInputEmail1" class="form-label"><b>ELABORADO POR:</b></label>
    <label>{{$autopre->nombres}} {{$autopre->apellidos}}</label>
    </div>
    </div>

    <div class="row">
    <div class="col-6">
    
    <label  for="exampleInputEmail1" class="form-label"><b>FECHA DE PEDIDO:</b></label>
    <label>{{$autopre->created_at}}</label>
    </div>
    <div class="col-6">
    <label  for="exampleInputEmail1" class="form-label"><b>FECHA DE ENTREGA:</b></label>
    <label>{{date("Y-m-d",strtotime($autopre->fecha_entrega))}}</label>
    </div>
    </div>
    
    
  
    <label  for="exampleInputEmail1" class="form-label"><b>JUSTIFICACIÓN:</b></label>
    <br>

    <label class="soli" >{{$autopre->justificacion_solicitud_a}}</label>
    <br>
    @if($autopre->tipo_solicitud_a=="Compra")
    <table class="tabla-compra" id="compra">
      <thead>
        <tr>
          <th class="c-0">N°</th>
          <th class="c-1">Item</th>
          <th class="c-2">Cantidad</th>
          <th class="c-2">Unidad</th>
          <th class="c-2">Precio</th>
        </tr>
      </thead>
      <tbody>
      @for($i=0; $i<10; $i++)
        <tr>
          <td>{{$detalles[0][$i]}}</td>
          <td class="articulo"><span>{{$detalles[1][$i]}}</span></td>
          <td>{{$detalles[2][$i]}}</td>
          <td>{{$detalles[3][$i]}}</td>
          <td>{{$detalles[4][$i]}}</td>
        </tr>
        @endfor
        <tr>
          <td colspan="4">TOTAL</td>
          <td>{{$autopre->total_solicitud_a}}</td>
        </tr>
      </tbody>
    </table>
    @else
    <table class="tabla-alquiler" id="alquiler">
      <thead>
        <tr>
          <th class="c-0">N°</th>
          <th class="c-1">Servicio</th>
          <th class="c-2">Duracion</th>
          <th class="c-2">Periodo</th>
          <th class="c-2">Precio</th>
        </tr>
      </thead>
      <tbody>
          @for($i=0; $i<10; $i++)
        <tr>
          <td>{{$detalles[0][$i]}}</td>
          <td class="articulo"><span>{{$detalles[1][$i]}}</span></td>
          <td>{{$detalles[2][$i]}}</td>
          <td>{{$detalles[3][$i]}}</td>
          <td>{{$detalles[4][$i]}}</td>
        </tr>
        @endfor
        <tr>
          <td colspan="4">TOTAL</td>
          <td>{{$autopre->total_solicitud_a}}</td>
        </tr>
      </tbody>
    </table>
    @endif
    </div>
  </form>

  </div>
  <div class="col-4">

  <form >
    <div >
      <h3 class="display-6">VERIFICAR PRESUPUESTO</h3>
      <br>
      <label  for="exampleInputEmail1" class="form-label"><b>UNIDAD SOLICITANTE:</b> </label>
    
    <div>{{$autopre->nombre_unidad}}</div>
    <br>
    <label  for="exampleInputEmail1" class="form-label"><b>PRESUPUESTO:</b></label>
    
    <label>
    @if($presupuesto)
      {{$presupuesto->monto}} bs
    @else
      Sin presupuesto
    @endif
  </label>
    <br>
    <br>
    
      <div class="submit">
        <a href="{{route('verificarpresupuesto',['aceptar', $autopre->id])}}" class="btn btn-primary">Aceptar</a>
      </div>
      <br>
      <div class="submit">
        <a href="{{route('verificarpresupuesto',['rechazar', $autopre->id])}}" class="btn btn-primary">Rechazar</a>
      </div>
    </div>
    </form>

  
  </div>

</div>




 
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection