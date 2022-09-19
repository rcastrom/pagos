@extends('adminlte::page')

@section('title', 'Liberar pago')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Liberar pago') }}</div>
                       <div class="card-body">
                        <form method="post" action="" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="referencia">Número de referencia</label>
                                <input type="text" name="referencia" id="referencia" size="10"
                                       class="form-control" value="{{$id_registro->referencia}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="persona">Persona</label>
                                <input type="text" name="persona" id="persona"
                                       class="form-control" readonly
                                       value="{{$persona->appat.' '.$persona->apmat.' '.$persona->nombre}}">
                            </div>
                            <div class="form-group">
                                <label for="institucion">Institución</label>
                                <input type="text" name="escuela" id="escuela"
                                       class="form-control" readonly
                                       value="{{$institucion->tec}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="ciudad">Ciudad</label>
                                <input type="text" name="ciudad" id="ciudad"
                                       class="form-control" readonly
                                       value="{{$institucion->ciudad}}"
                                >
                            </div>
                            <div class="form-group">
                                <label for="continuar">¿Desea liberar el pago?</label>
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
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

