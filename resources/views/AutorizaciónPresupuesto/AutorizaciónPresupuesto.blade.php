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
     <br>
   
    @foreach($autopresupuesto as $autopre)

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
    <label>{{$autopre->fecha_entrega}}</label>
    </div>
    </div>
    
    
  
    <label  for="exampleInputEmail1" class="form-label"><b>JUSTIFICACIÓN:</b></label>
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
     <br>
   
    @foreach($autopresupuesto as $autopre)
    <label  for="exampleInputEmail1" class="form-label"><b>UNIDAD QUE SOLICITA:</b> </label>
    
    <div>{{$autopre->nombre_unidad}}</div>
    <br>
    <label  for="exampleInputEmail1" class="form-label"><b>PRESUPUESTO:</b></label>
    
    <label>{{$autopre->monto}} bs</label>
    <br>
    <br>
    
    <div class="submit">
    <a href="{{route('verificarpresupuesto',['aceptar', $autopre->id])}}" class="btn btn-primary">Aceptar</a>
    </div>
    <br>
    <div class="submit">
    <a href="{{route('verificarpresupuesto',['rechazar', $autopre->id])}}" class="btn btn-primary">Rechazar</a>
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