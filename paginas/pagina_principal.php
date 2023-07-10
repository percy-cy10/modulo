<?php
    require_once '../conexiones/database.php';

    $valor = 0;

    $query = "SELECT * FROM registro WHERE visto = ".$valor;
    $resultado = $mysqli->query($query);



    if ($resultado) {
        $numFilas = $resultado->num_rows;

        if ($numFilas > 0) {  
            $cantidadNotificaciones = $numFilas;
        } else {
            $cantidadNotificaciones = 0;
        }

        $resultado->close();
    } else {
        echo "Error al ejecutar la consulta: " . $mysqli->error;
    }
?>

<html>
    <head>
        <title>Pagina Principal</title>
        <link rel="stylesheet" type="text/css" href="/modulo/estilos/estilos_pagina.css">
        <script src="/modulo/iterador/estilos_pagina.js"></script>
    </head>
    <body>
        <div class="header">
            <h1>Bienvenido a la Pagina Principal</h1>
        </div>
        
        <div class="content">
            <p>Aqui encontraras el contenido principal de tu aplicacion.</p>

            <button type="button" onclick="viewNotifications()" class="btn btn-primary">
            Notifications <span class="badge badge-light" style="color:red;"><?php echo $cantidadNotificaciones; ?></span>
            </button>
        </div>
        
        <div class="footer">
            <button onclick="viewlogin()">Cerrar Sesion</button>
        </div>
    </body>
</html>
