@extends('base')
@section('head')
<link rel="stylesheet" href="{{ asset('css/tables.css') }}">
@endsection

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
@endsection

@section('main')
{{-- @if(session('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
    {!! session('confirm') !!}
</div>
<script>setTimeout("document.getElementById('confirm').classList.add('d-none');",3000);</script>
@endif --}}
    <div style="width: 90%; margin:24px auto;" class="container-table">
        <div><h1 class="display-4">Empresas Registradas</h1></div>
        <div class="row g-2">
            <div class="col-md">
            </div>
            <div class="col-md">
            <div class="d-flex justify-content-end mb-3">
              <a href="{{route('empresa.create')}}" class="btn btn-primary">+ Nuevo</a>
            </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">NRO</th>
                    <th scope="col">NOMBRE</th>
                    <th scope="col">RUBRO</th>
                    <th scope="col">REPRESENTANTE LEGAL</th>
                </tr>
            </thead>
        </table>

    </div>    
@endsection