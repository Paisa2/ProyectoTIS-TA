@extends('base')

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
@endsection

@section('main')
    <div class="container my-4">
        <form action="{{route('empresa.store')}}" method="post">
            {{csrf_field()}}
            <h1 class="display-4">Registrar Empresa</h1>
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="Empresa" class="form-label">Empresa</label>
                    <select name="Empresa" id="Empresa" class="form-control">
                        @foreach($rubro as $rubros)
                        <option hidden selected value="">Seleccione</option>
                        <option value="{{ $rubros->razon_social }}">{{ $rubros->razon_social }}</option>
                        @endforeach 
                    </select>
                        @foreach($errors->get('Empresa') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                        @endforeach
                </div>
                <div class="col-md-4">
                    <label for="Nit" class="form-label">Nit</label>
                    <input type="text" name="Nit" class="form-control" autocomplete="off" value="{{old('Nit')}}">
                    @foreach($errors->get('Nit') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-4">
                    <label for="Rubro" class="form-label">Rubro</label>
                    <select name="Rubro" id="rubro" class="form-control"> 
                        <option hidden selected value="">Seleccione</option>
                        <option value="Construccion">Construcción</option>
                        <option value="Educacion">Educacion</option>
                        <option value="Electricidad">Electricidad</option>
                        <option value="Industrial">Industrial</option>
                        <option value="Software">Software</option>
                        <option value="Telecomunicaciones">Telecomunicaciones</option>
                        <option value="Transporte">Transporte</option>
                    </select>
                    @foreach($errors->get('Rubro') as $message)
                    <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Representante_Legal" class="form-label">Representante Legal</label>
                    <input type="text" name="Representante_Legal" class="form-control" autocomplete="off" value="{{old('Representante_Legal')}}">
                    @foreach($errors->get('Representante_Legal') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
                <div class="col-md-6">
                    <label for="Direccion" class="form-label">Dirección</label>
                    <input type="text" name="Direccion" class="form-control" autocomplete="off" value="{{old('Direccion')}}">
                    @foreach($errors->get('Direccion') as $message)
                        <div class="alert alert-danger" role="alert">{{$message}}</div>
                    @endforeach
                </div>
            </div><br>

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="Correo_Electronico" class="form-label">Correo Electronico</label>
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
@section('scripts')
<script src="//code.jquery.com/jquery-1.12.4.min.js"></script>
<script>
        $('#Empresa').editableSelect();
</script>
@endsection