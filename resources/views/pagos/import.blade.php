@extends('adminlte::page')

@section('title', 'Importar pagos')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Importar pagos') }}</div>
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
                            @if(isset($numRows))
                                <div class="alert alert-sucess">
                                    Se importaron {{$numRows}} registros.
                                </div>
                            @endif

                            <form action="{{route('pagos.import')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-6">
                                        <div class="custom-file">
                                            <label class="custom-file-label" for="pagos">Seleccionar archivo</label>
                                            <input type="file" name="pagos" class="custom-file-input" id="pagos">
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">Importar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
