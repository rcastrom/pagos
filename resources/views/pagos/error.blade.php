@extends('adminlte::page')

@section('title', 'Error')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Error de registro') }}</div>
                    <div class="card-body">
                        La persona no completó el registro, por lo que no hay información completa.
                        Se eliminó la información que se tenía almacenada.
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
