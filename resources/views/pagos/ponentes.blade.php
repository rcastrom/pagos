@extends('adminlte::page')

@section('title', 'Ponentes')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Listado de ponentes') }}</div>
                    <div class="card-body">
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Institución</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ponentes as $ponente)
                                    <tr>
                                        <td>{{$ponente->appat.' '.$ponente->apmat.' '.$ponente->nombre}}</td>
                                        @php
                                            $tecnologico=\App\Models\Escuela::where('id',$ponente->tec)->first();
                                        @endphp
                                        <td>{{$tecnologico->tec}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
