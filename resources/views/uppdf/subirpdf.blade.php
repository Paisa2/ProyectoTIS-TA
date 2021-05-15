@extends('base')

@section('title')
Subir PDF
@endsection

@section('head')
<title>Items de Gasto</title>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

@endsection

@section('main')

<div class="container my-4">
@if(session()->has('confirm'))
<div class="alert alert-success" role="alert" id="confirm">
{{session()->get('confirm')}}
</div>
@endif
<form method="POST" action="{{ route('formulario') }}" accept-charset="UTF-8" enctype="multipart/form-data">

            
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <h1 class="display-4">Agregar Documento PDF</h1>
              <div class="col-md-6">
                <input type="file" class="form-control" accept="application/pdf" name="file">
              </div>
            </div>

            <div class="form-group">
            <div style=display:flex;justify-content:center;>
                <button type="submit" class="btn btn-primary">GUARDAR</button>
              </div>
            </div>
          </form>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
@endsection