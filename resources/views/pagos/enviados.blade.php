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
                    <div class="card-header">{{ __('Envío de códigos') }}</div>
                    <h2 class="card-title">Se envían únicamente los registros pagados</h2>
                    <div class="card-body">
                        <p>Se enviaron {{$i}} correos electrónicos</p>
                    </div>
                    @if($j>0)
                        <div class="card-body">
                            Los siguientes correos no se pudieron enviar:
                            <ol>
                                @foreach($errores as $error)
                                    <li>$error</li>
                                @endforeach
                            </ol>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop
