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
                    <div class="card-header">{{ __('Pago liberado') }}</div>
                    <div class="card-body">
                        <p>Se liberó el pago correspondiente.</p>
                    </div>
                    @if($hecho)
                        <p>Se le envió un correo electrónico a la persona con su gafete electrónico</p>
                    @else
                        <p>Sin embargo, el sistema marcó como correo inexistente o tuvo
                        un problema con su envío. Debe verificar a nivel base de datos.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop

