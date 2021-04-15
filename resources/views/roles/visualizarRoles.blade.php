<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<!-- codigo importante -->

<h2>visualizar roles</h2>
<br>
<div style="width:600px;">
  <div style="display:flex;justify-content:flex-end;">
    <a href="{{url('roles/create')}}">+Nuevo</a>
  </div>
  <div style="display:flex;justify-content:space-between;width:auto;border-top:1px solid #000;">
    <div>Nombre</div>
    <div>numero de permisos</div>
    <div>Fecha creacion</div>
  </div>
  <div style="display:flex;justify-content:space-between;width:auto;">
    @foreach($roles as $rol)
    <div>{{$rol->nombre_rol}}</div>
    <div>{{$rol->numero_permisos}}</div>
    <div>{{date('d-m-Y', strtotime($rol->created_at))}}</div>
    @endforeach
  </div>
</div>

<!-- fin codigo importante -->

</body>
</html>