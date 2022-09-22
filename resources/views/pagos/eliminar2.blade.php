@extends('adminlte::page')

@section('title', 'Eliminar registro')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Eliminar registro') }}</div>
                    <div class="card-body">
                        <form method="post" action="{{route('borrar')}}" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="ref">Número de referencia</label>
                                <input type="text" name="ref" id="ref" size="10"
                                       class="form-control" value="{{$persona[0]->referencia}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="persona">Persona</label>
                                <input type="text" name="persona" id="persona"
                                       class="form-control" readonly
                                       value="{{$persona[0]->appat.' '.$persona[0]->apmat.' '.$persona[0]->nombre}}">
                            </div>
                            <div class="form-group">
                                <label for="escuela">Institución</label>
                                <input type="text" name="escuela" id="escuela"
                                       class="form-control" readonly
                                       value="{{$persona[0]->tec}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo</label>
                                <input type="email" name="correo" id="correo"
                                       class="form-control" readonly
                                       value="{{$persona[0]->correo}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad"
                                       class="form-control" readonly
                                       value="{{$persona[0]->ciudad}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="continuar">¿Desea eliminar el registro?</label>
                                <div class="form-check">
                                    <input type="radio" name="continuar" id="continuar1"
                                           class="form-check-input" value="1">
                                    <label for="continuar1" class="form-check-label">Sí</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="continuar" id="continuar2"
                                           class="form-check-input" value="0">
                                    <label for="continuar2" class="form-check-label">No</label>
                                </div>
                            </div>
                            <input type="hidden" name="referencia" value="{{base64_encode($persona[0]->referencia)}}">
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


