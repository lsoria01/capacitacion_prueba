<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperación de contraseña</title>
</head>
<body>


<div class="container">
    <img src="{{asset('img/logo-email.png')}}" width="400"  height="50">
    <br><br><br><br>
    <h3>Estimado(a) {{ $nombreCompleto }}:</h3> 

    <p> Dando respuesta a su petición, le recordamos los datos para ingresar a su cuenta.</p>
    <strong> CURP:</strong> {{ $usuario }} <br>
    <strong> Contraseña:</strong> {{ $indicio }}
    <br> <br>
    <p> URL: {{ $ruta }}</p>
    <p> Atentamente: Expediente Electrónico de Capacitación </p>
    <p> Aviso: Este mensaje es sólo informativo, no es necesario responder al mismo.</p>
</div>

<!-- <div class="container">
    <img src="{{asset('img/encabezado.png')}}" class="logo-gobmx">
    <br><br><br><br>
    <h3>Estimado(a) Luis de Jesús Soria Zavala:</h3> 

    <p>Deseando sinceramente se encuentre bien usted y su apreciable familia, se le hace el atento recordatorio de acudir a las oficinas del Indautor el Sábado 28 de agosto del presente año a las 12hrs, con el fin de dar seguimiento y conclusión al proyecto de Digitalización de Dictaminaciones Jurídicas</p>
    <p>Esperando contar con su asistencia, el Indautor le manda un cordial saludo.</p>
    <p> Aviso: Este mensaje es sólo informativo, no es necesario responder al mismo.</p>
    <p>https://www.indautor.gob.mx/</p>

</div> -->
</body>
</html>