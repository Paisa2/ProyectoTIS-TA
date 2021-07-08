@extends('base')

@section('head')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
<div style="width: 70% " class="container-form">
        <form action="{{route('empresa.update', $empresa->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('post')}}
            <h1 class="display-4">Editar Empresa</h1>
            <div class="row g-3">
                <div class="col-md-12">
                    <label for="" class="form-label">Razón Social:</label>
                    <div class="select-editable" id="business">
                        <div class="dropdown">
                          <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <span class="search"><input type="text" class="form-control" ></span>
                            <span class="options">
                              @foreach($razon as $razonempresa)
                              <span class="dropdown-item" id="{{str_replace(' ', '_', $razonempresa->razon_social)}}">{{$razonempresa->razon_social}}</span>
                              @endforeach
                            </span>
                            <span class="without d-none">Sin resultados</span>
                          </div>
                        </div>
                        <input type="text" name="Empresa" id="Empresa" autocomplete="off" value="{{old('Empresa')?old('Empresa'): $empresa->nombre_empresa}}" class="form-control bg-transparent">
                    </div>
                    @foreach($errors->get('Empresa') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                    
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="Nombre_Comercial" class="form-label">Nombre Comercial:</label>
                    <input type="text" class="form-control" name="Nombre_Comercial" autocomplete="off" value="{{old('Nombre_Comercial')?old('Nombre_Comercial'):$empresa->acronimo_empresa}}">
                    {{-- <input type="text" class="form-control" name="Empresa" id="Empresa"> --}}
                        @foreach($errors->get('Nombre_Comercial') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @endforeach
                </div>
                <div class="col-md-4">
                    <label for="Nit" class="form-label">NIT:</label>
                    <input type="text" name="Nit" class="form-control" autocomplete="off" value="{{old('Nit')?old('Nit'):$empresa->nit_empresa}}">
                    @foreach($errors->get('Nit') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <label for="Rubro" class="form-label">Rubro:</label>
                    <div class="select-editable" id="business">
                        <div class="dropdown">
                          <button class="form-control dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <span class="search"><input type="text" class="form-control" ></span>
                            <span class="options">
                              @foreach($rubro as $rubros)
                              <span class="dropdown-item" id="{{str_replace(' ', '_', $rubros->rubro_empresa)}}">{{$rubros->rubro_empresa}}</span>
                              @endforeach
                            </span>
                            <span class="without d-none">Sin resultados</span>
                          </div>
                        </div>
                        <input type="text" name="Rubro" id="Rubro" autocomplete="off" value="{{old('Rubro')?old('Rubro'):$empresa->rubro_empresa}}" class="form-control bg-transparent">
                    </div>
                    
                    @foreach($errors->get('Rubro') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Representante_Legal" class="form-label">Representante Legal:</label>
                    <input type="text" name="Representante_Legal" class="form-control" autocomplete="off" value="{{old('Representante_Legal')?old('Representante_Legal'):$empresa->representante_legal}}">
                    @foreach($errors->get('Representante_Legal') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="Direccion" class="form-label">Dirección:</label>
                    <input type="text" name="Direccion" class="form-control" autocomplete="off" value="{{old('Direccion')?old('Direccion'):$empresa->direccion_empresa}}">
                    @foreach($errors->get('Direccion') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Correo_Electronico" class="form-label">Correo Electronico:</label>
                    <input type="text" name="Correo_Electronico" id="email" class="form-control" autocomplete="off" value="{{old('Correo_Electronico')?old('Correo_Electronico'):$empresa->email_empresa}}">
                    @foreach($errors->get('Correo_Electronico') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="Telefono" class="form-label">Telefono</label>
                    <input type="text" name="Telefono" class="form-control" autocomplete="off" value="{{old('Telefono')?old('Telefono'):$empresa->telefono_empresa}}">
                    @foreach($errors->get('Telefono') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="registrar">GUARDAR</button>
            </div>
        </form>
    </div>
@endsection