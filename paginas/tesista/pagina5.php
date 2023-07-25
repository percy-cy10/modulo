<?php
    session_start();
    include "../../conexiones/database.php";

    $id = $_SESSION['id_usuario'];

    $query = "SELECT * FROM tesista WHERE id = ".$id;
    $resultado = mysqli_query($mysqli, $query);

    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $Nombres = $fila['Nombres'];
            $appP = $fila['ApellidoPaterno'];
            $appM = $fila['Apellidomaterno'];
        }
    }

    $not = "SELECT * FROM notificaciontesista WHERE Tesista_Id = ".$id." AND leido = 0";
    $resultadon = mysqli_query($mysqli, $not);

    $cant = mysqli_num_rows($resultadon); 
    

?>

<html>
    <head>
        <title>PILAR-Modulo</title>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../../estilos/styles.css">
        <link rel="stylesheet" href="../../estilos/estilos_notific.css">
        <link rel="stylesheet" href="../../estilos/estilos2.css">    
    </head>
    <style>
        .section1 {
    flex-basis: 100%;
    padding: 10px;
    background-color: rgba(228, 244, 134, 0.4);
    margin-bottom: 20px;
    border-radius: 10px;
  }
    </style>
<body>
  <nav class="navbar">
    <div class="navbar-left">
      <img src="../../public/pilar-icon184-1@2x.png" alt="Icono" class="navbar-icon1">
      <span class="navbar-text">TESISTA PILAR</span>
    </div>
    <div class="navbar-right">
      <span class="navbar-text2"><?php echo "$Nombres $appP $appM"; ?></span>
      <i class="fa fa-user fa-2x icon" class="navbar-icon"></i> 
                    <a href="#" data-toggle="modal"  data-target="#notificaciones" class="notification">
                        <i class="fa fa-bell fa-2x " class="navbar-icon"></i>
                        <?php

                            if ($cant != 0){
                        ?>
                                <span class="badge"><?php echo $cant; ?></span> 
                        <?php
                            }
                        ?>
                        
                    </a>
      <a href="../../cerrar_sesion.php"><i class="fa fa-sign-out fa-2x icon"></i></a>
    </div>
  </nav>

  
  <div class="content">
    <div class="left-column">
        <div class="section1 ">
        <div class="section-btn-subir ">
                <form action="cargar_proyecto_corregido.php" method="post" enctype="multipart/form-data">
                    <label class="section-text-inp" for="nombre">ESTADO:</label>
                    <label class="label-inp" type="text" id="nombre" name="nombre" required>Subir Proyecto de Tesis Corregido</label>
                    <label class="section-text-inp" for="nombre">Seleccion archivo:</label>
                    <input type="file" id="file-input" name="archivo" style="display: none;" />
                    <label for="file-input" class="upload-button">Registrar Proyecto de Tesis</label>
                    <input type="hidden" name="tesista_id" value="1"> 
                    <br><br>
                    <div class="section-btn-subir ">
                        <input class="upload-button" type="submit" name="submit" value="Enviar">
                    </div>
                </form>
            </div>
          </div>
        <div class="cuadro2">
        <div class="section-cumplido">
            
                <div class="icon-left">    
                <img src="../../public/image-0@2x.png" alt="Icon" class="icon-list">
                <div class="contenido">
                <p class="titulo1">Bienvenido a PILAR</p>
                <p class="conenid-titulo">
                  <span>La Plataforma PILAR tiene por objetivo agilizar el proceso de
                    investigación con las herramientas necesarias para realizarel
                    trámite de tu proyecto y borrador de Tesis.</span>
                </p>
                </div>        
                </div>
            
        </div>
        <div class="section-cumplido">

            <div class="icon-left">    
            <img src="../../public/image-1@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1">Carga de Proyecto</p>
                <p class="conenid-titulo">
                  <span>24 Horas - Coordinación de Investigación de la Facultad
                     Procedimiento : Revisión de Formato</span>
                </p>
            </div>
            </div> 
        </div>

        <div class="section-cumplido">

            <div class="icon-left">    
            <img src="../../public/image-2@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1"><a class="etiq-a-s" href="./pagina2.php">Director Revisa el Proyecto</a></p>
                <p class="conenid-titulo">
                  <span>El Director de Tesis debe de dar el visto bueno y/o conformidad 
                    por la plataforma PILAR en un plazo de 48 horas, Comunicate con tu Director/
                    Asesor para acelerar este procedimiento.</span>
                </p>
              </div>
              </div>
        </div>

        <div class="section-cumplido">

            <div class="icon-left">    
            <img src="../../public/image-3@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1"><a class="etiq-a-s" href="./pagina3.php">Listo para el Sorteo</a></p>
                <p class="conenid-titulo">
                  <span>Proyecto aprobado por el director de tesis y enviado para sorteo, El sorteo es 
                    realizado por la coordinación de Investigación vía plataforma PILAR, para verificar 
                    el estado de este proceso puede usar la sección de contacto.</span>
                </p>
            </div>
            </div>
        </div>

        <div class="section-cumplido">

            <div class="icon-left">    
            <img src="../../public/image-4@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1"><a class="etiq-a-s" href="./pagina4.php">En Revisión de Jurados</a></p>
                <p class="conenid-titulo">
                  <span>El proyecto se encuentra en revisión por los jurados de tesis durante un periodo 
                    máximo de (10 días laborables), en caso de que algún jurado no de respuesta, puede solicitar
                     la habilitación para pasar a la siguiente etapa DICTAMEN.</span>
                </p>
            </div>
            </div>
        </div>

        <div class="section-cumplido">

            <div class="icon-left">    
            <img src="../../public/image-5@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1"><a class="etiq-a-s" href="./pagina5.php">Subida de Correciones</a></p>
                <p class="conenid-titulo">
                  <span>El tesista deberá de realizar las correcciones del Jurado y cargar nuevamente el archivo, 
                    considerando las letras de color rojo, Y de ser necesario el Informe de Correcciones.Una vez 
                    cargadas las correcciones el estado cambia a dictaminación.</span>
                </p>
            </div>
            </div>
        </div>

        <div class="section">

            <div class="icon-left">    
            <img src="../../public/image-6@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1">Proyecto Aprobado</p>
                <p class="conenid-titulo">
                  <span>Proyecto aprobado según modalidad Unanimidad, Mayoria , Reglamento, Usted puede EJECUTAR su
                     proyecto a partir de la fecha consignada en el Ácta de Aprobación por un periodo no menor a 3 
                     meses generado por sistema.</span>
                </p>
            </div>
            </div>
        </div>

        <div class="section">

            <div class="icon-left">    
            <img src="../../public/image-7@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1">Habilitar y Cargar el Borrador</p>
                <p class="conenid-titulo">
                  <span>Para Habilitar la Plataforma debe de presentar o cargar los siguientes documentos : 
                    Acta de Aprobación, Bachiller (Legalizado) y Resolución de Bachiller. Posterior a ello cargar el
                    formato en PDF el borrador de tesis revisado por el Asesor Principal ( Director ) de tesis.</span>
                </p>
            </div>
            </div>
        </div>

        <div class="section">

            <div class="icon-left">    
            <img src="../../public/image-8@2x.png" alt="Icon" class="icon-list">
            <div class="contenido">
                <p class="titulo1">Borrador Cargado a la Plataforma</p>
                <p class="conenid-titulo">
                  <span>Usted registró en plataforma el borrador de tesis. Deberá ser validado por la coordinación de 
                    investigación para el envío a los jurados.</span>
                </p>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="col-sm-4" >
                    <div class="row_1">
                        <div class="col-sm-12">
                            <ul>
                                <li><a class="active bor" href="#"><i class="fa fa-home fa-2x"></i>&ensp;Inicio</a></li>
                                <li><a class="bor1" href="#news"><i class="fa fa-user fa-2x"></i>&ensp;Perfil</a></li>
                            </ul>
                              
                        </div><br>
                        <div class="col-sm-12">
                            <ul>
                                <li><a class="bor" href="#home"><i class="fa fa-book fa-2x"></i>&ensp;Lineas de Investigación</a></li>
                                <li><a class="bor2" href="#news"><i class="fa fa-cogs fa-2x"></i>&ensp;Herramientas de Docente</a></li>
                                <li><a class="bor1" href="#news"><i class="fa fa-phone fa-2x"></i>&ensp;Contacto</a></li>
                            </ul>
                        </div><br>
                        <div class="col-sm-12">
                            <ul>
                                <li><a class="bor" href="#"><i class="fa fa-file fa-2x"></i>&ensp;Proyectos de Tesis en curso</a></li>
                                <li><a class="bor2" href="#news"><i class="fa fa-tasks fa-2x"></i>&ensp;Borradores de Tesis en curso</a></li>
                                <li><a class="bor1" href="#news"><i class="fa fa-wifi fa-2x"></i>&ensp;Sustentaciones No Presenciales</a></li>
                            </ul>
                        </div><br>
                        <div class="col-sm-12">
                            <p style="color: rgb(4, 4, 113);margin: 0 0 3% 0;"><b>FORMATOS</b></p>
                            <ul>
                               <a class="bor3" href="https://vriunap.pe/vriadds/pilar/doc/formatos/Formato%20de%20proyecto%20de%20tesis%20-%20Sistemas.docx">
                                    <i class="fa fa-download fa-1x"></i>&ensp;<span style="font-size: 12px;">Descargar Formato: Proyecto de Tesis</span>
                                </a>
                            </ul>
                            
                            
                        </div>
                      </div>                      
                              
    </div>
  </div>

  
        <!-- Modal notificaciones-->
        <div class="modal fade " id="notificaciones" style="width: 55%; margin: 2.5% 0 0 53%" >
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h4 style="color: rgb(4, 4, 113); margin-left: 20%;"><b>Lista de Notificaciones</b></h4>
                        <a href="" data-dismiss="modal"><i class="fa fa-times icon-x fa-2x"></i></a>
            
                    </div>

                    <div class="modal-body" style="overflow-y: auto;max-height: 73.5vh;">

                        <?php
                            
                            $mysqli = new mysqli("localhost", "root", "", "pilar");


                            if ($mysqli->connect_errno) {
                                echo "Error al conectar a la base de datos: " . $mysqli->connect_error;
                                exit();
                            }

                            
                            $query = "SELECT * FROM notificaciontesista WHERE Tesista_Id = 1";

                            $resultado = mysqli_query($mysqli, $query);

                            $cantidad = mysqli_num_rows($resultado);

                            $leido = 0; //indicador del notificacion leida o no leida

                            if ($cantidad == 0){
                        ?>
                                <h6>Lista de Notificación vacía</h6>
                        
                        <?php
                            }else{

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                                    <div class="notificaciones" style="margin: 0 0 1.5% 0;background-color: <?php echo ($leido === 0) ? '#d0e0ef' : 'white'; ?>;">
                                   
                                        <div class="usuario" style="background-color: <?php echo ($leido === 0) ? '#d0e0ef' : 'white'; ?>;">
                                            <i class="fa fa-user fa-3x"></i>
                                            <p style="display: flex;align-items: center;justify-content: center;"><b>PILAR</b></p>
                                        </div>

                                        <div class="asunto" style="background-color: <?php echo ($leido === 0) ? '#d0e0ef' : 'white'; ?>;">
                                            <div class="descripcion" style="text-align: left; font-size: 12px; margin-bottom: 0;">
                                                <h6><?php echo $fila['Descripcion']; ?></h6>
                                                <p>
                                                    <?php 
                                                        $contenido = $fila['contenido'];
                                                        $palabras = explode(" ", $contenido);
                                                        $cantidadPalabrasMostradas = 18;

                                                        $parteMostrada = implode(" ", array_slice($palabras, 0, $cantidadPalabrasMostradas));
                                                        echo $parteMostrada . "...";
                                                    
                                                    ?>
                                                 <a style="color: rgb(76, 76, 76);" href="#detalle" data-toggle="modal" data-target="#detalleModal">Ver más</a>
                                                </p>
                                            </div>

                                            <div class="fecha" style="text-align: right; font-size: 10px; margin-top: -5%;">
                                                <b><span>
                                                    <?php echo $fila['hora']; ?></h6> <br>
                                                    <?php echo $fila['Fecha']; ?></h6>
                                                </span></b>
                                            </div>
                                        </div>
                                    </div>
                        
                        <?php
                                }
                            }
                        ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Modal detalle de notificaciones -->

    <div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true" style="width: 60%;">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detalleModalLabel">Detalle de la Notificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
        <!-- Agregamos el estilo max-height y overflow-y para ajustar el scroll -->
         <?php
                            
         $mysqli = new mysqli("localhost", "root", "", "pilar");


         if ($mysqli->connect_errno) {
             echo "Error al conectar a la base de datos: " . $mysqli->connect_error;
             exit();
         }

         
         $query = "SELECT * FROM notificaciontesista WHERE Tesista_Id = 1";

         $resultado = mysqli_query($mysqli, $query);

         $cantidad = mysqli_num_rows($resultado);

         $leido = 0; //indicador del notificacion leida o no leida

         if ($cantidad == 0){
     ?>
             <h6>Lista de Notificación vacía</h6>
     
     <?php
         }else{

             while ($fila = mysqli_fetch_assoc($resultado)) {
     ?>
                 <div class="notificaciones" style="margin: 0 0 1.5% 0;background-color: <?php echo ($leido === 0) ? '#d0e0ef' : 'white'; ?>;">
                
                     <div class="usuario" style="background-color: <?php echo ($leido === 0) ? '#d0e0ef' : 'white'; ?>;">
                         <i class="fa fa-user fa-3x"></i>
                         <p style="display: flex;align-items: center;justify-content: center;"><b>PILAR</b></p>
                     </div>

                     <div class="asunto" style="background-color: <?php echo ($leido === 0) ? '#d0e0ef' : 'white'; ?>;">
                         <div class="descripcion" style="text-align: left; font-size: 12px; margin-bottom: 0;">
                             <h6><?php echo $fila['Descripcion']; ?></h6>
                             <p>
                                 <?php 
                                     echo $fila['contenido'];
                                 
                                 ?>

                             </p>
                         </div>

                         <div class="fecha" style="text-align: right; font-size: 10px; margin-top: -5%;">
                             <b><span>
                                 <?php echo $fila['hora']; ?></h6> <br>
                                 <?php echo $fila['Fecha']; ?></h6>
                             </span></b>
                         </div>
                     </div>
                 </div>
     
     <?php
             }
         }
     ?>
      </div>
    </div>
  </div>
</div>


  <footer class="footer">
    <p>Universidad Nacional del Altiplano Vicerrectorado de Investigación Dirección General de Investigación © Plataforma de Investigación y Desarrollo &copy; </p>
  </footer>
</body>
</html>