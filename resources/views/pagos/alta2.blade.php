@extends('adminlte::page')

@section('title', 'Registro')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registro de asistente') }}</div>
                    <div class="card-body">
                        <form action="{{route('imprimir')}}" target="_blank" method="post">
                            @csrf
                            <input type="hidden" name="ref" value="{{$referencia}}">
                            <input type="hidden" name="persona" value="{{$persona}}">
                            <input type="hidden" name="escuela" value="{{$tec}}">
                            <input type="hidden" name="monto" value="{{$monto}}">
                            <button type="submit" class="btn btn-primary">Imprimir recibo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
