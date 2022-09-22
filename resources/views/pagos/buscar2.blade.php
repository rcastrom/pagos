@extends('adminlte::page')

@section('title', 'Búsqueda de registro')

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
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Buscar registro') }}</div>
                    <div class="card-body">
                        <table id="registros" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Persona</th>
                                <th>Tecnológico</th>
                                <th>Eliminar registro</th>
                                <th>Validar pago</th>
                                <th>Reimprimir pago</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($personas as $registro)
                                <tr>
                                    <td>{{$registro->appat.' '.$registro->apmat.' '.$registro->nombre}}</td>
                                    <td>{{$registro->tec}}</td>
                                    <td>
                                        <a href="/home/eliminar/{{base64_encode($registro->id)}}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/home/validar/{{base64_encode($registro->id)}}">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="/home/imprimir/{{base64_encode($registro->id)}}">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </a>
                                    </td>
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

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $("#registros").DataTable({
            "responsive": true,
            "lengthChange": false,
            "paging": true,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    </script>

@endsection
