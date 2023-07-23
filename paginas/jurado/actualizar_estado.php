<?php

    include "../../conexiones/database.php";

    $registroID = $_POST['registro_id'];
    include "../Notificaciones/notificaciontesistadictamen.php";
    $query_actualizacion = "UPDATE proyectotesis SET Estado = 1 WHERE id = ".$registroID;

    $resultado_actualizacion = mysqli_query($mysqli, $query_actualizacion);

    header("Location: observaciones.php");
    include "../Recordatorio/Recordatoriotesista.php";
?>
