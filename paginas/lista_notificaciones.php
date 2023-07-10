<?php
require_once '../conexiones/database.php';

$query = "SELECT * FROM registro";
$resultado = $mysqli->query($query);

if ($resultado) {
    $numFilas = $resultado->num_rows;

    if ($numFilas > 0) {
        $registros = $resultado->fetch_all(MYSQLI_ASSOC);
    } else {
        $registros = array();
    }

    $resultado->close();
} else {
    echo "Error al ejecutar la consulta: " . $mysqli->error;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lista de Notificaciones</title>
  <link rel="stylesheet" type="text/css" href="/modulo/estilos/estilos_notificaciones.css">
  <script src="/modulo/iterador/estilos_notificaciones.js"></script>
</head>
<body>
  <button onclick="viewPagina()">Cerrar</button>

  <div class="header">
    <h1>Lista de Notificaciones</h1>
  </div>
  
  <div class="content">
    <table>
      <tr>
        <th>Id</th>
        <th>Asunto</th>
        <th>Descripción</th>
        <th>Opciones</th>
      </tr>
      <?php foreach ($registros as $registro): ?>
        <tr>
          <td><?php echo $registro['id']; ?></td>
          <td><?php echo $registro['asunto']; ?></td>
          <td><?php echo $registro['descripcion']; ?></td>
          <td><button onclick="viewDetalle()" data-id="<?php echo $registro['id']; ?>">Ver detalle</button></td>

        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  
  <div class="footer">
    <p>© 2023 Tu Empresa. Todos los derechos reservados.</p>
  </div>
</body>
</html>
