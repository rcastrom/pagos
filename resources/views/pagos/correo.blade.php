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
<h1>¡Bienvenido al Congreso Escala 2022!</h1>
<h4>Hola {{$correo->nombre.' '.$correo->appat.' '.$correo->apmat}}</h4>
<p>Este correo es para informarte que tu pago ha sido registrado, por lo que te esperamos
    del 5 al 7 de octubre del año en curso, en las instalaciones del Instituto Tecnológico de Ensenada.
</p>
<p>Por favor, ten en cuenta lo siguiente:
<ul>
    <li>El Congreso Escala 2022 se llevará a cabo en el gimnasio de usos múltiples del
        polígono sur de las instalaciones del ITE del TECNM.</li>
    <li>¿Interesado en asistir a algún taller? Verifica el siguiente
        enlace <a href="https://forms.gle/cen5MgaKqfvo59hC7">Registro de talleres</a> </li>
    <li>Para cualquier aclaración, se puede solicitar el comprobante del depósito. Es recomendable
    que lo tengas contigo. </li>
</ul>
<div class="container mt-4 justify-content-center">
    <div class="card">
        <div class="card-header">
            <h3>Gafete electrónico</h3>
        </div>
        <div class="card-body">
            <img src="{!!$message->embedData(QrCode::format('png')->size(300)->generate($correo->referencia), 'QrCode.png', 'image/png')!!}">
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
