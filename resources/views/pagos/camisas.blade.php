@extends('adminlte::page')

@section('title', 'Camisetas')

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
                    <div class="card-header">{{ __('Camisetas') }}</div>
                    <h2 class="card-title">Se indican únicamente los registros pagados</h2>
                    <div class="card-body">

                        <p class="lead">Ensenada</p>
                        <table id="ensenada" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ensenadas as $ensenada)
                                <tr>
                                    <td>{{$ensenada->talla}}</td>
                                    <td>{{$ensenada->cantidad}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <p class="lead">Mexicali</p>
                        <table id="mexicali" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($mexicalis as $mexicali)
                                <tr>
                                    <td>{{$mexicali->talla}}</td>
                                    <td>{{$mexicali->cantidad}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <p class="lead">Tijuana</p>
                        <table id="tijuana" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tijuanas as $tijuana)
                                <tr>
                                    <td>{{$tijuana->talla}}</td>
                                    <td>{{$tijuana->cantidad}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <p class="lead">Mulege</p>
                        <table id="mulege" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($muleges as $mulege)
                                <tr>
                                    <td>{{$mulege->talla}}</td>
                                    <td>{{$mulege->cantidad}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <p class="lead">Otras ciudades</p>
                        <table id="otros" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Talla</th>
                                <th>Cantidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($otros as $otro)
                                <tr>
                                    <td>{{$otro->talla}}</td>
                                    <td>{{$otro->cantidad}}</td>
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
        $("#ensenada").DataTable({
            "responsive": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#mexicali").DataTable({
            "responsive": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#tijuana").DataTable({
            "responsive": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#mulege").DataTable({
            "responsive": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
        $("#otros").DataTable({
            "responsive": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    </script>

@endsection
