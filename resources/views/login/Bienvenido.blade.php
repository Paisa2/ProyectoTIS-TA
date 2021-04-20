<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de cotizaciones</title>
</head>
<body>
    <h1>BIENVENIDO A SISTEMA DE COTIZACIONES</h1>
    @if(session()->has('nombres'))
<div>{{session('nombres')}}</div>
@endif

</body>
</html>