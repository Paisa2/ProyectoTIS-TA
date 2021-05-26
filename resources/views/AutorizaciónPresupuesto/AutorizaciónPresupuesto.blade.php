@extends('base')
@section('title')
AtorizaciónPresupuesto
@endsection

@section('head')
<title>AtorizaciónPresupuesto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/AutorizaciónSolicitud.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection
@section('main')
<div class="container ">

  <div class="row">
  <div class="col-8">
  <form >
   <div>
     <h3>DETALLE DE LA SOLICITUD DE ADQUISICIÓN</h3>
   
    @foreach($autopresupuesto as $autopre)
    <label  for="exampleInputEmail1" class="form-label">TIPO:</label>
    
    <label>{{$autopre->tipo_solicitud_a}}</label>
    <br>
    <label  for="exampleInputEmail1" class="form-label">ELABORADO POR:</label>
    
    <label>{{$autopre->nombres}} {{$autopre->apellidos}}</label>
    <br>
    <label  for="exampleInputEmail1" class="form-label">UNIDAD SOLICITANTE:</label>
    
    <label>{{$autopre->nombre_unidad}}</label>
    <br>
    <label  for="exampleInputEmail1" class="form-label">FECHA DE PEDIDO:</label>
    
    <label>{{$autopre->created_at}}</label>
    <br>
    <label  for="exampleInputEmail1" class="form-label">FECHA DE ENTREGA:</label>
    
    <label>{{$autopre->fecha_entrega}}</label>
    <br>
    <label  for="exampleInputEmail1" class="form-label">JUSTIFICACIÓN:</label>
    <br>

    <label class="soli" >{{$autopre->justificacion_solicitud_a}}</label>
    <br>
    <label class="table">{!!$autopre->detalle_solicitud_a!!}</label>
    @endforeach
   </div>
   </form>

  </div>
  <div class="col-4">

  <form >
   <div >
     <h3>VERIFICAR PRESUPUESTO</h3>
   
    @foreach($autopresupuesto as $autopre)
    <label  for="exampleInputEmail1" class="form-label">UNIDAD QUE SOLICITA: </label>
    
    <div>{{$autopre->nombre_unidad}}</div>
    <br>
    <label  for="exampleInputEmail1" class="form-label">PRESUPUESTO:</label>
    <br>
    <label>{{$autopre->monto}} bs</label>
    <br>
    
    <div class="submit">
     <button type="submit" class="btn btn-primary">ACEPTAR</button>
    </div>
    <br>
    <br>
    <div class="submit">
    <button type="submit" class="btn btn-primary">RECHAZAR</button>
     </div>
     
    @endforeach
   </div>
   </form>

  
  </div>
  
  
  
  
</div>




 
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection