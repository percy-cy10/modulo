
<?php

    $id = $_GET['id'];

    include '../conexiones/database.php';

    $datos = "SELECT * FROM registro WHERE id = ".$id;
    $resultado = $mysqli->query($datos);


    if ($resultado) {

        $registro = $resultado->fetch_assoc();
        $id = $registro['id'];
        $asunto = $registro['asunto'];
        $descripcion = $registro['descripcion'];
    } else {
        echo "No se encontró el registro con el ID: " . $id;
    }

    $resultado->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/modulo/iterador/estilos_detalle.js"></script>
    <title>Document</title>
</head>
<body>
    <p> esto es <b><?php echo $asunto; ?></b> que tiene por detalle <b><?php echo $descripcion; ?></b></p>

    <button onclick="viewNotificaciones()">Notificaciones</button>
</body>
</html>