<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
<h1>Bienvenido a Congreso Escala 2022</h1>
<h4>Hola {{$correo->nombre.' '.$correo->appat}}</h4>
<p>El correo enviado es para informarte que tu pago ha sido registrado, por lo que te esperamos
    del 5 al 7 de octubre del año 2022 en las instalaciones del Instituto Tecnológico de Ensenada.
</p>
<p>Por favor, ten en cuenta lo siguiente:
<ul>
    <li>Todo el Congreso Escala se llevará a cabo en el polígono sur de las instalaciones del ITE.</li>
    <li>El registro se realizará el martes 4 de octubre del 2022 en el Gimnasio, en donde se te entregará tu
        comprobante del depósito (boleto).</li>
    <li>Para cualquier posible aclaración, trae contigo el comprobante del depósito</li>
</ul>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Gafete electrónico</h3>
        </div>
        <div class="card-body">
            {!! QrCode::size(300)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-9') !!}
        </div>
    </div>
</div>
<p>
    <strong>Este correo fué realizado mediante un sistema automatizado, por lo que se te pide <u>NO
            responder al remitente, YA QUE NINGUNA PERSONA ESTARÁ AL PENDIENTE DE ESTA DIRECCIÓN DE CORREO</u>
    </strong>
</p>
</body>
</html>
