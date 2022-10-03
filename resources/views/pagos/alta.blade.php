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
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        Los campos marcados con (*) son obligatorios
                        <form method="post" action="{{route('pagos.alta')}}" role="form">
                            @csrf
                            <div class="form-group">
                                <label for="appat">(*) Primer apellido</label>
                                <input type="text" name="appat" id="appat" required
                                       onchange="this.value=this.value.toUpperCase();" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="apmat">Segundo apellido</label>
                                <input type="text" name="apmat" id="apmat"
                                       onchange="this.value=this.value.toUpperCase();" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="nombre">(*) Nombre(s)</label>
                                <input type="text" name="nombre" id="nombre" required
                                       onchange="this.value=this.value.toUpperCase();" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="tec">(*) Institución de procedencia</label>
                                <select name="tec" id="tec" class="form-control" required>
                                    <option value="" selected>--Seleccione--</option>
                                    @foreach($escuelas as $tecs)
                                        <option value="{{$tecs->id}}">{{$tecs->tec}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="correo">(*) Correo electrónico</label>
                                <input type="email" name="correo" id="correo" required
                                       onchange="this.value=this.value.toLowerCase();" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="camisa">(*) Camisa</label>
                                <select name="camisa" id="camisa" class="form-control" required>
                                    <option value="" selected>--Indique--</option>
                                    @foreach($camisetas as $camisa)
                                        <option value="{{$camisa->id}}">{{$camisa->talla}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                (*) Asistencia como:
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="status" id="status" value="1" checked
                                               class="form-check-input">Estudiante
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="status" id="status" value="2"
                                               class="form-check-input">Docente - Ponente
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="status" id="status" value="3"
                                               class="form-check-input">Estudiante - Ponente
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="status" id="status" value="4"
                                               class="form-check-input">Docente
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="control">En caso de ser estudiante, indique el número de control</label>
                                <input type="text" name="control" id="control" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="monto">Monto a pagar</label>
                                <input type="number" name="monto" id="monto" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label >(*) Indique la acción a realizar</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="accion" id="accion" value="1"
                                               class="form-check-input" checked>Validar pago
                                    </label>
                                </div>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="accion" id="accion" value="2"
                                               class="form-check-input">Solo generar recibo pero sin validar pago
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
