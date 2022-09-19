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
                          @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                        <form method="post" action="{{route('liberar')}}" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="referencia">Número de referencia</label>
                                <input type="text" name="referencia" id="referencia" size="10"
                                       class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Continuar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
