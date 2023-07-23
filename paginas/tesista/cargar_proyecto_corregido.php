<?php
include "../Notificaciones/notificacionjuradocoreeciondeproyecto.php";
// Verifica si se ha cargado el archivo correctamente
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    // Obtén el nombre original del archivo cargado
    $nombreArchivo = $_FILES['archivo']['name'];

    // Ruta donde deseas guardar los documentos
    $rutaDestino = '../../documentos/'; // Reemplaza 'ruta/donde/guardar/el/archivo/' con la ruta real

    // Combina la ruta destino con el nombre del archivo
    $documento_destino = $rutaDestino . $nombreArchivo;

    // Mueve el archivo temporal a la ubicación deseada
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $documento_destino)) {
        // Realiza la conexión a la base de datos (modifica los parámetros según tu configuración)
        $conexion = mysqli_connect("localhost", "root", "", "pilar");

        if (!$conexion) {
            die("Error al conectar con la base de datos: " . mysqli_connect_error());
        }

        // Obtiene el valor del tesista_id del formulario
        $tesista_id = $_POST['tesista_id'];

        // Prepara la consulta para actualizar el valor de Documento en la tabla proyectotesis
        $query = "UPDATE proyectotesis SET Documento = '$nombreArchivo' WHERE Tesista_Id = '$tesista_id'";

        // Ejecuta la consulta
        if (mysqli_query($conexion, $query)) {
            echo "Documento actualizado correctamente en la base de datos.";
        } else {
            echo "Error al actualizar el documento en la base de datos: " . mysqli_error($conexion);
        }

        // Cierra la conexión a la base de datos
        mysqli_close($conexion);
    } else {
        echo "Hubo un error al cargar el archivo.";
        exit; // Detenemos la ejecución del script si hubo un error al cargar el archivo
    }
} else {
    header("Location: pagina5.php");    
    exit; // Detenemos la ejecución del script si no se cargó ningún archivo
    
}

header("Location: pagina5.1.php");
include "../Recordatorio/Recordatoriojurado.php";

?>
