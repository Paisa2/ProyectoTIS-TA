@extends('base')

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
    <div class="container my-4">
        <form action="">
            {{csrf_field()}}
            <h1>Registrar Empresa</h1>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="empresa" class="form-label">Empresa</label>
                    <input list="browsers" name="browser" class="form-control" autocomplete="off">
                    <datalist id="browsers">
                        <option value="Internet Explorer">
                        <option value="Firefox">
                        <option value="Chrome">
                        <option value="Opera">
                        <option value="Safari">
                    </datalist>
                    {{-- <select onchange="this.nextElementSibling.value=this.value" class="form-control">
                        <option value=""></option>
                        <option value="115x175 mm">115x175 mm</option>
                        <option value="120x160 mm">120x160 mm</option>
                        <option value="120x287 mm">120x287 mm</option>
                      </select> --}}
                </div>
                <div class="col-md-4">
                    <label for="nit" class="form-label">Nit</label>
                    <input type="text" name="nit" class="form-control" autocomplete="off" value="{{old('nit')}}">
                </div>
                <div class="col-md-4">
                    <label for="rubro" class="form-label">Rubro</label>
                    <select name="rubro" id="rubro" class="form-control"> 
                        <option value=""></option>
                        <option value="115x175 mm">115x175 mm</option>
                        <option value="120x160 mm">120x160 mm</option>
                        <option value="120x287 mm">120x287 mm</option>
                    </select>
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="representante_legal" class="form-label">Representante Legal</label>
                    <input type="text" name="representante_legal" class="form-control" autocomplete="off" value="{{old('representante_legal')}}">
                </div>
                <div class="col-md-6">
                    <label for="direccion" class="form-label">Dirección</label>
                    <input type="text" name="direccion" class="form-control" autocomplete="off" value="{{old('direccion')}}">
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo Electronico</label>
                    <input type="email" name="email" id="email" class="form-control" autocomplete="off" value="{{old('email')}}">
                </div>
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Telefono</label>
                    <input type="text" name="telefono" class="form-control" autocomplete="off" value="{{old('telefono')}}">
                </div>
            </div><br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="registrar">Registrar</button>
            </div>
        </form>
    </div>
@endsection