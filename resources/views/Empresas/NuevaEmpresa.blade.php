@extends('base')

@section('head')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
    <div class="container-form">
        <form action="{{route('empresa.store')}}" method="post">
            {{csrf_field()}}
            <h1 class="display-4">Registrar Empresa</h1>
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
                        <input type="text" name="Empresa" id="razon" autocomplete="off" value="{{old('Empresa')}}" class="form-control bg-transparent">
                    </div>
                    @foreach($errors->get('Empresa') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                    {{-- <select name="Empresa" id="Empresa" class="form-control" aria-hidden="true">
                        <option hidden selected value="" id="Empresa">Seleccione</option>
                        @foreach($rubro as $rubros)
                        <option value="{{ $rubros->razon_social }}">{{ $rubros->razon_social }}</option>
                        @endforeach 
                    </select> --}}
                </div>
            </div><br>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="Nombre_Comercial" class="form-label">Nombre Comercial:</label>
                    <input type="text" class="form-control" name="Nombre_Comercial" autocomplete="off" value="{{old('Nombre_Comercial')}}">
                    {{-- <input type="text" class="form-control" name="Empresa" id="Empresa"> --}}
                        @foreach($errors->get('Nombre_Comercial') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @endforeach
                </div>
                <div class="col-md-4">
                    <label for="Nit" class="form-label">NIT:</label>
                    <input type="text" name="Nit" class="form-control" autocomplete="off" value="{{old('Nit')}}">
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
                            <span class="without {{count($rubro) > 0?'d-none':'' }}">Sin resultados</span>
                          </div>
                        </div>
                        <input type="text" name="Rubro" id="Rubro" autocomplete="off" value="{{old('Rubro')}}" class="form-control bg-transparent">
                    </div>
                    {{-- <select name="Rubro" id="Rubro" class="form-control"> 
                        <option hidden selected value="">Seleccione</option>
                        <option {{ old('Rubro') == "Construccion" ? 'selected' : '' }} value="Construccion">Construcción</option>
                        <option {{ old('Rubro') == "Educacion" ? 'selected' : '' }} value="Educacion">Educacion</option>
                        <option {{ old('Rubro') == "Electricidad" ? 'selected' : '' }} value="Electricidad">Electricidad</option>
                        <option {{ old('Rubro') == "Industrial" ? 'selected' : '' }} value="Industrial">Industrial</option>
                        <option {{ old('Rubro') == "Software" ? 'selected' : '' }} value="Software">Software</option>
                        <option {{ old('Rubro') == "Telecomunicaciones" ? 'selected' : '' }} value="Telecomunicaciones">Telecomunicaciones</option>
                        <option {{ old('Rubro') == "Transporte" ? 'selected' : '' }} value="Transporte">Transporte</option>
                    </select> --}}
                    @foreach($errors->get('Rubro') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Representante_Legal" class="form-label">Representante Legal:</label>
                    <input type="text" name="Representante_Legal" class="form-control" autocomplete="off" value="{{old('Representante_Legal')}}">
                    @foreach($errors->get('Representante_Legal') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="Direccion" class="form-label">Dirección:</label>
                    <input type="text" name="Direccion" class="form-control" autocomplete="off" value="{{old('Direccion')}}">
                    @foreach($errors->get('Direccion') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Correo_Electronico" class="form-label">Correo Electronico:</label>
                    <input type="text" name="Correo_Electronico" id="email" class="form-control" autocomplete="off" value="{{old('Correo_Electronico')}}">
                    @foreach($errors->get('Correo_Electronico') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="Telefono" class="form-label">Telefono</label>
                    <input type="text" name="Telefono" class="form-control" autocomplete="off" value="{{old('Telefono')}}">
                    @foreach($errors->get('Telefono') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary" id="registrar">REGISTRAR</button>
            </div>
        </form>
    </div>
@endsection
{{-- @section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script>
        $('#Empresa').editableSelect();
</script>
@endsection --}}
@section('scripts')
<script>

</script>
@endsection