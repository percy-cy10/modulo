
    
<html>
    <head>
        <title>PILAR-Modulo</title>
        <link rel="stylesheet" href="../../estilos/styles.css">

        <style>
.container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 630px;
}

/* Estilos para el contenedor del formulario */
.form-container {
  background-color:rgba(228, 244, 134, 0.4); /* Color celeste */
  padding: 10px;
  border-radius: 10px;
  width: 600px; /* Ancho del contenedor del formulario */
  display: flex;
  flex-direction: column; /* Apilar los elementos verticalmente */
  align-items: center; /* Centrar elementos horizontalmente */

}

/* Estilos para las etiquetas (labels) */
.section-text-inp {
  display: block;
  font-weight: bold;
  margin-bottom: -1px;
}

/* Estilos para los campos de entrada (inputs) y selects */
.label-inp,
.label-inp[type="text"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

/* Estilos para el botón de submit */
input[type="submit"] {
  background-color: #05236d; 
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  width: 100%;
}

/* Estilos para el botón de submit al pasar el mouse */
input[type="submit"]:hover {
  background-color: #0056b3; /* Color azul más oscuro al pasar el mouse */
}

/* Estilos para el contenedor del botón de submit */
.submit-btn-container {
  margin-top: 40px; /* Espacio entre el formulario y el botón */
  width: 100%;
  display: flex;
  justify-content: center;
  margin-left: 25px;
}

.upload-button0 {
    padding: 10px 20px;
    color: #5b0f0f;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-left: 70px;
    
}
        </style>
    </head>
<body>
  <nav class="navbar">
    <div class="navbar-left">
      <img src="../../public/pilar-icon184-1@2x.png" alt="Icono" class="navbar-icon1">
      <span class="navbar-text">TESISTA PILAR</span>
    </div>
    <div class="navbar-right">
      <span class="navbar-text2">Reynaldo Muñoz Rodríguez</span>
      <img src="../../public/icon-notificaion188-1@2x.png" alt="Icono 1" class="navbar-icon">
      <img src="../../public/icon-notificacion189-1@2x.png" alt="Icono 2" class="navbar-icon">
      <img src="../../public/icon-salir191-1@2x.png" alt="Icono 3" class="navbar-icon">
    </div>
  </nav>
  <div class="container">
  <div class="form-container">
  <div class="section-btn-subir ">
    <form action="cargar_proyecto.php" method="post" enctype="multipart/form-data">
                        <?php
                    // Realizar la conexión a la base de datos (modifica los parámetros según tu configuración)
                    $conexion = mysqli_connect("localhost", "root", "", "pilar");

                    if (!$conexion) {
                        die("Error al conectar con la base de datos: " . mysqli_connect_error());
                    }

                    // Consultar los datos del tesista con ID igual a 1
                    $query = "SELECT Codigo, Nombres, ApellidoPaterno, ApellidoMaterno FROM tesista WHERE id = 1";
                    $resultado = mysqli_query($conexion, $query);

                    if ($fila = mysqli_fetch_assoc($resultado)) {
                        // Obtener los datos del tesista
                        $codigo_tesista = $fila["Codigo"];
                        $nombre_tesista = $fila["Nombres"];
                        $apellido_paterno = $fila["ApellidoPaterno"];
                        $apellido_materno = $fila["ApellidoMaterno"];
                    }

                    // Cierra la conexión a la base de datos
                    mysqli_close($conexion);
                    ?>

        <label class="section-text-inp" for="nombre">Código:</label>
        <input class="label-inp" type="text" id="linea" name="linea" value="<?php echo $codigo_tesista; ?>" readonly>

        <label class="section-text-inp" for="tesista_id">Tesista:</label>
        <input class="label-inp" type="text" id="tesista_id" name="tesista_id" value="<?php echo $nombre_tesista . ' ' . $apellido_paterno . ' ' . $apellido_materno; ?>" readonly>

        
        <label class="section-text-inp" for="especialidad_id">Especialidad:</label>
        <select id="especialidad_id" name="especialidad_id" class="label-inp">

                    <?php
                // Realiza la conexión a la base de datos (modifica los parámetros según tu configuración)
                $conexion = mysqli_connect("localhost", "root", "", "pilar");

                if (!$conexion) {
                    die("Error al conectar con la base de datos: " . mysqli_connect_error());
                }

                // Consulta los nombres y IDs desde la tabla Especialidad
                $query = "SELECT id, Nombres FROM especialidad";
                $resultado = mysqli_query($conexion, $query);

                // Genera opciones a partir de los nombres y IDs obtenidos
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    $id_especialidad = $fila["id"];
                    $nombre_especialidad = $fila["Nombres"];
                    echo '<option value="' . $id_especialidad . '">' . $nombre_especialidad . '</option>';
                }

                // Cierra la conexión a la base de datos
                mysqli_close($conexion);
                ?>
        </select>

        <label class="section-text-inp" for="nombre">Titulo:</label>
        <input class="label-inp" type="text" id="nombre" name="titulo" required>

        <label class="section-text-inp" for="nombre">Seleccion archivo:</label>
        <input class="upload-button0" type="file" id="file-input" name="archivo" required />
        
        <div class="submit-btn-container">
      
        <input type="submit" value="Registrar Proyecto de Tesis" name="submit" class="submit-btn" />
        </div>
    </form>
    
</div>
</div>
              </div>
              </div>
  
<footer class="footer">
    <p>Universidad Nacional del Altiplano Vicerrectorado de Investigación Dirección General de Investigación © Plataforma de Investigación y Desarrollo &copy; </p>
  </footer>
</body>
</html>