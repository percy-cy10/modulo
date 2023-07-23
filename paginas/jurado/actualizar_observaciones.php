<?php
    
    include "../Notificaciones/notificaciotesitarevision.php";
    session_start();
    include "../../conexiones/database.php";
    $ids = $_SESSION['id_usuario'];
    $query_actualizacion = "UPDATE jurados SET Realizado = 1 WHERE id = ".$ids; //id dinamico del jurado
    $resultado_actualizacion = mysqli_query($mysqli, $query_actualizacion);
    header("Location: observaciones.php");
    include "../Recordatorio/Recordatoriotesista.php";
?>
