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
                            <div class="form-group">
                                <label for="referencia">Número de referencia</label>
                                <input type="text" name="referencia" id="referencia" size="10"
                                       class="form-control" required>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
