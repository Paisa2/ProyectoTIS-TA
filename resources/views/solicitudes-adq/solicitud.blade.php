@extends('base')

@section('head')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="{{ asset('css/forms.css') }}">
<link rel="stylesheet" href="{{ asset('css/solicitarAdq.css') }}">
@endsection

@section('main')
    <div class="container my-4">
    <form action="{{route('solicitud.store')}}" method="post">
        {{csrf_field()}}
        <div class="col-md-12">
            <h1 class="display-4">Solicitar Adquisicion</h1>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="tipo" class="form-label">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="compra">Compra</option>
                    <option value="alquiler">Alquiler</option>
                </select><br>
                @foreach($errors->get('tipo') as $message)
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endforeach
            </div>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha de entrega</label>
                <input type="date" name="fecha" id="" value="{{old('fecha')}}" class="form-control" min=<?php $fecha=date("Y-m-d"); echo date("Y-m-d", strtotime($fecha."+ 3 days"));?>>
                @foreach($errors->get('fecha') as $message)
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="mb-3 col-12">
                <label for="justificacion" class="form-label">Justificacion</label>
                <textarea name="justificacion" id="justificacion" class="form-control" cols="30" rows="0" style="resize: none">{{old('justificacion')}}</textarea>
                @foreach($errors->get('justificacion') as $message)
                <div class="alert alert-danger" role="alert">{{$message}}</div>
                @endforeach
            </div>
        </div>
        <input class="d-none" type="text" name="detalle" id="detalle">
        <div class="row">
            <div class="col-md-12" id="tabla-compra">
               
                <table class="tabla-compra" id="compra">
                    <thead>
                      <tr>
                        <th class="c-1">Item</th>
                        <th class="c-2">Cantidad</th>
                        <th class="c-2">Unidad</th>
                        <th class="c-2">Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                    @for($i=0; $i<10; $i++)
                      <tr>
                        <td class="articulo">
                          <select name="detalle[articulo][a{{$i}}]">
                            <option hidden selected value="">Seleccione</option>
                            @foreach($adquisicion as $solicitudes)
                                <option value="{{ $solicitudes->nombre_item }}">{{ $solicitudes->nombre_item }}</option>
                             @endforeach
                          </select>
                        </td>
                        <td><input type="number" min="1" name="detalle[cantidad][c{{$i}}]"></td>
                        <td><input type="number" min="1" name="detalle[unidad][u{{$i}}]"></td>
                        <td><input type="number" min="1" name="detalle[precio][p{{$i}}]"></td>
                      </tr>
                      @endfor
                      <tr>
                        <td colspan="3">TOTAL</td>
                        <td><input type="number" min="1" name="total" ></td>
                      </tr>
                    </tbody>
                  </table>
                  
                  <table class="tabla-alquiler" id="alquiler">
                    <thead>
                      <tr>
                        <th class="c-1">Servicio</th>
                        <th class="c-2">Duracion</th>
                        <th class="c-2">Periodo</th>
                        <th class="c-2">Precio</th>
                      </tr>
                    </thead>
                    <tbody>
                        @for($i=0; $i<10; $i++)
                      <tr>
                        <td class="articulo"><input type="text" name="detalle[articulo][a{{$i}}]"></td>
                        <td><input type="number" min="1" name="detalle[cantidad][c{{$i}}]"></td>
                        <td>
                            <select name="detalle[unidad][u{{$i}}]">
                            <option hidden selected value="">Seleccione</option>
                              <option value="Horas">Horas</option>
                              <option value="Dias">Dias</option>
                              <option value="Meses">Meses</option>
                              <option value="Años">Años</option>
                            </select>
                          </td>
                        <td><input type="number" min="1" name="detalle[precio][p{{$i}}]"></td>
                      </tr>
                      @endfor
                      <tr>
                        <td colspan="3">TOTAL</td>
                        <td><input type="number" min="1" name="total"></td>
                      </tr>
                    </tbody>
                  </table>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary" id="enviar">Registrar</button>
        </div>
        {{-- <div class="d-flex justify">
            <button type="submit" class="btn btn-primary" id="enviar">Registrar y Enviar</button>
        </div> --}}
    </form>
</div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>´
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#alquiler").hide();
        $('#compra input,#compra select').prop('disabled', false);
        $('#alquiler input,#alquiler select').prop('disabled', true);
        $("#tipo").change(function(){
            var selector = $("#tipo").val();
            console.log(selector);
        
        if(selector == "alquiler"){
            $('#alquiler').show();
            $('#compra').hide();
            $('#compra input,#compra select').prop('disabled', true);
            $('#alquiler input,#alquiler select').prop('disabled', false);
        }
        else{
            $('#alquiler').hide();
            $('#compra').show();
            $('#compra input,#compra select').prop('disabled', false);
            $('#alquiler input,#alquiler select').prop('disabled', true);
        }
        });

    });
    
  </script>
@endsection