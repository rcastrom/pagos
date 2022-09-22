@extends('adminlte::page')

@section('title', 'Búsqueda de registro')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buscar registro') }}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="post" action="{{route('busqueda')}}" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="dato">Indique solamente un apellido de la persona por buscar</label>
                                <input type="text" name="dato" id="dato"
                                       class="form-control" required onblur="this.value=this.value.toUpperCase();">
                            </div>
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
