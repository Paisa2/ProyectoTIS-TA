@extends('base')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <link rel="shortcut icon" href="favicon.ico">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('css/Bienvenido.css') }}">
    <title>Sistema de cotizaciones</title>
</head>
<body>
@section('usuario')
@if(session()->has('nombres'))
{{session('nombres')}}
@endif
@endsection

 @section('main')
    <div class="navar">
 <h1 >BIENVENIDO</h1>
 
  <p class="parrafo">
    
     
     A Cotysoft la herramienta de apoyo <br>
     para procesos de cotización,  donde <br>
     podrás dar seguimiento a solicitudes <br>
     de adquisiciones de tu institución</p>
 
   </div>
 

@endsection

</body>
</html>