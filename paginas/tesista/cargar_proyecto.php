<?php
var_dump($_POST);
if (isset($_POST['submit'])) {
    // Realiza la conexión a la base de datos (modifica los parámetros según tu configuración)
    $conexion = mysqli_connect("localhost", "root", "", "pilar");

    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }

    // Obtén los valores enviados desde el formulario
    $codigo = $_POST['linea'];
    $documento = $_FILES['archivo']['name'];
    $titulo = $_POST['titulo'];
    $estado = null; // Se establecerá como nulo, ya que lo queremos almacenar como campo nulo en la tabla proyectotesis
    $tesista_id = 1; // Establecemos el ID del tesista directamente como 1
    $especialidad_id = $_POST['especialidad_id']; // Obtén el valor del ID de la especialidad seleccionada

    
    // Realiza la conexión a la base de datos (modifica los parámetros según tu configuración)
    $conexion = mysqli_connect("localhost", "root", "", "pilar");
    
    if (!$conexion) {
        die("Error al conectar con la base de datos: " . mysqli_connect_error());
    }
    
    // Consulta para obtener los IDs de los jurados de la especialidad seleccionada
    $consulta_jurados_especialidad = "SELECT id FROM jurados WHERE Especialidad_Id = $especialidad_id";
    $resultado_jurados_especialidad = mysqli_query($conexion, $consulta_jurados_especialidad);
    
    // Verifica si se encontraron jurados de la especialidad seleccionada
    if (mysqli_num_rows($resultado_jurados_especialidad) < 3) {
        echo "No hay suficientes jurados registrados para la especialidad seleccionada.";
        exit; // Detenemos la ejecución del script si no hay suficientes jurados registrados
    }
    
    // Guarda los IDs de los jurados de la especialidad seleccionada en un arreglo
    $jurados_especialidad = array();
    while ($fila_jurado = mysqli_fetch_assoc($resultado_jurados_especialidad)) {
        $jurados_especialidad[] = $fila_jurado['id'];
    }
    
    $cant = mysqli_num_rows($resultado_jurados_especialidad);
    // Realiza el sorteo para seleccionar aleatoriamente a tres jurados de la especialidad
    shuffle($jurados_especialidad);
    $Jurado1 = $jurados_especialidad[0];
    $Jurado2 = $jurados_especialidad[1];
    $Jurado3 = $jurados_especialidad[2];

// Verifica si se ha cargado el archivo correctamente
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    $documento_nombre = $_FILES['archivo']['name']; // Nombre original del archivo cargado
    $documento_temp = $_FILES['archivo']['tmp_name']; // Nombre temporal del archivo cargado

    // Ruta donde deseas guardar los documentos
    $rutaDestino = '../../documentos/'; // Reemplaza 'ruta/donde/guardar/el/archivo/' con la ruta real

    // Combina la ruta destino con el nombre del archivo
    $documento_destino = $rutaDestino . $documento_nombre;

    // Mueve el archivo temporal a la ubicación deseada
    if (move_uploaded_file($documento_temp, $documento_destino)) {
        echo "El archivo se ha cargado correctamente y se ha guardado en la carpeta documentos.";
    } else {
        echo "Hubo un error al cargar el archivo.";
        exit; // Detenemos la ejecución del script si hubo un error al cargar el archivo
    }
} else {
    echo "No se ha cargado ningún archivo.";
    exit; // Detenemos la ejecución del script si no se cargó ningún archivo
}

// Realiza la conexión a la base de datos (modifica los parámetros según tu configuración)
$conexion = mysqli_connect("localhost", "root", "", "pilar");

if (!$conexion) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Prepara la consulta para insertar los datos en la tabla proyectotesis
$query = "INSERT INTO proyectotesis (Codigo, Documento, Titulo, Estado, Tesista_Id, Especialidad_Id, Jurado_1, Jurado_2, Jurado_3) VALUES ('$codigo', '$documento', '$titulo', '$estado', '$tesista_id', '$especialidad_id', '$Jurado1', '$Jurado2', '$Jurado3')";


// Ejecuta la consulta
if (mysqli_query($conexion, $query)) {
    echo "Proyecto de tesis registrado exitosamente.";

    // Redirecciona a otro archivo PHP después de unos segundos (por ejemplo, 5 segundos)

} else {
    echo "Error al registrar el proyecto de tesis: " . mysqli_error($conexion);
}

// Cierra la conexión a la base de datos
mysqli_close($conexion);

header("Location: pagina2.php");
include "../Notificaciones/notificacionjuradosubidadeproyecto.php";
}
?>
