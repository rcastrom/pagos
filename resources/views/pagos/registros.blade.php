@extends('adminlte::page')

@section('title', 'Registros')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
@endsection


@section('content_header')
    <h1>Congreso Escala </h1>
@stop

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registros') }}</div>

                    <div class="card-body">
                        <table id="registros1" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Institución</th>
                                <th>Registros pagados</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $suma = 0; ?>
                            @foreach($registros_pagados as $registro)
                                <tr>
                                    <td>{{$registro->tec}}</td>
                                    <td>{{$registro->registrados}}</td>
                                        <?php $suma+=$registro->registrados; ?>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$suma}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table id="registros2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Institución</th>
                                <th>Registros sin pago</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $suma = 0; ?>
                            @foreach($registros_sin_pagar as $registro)
                                <tr>
                                    <td>{{$registro->tec}}</td>
                                    <td>{{$registro->registrados}}</td>
                                        <?php $suma+=$registro->registrados; ?>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Total</th>
                                <th>{{$suma}}</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $("#registros1").DataTable({
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#registros2").DataTable({
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    </script>

@endsection
