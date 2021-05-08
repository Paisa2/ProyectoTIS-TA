@extends('base')
@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('main')
@if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif
<div style="width: 90%; margin:24px auto;" class="container-table">
    <h1>Unidades Registradas</h1>
    <div class="d-flex justify-content-end mb-3">
        <a href="{{route('registro.store')}}" class="btn btn-primary">+ Nuevo</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">TIPO DE UNIDAD</th>
                <th scope="col">NOMBRE DE UNIDAD</th>
                <th scope="col">PERTENECE A</th>
                <th scope="col">FECHA DE CREACIÓN</th>
            </tr>
        </thead>
        <tbody>
        @foreach($unidad as $unidadbd)
        <tr>
            <td>{{$unidadbd->tipo_unidad}}</td>
            <td>{{$unidadbd->nombre_unidad}}</td>
            <td>{{$unidadbd->pertenece_a}}</td>
            <td>{{$unidadbd->created_at}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {{--  {!!$unidad->render()!!}  --}}
    </div>
@endsection
{{-- <!DOCTYPE html>
    <script>setTimeout("location.href = '{{ route('roles.index') }}';",1500);</script>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <div class="container-table">
    <h1>unidades registradas</h1>
    <div class="d-flex justify-content-end">
        <a href="/unidades/registro" class="btn btn-primary">+Nuevo</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">TIPO DE UNIDAD</th>
                <th scope="col">NOMBRE DE UNIDAD</th>
                <th scope="col">PERTENECE A</th>
                <th scope="col">FECHA DE REGISTRO</th>
            </tr>
        </thead>
        <tbody>
        @foreach($unidad as $unidadbd)
        <tr>
            <td>{{$unidadbd->tipo_unidad}}</td>
            <td>{{$unidadbd->nombre_unidad}}</td>
            <td>{{$unidadbd->pertenece_a}}</td>
            <td>{{$unidadbd->created_at}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>
</body>
</html> --}}