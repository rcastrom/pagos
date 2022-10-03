@extends('adminlte::page')

@section('title', 'Listado de personas')

@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Listado de personas pagadas') }}</div>
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
                        <form method="post" action="{{route('listado_pdf')}}" role="form" target="_blank">
                            @csrf
                            <div class="form-group">
                                <label for="tec">Señale la institución a la que se le imprimirá el
                                listado de estudiantes pagados</label>
                                <select name="tec" id="tec" required class="form-control">
                                    <option value="" selected>--Seleccione--</option>
                                    @foreach($ciudades as $ciudad)
                                        <option value="{{$ciudad->id}}">{{$ciudad->tec}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <p>Indique el tipo de impresión</p>
                                <div class="form-check">
                                    <label class="form-check-label">
                                    <input type="radio" name="consulta" class="form-check-input" value="1" checked> Solo
                                        pagados
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label for="consulta" class="form-check-label">
                                    <input type="radio" name="consulta" class="form-check-input" value="2"> Pagados y
                                        no pagados
                                    </label>
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
