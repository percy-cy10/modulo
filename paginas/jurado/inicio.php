
<?php
    session_start();
    include "../../conexiones/database.php";

    $id = $_SESSION['id_usuario'];

    $query = "SELECT * FROM jurados WHERE id = ".$id;
    $resultado = mysqli_query($mysqli, $query);

    if ($resultado) {
        if (mysqli_num_rows($resultado) > 0) {
            $fila = mysqli_fetch_assoc($resultado);
            $Nombres = $fila['Nombres'];
            $appP = $fila['ApellidoPaterno'];
            $appM = $fila['Apellidomaterno'];
        }
    }

    $not = "SELECT * FROM notificacionjurado WHERE Jurado_Id = ".$id." AND leido = 0";
    $resultadon = mysqli_query($mysqli, $not);

    $cant = mysqli_num_rows($resultadon); 
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../estilos/jurado/estilos.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
    <title>Pagina de Inicio</title>
</head>
<body>
    <div class="card text-center">
        <div class="card-header">
            <div class="left-column">
                
                <div style="display: flex;">
                    <img src="../../imagenes/jurado/logo_pilar.png" width="40px">
                    <p style="margin: 8px 0 0 10px;"><b>DOCENTE PILAR</b></p>
                </div>
                  
            </div>
            <div class="right-column">
                <div style="display: flex;">
                    <p style="margin: 3% 0 0 10px;font-size: 100%;"><b><?php echo "$Nombres $appP $appM"; ?></b></p>
                    <i class="fa fa-user fa-2x icon"></i>

                    <a href="#" data-toggle="modal" data-target="#notificaciones" class="notification">
                        <i class="fa fa-bell fa-2x "></i>
                        <?php

                            if ($cant != 0){
                        ?>
                                <span class="badge"><?php echo $cant; ?></span> 
                        <?php
                            }
                        ?>
                        
                    </a>
                      
                    <div>
                        <a href="../../cerrar_sesion.php"><i class="fa fa-sign-out fa-2x icon"></i></a>
                        <p style="font-size: 8px;">Cerrar Sesion</p>
                    </div>

                </div>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                
                <div class="col-sm-8">
                    <h4 style="color: rgb(4, 4, 113);margin: 4% 0 3% 0;"><b>Bienvenido a la Plataforma Pilar</b></h4>
                    
                    <div class="contenido">
                        <h6>¡Hola, <?php echo "$Nombres $appP $appM"; ?></h6>
                        <p>
                            El Vicerrectorado de Investigación de la Universidad Nacional del Altiplano Puno 
                            se encuentra muy agradecido por ser parte de la investigación como JURADO. Recuerda
                            ingresar a la plataforma de manera frecuente y revisar tus proyectos de tesis 
                            ademas te recordamos que revises el siguiente reglamento de PILAR.
                        </p>
                        <i class="fa fa-hand-o-right"></i>
                        <a style="color: black !important;" href="https://vriunap.pe/vriadds/pilar/doc/reglamentoPilar2018.pdf">Reglamento PILAR 2018</a>
                        <h6 style="margin-top: 2%;">Resumen del Reglamento</h6>
                        <p>
                            La Universidad Nacional del Altiplano de Puno ha establecido un reglamento que regula la 
                            presentación de proyectos de tesis de pregrado para los estudiantes matriculados y/o egresados
                            antes de la promulgación de la Ley Nº30220 conocida como Ley Universitaria. Esta normativa se 
                            aplica a través de la Plataforma de Investigación Integrada a la Labor Ecadémica con responsabilidad
                            (PILAR) la cual es administrada por el Vicerrectorado de Investigación (VRI) de la universidad.

                            El reglamento se basa en diversas leyes y normativas que establecen el marco legal para el funcionamiento
                            de la Universidad y la presentación de proyectos de tesis, entre las bases legales mencionadas se encuentran:
                        </p>
                        <li>
                            Constitución Política del Perú: La norma fundamental del país que establece los principios
                            y derechos que deben regir en la educación y la investigación.
                        </li>
                        <li>
                            Ley Nº 30220 Ley Universitaria: esta ley promulgada en Perú establece las disposiciones 
                            generales para la organización y funcionamiento de las universidades.
                        </li>
                        <li>
                            Ley de Colegios profesionales del Perú: Se hace mención a la ley que regula la creación,
                            organización y funcionamiento de los colegios profesionales en el país.
                        </li>
                        <li>
                            Ley de la transparencia de acceso a la información: Hace referencia a la legislación que 
                            promueve la transparencia y el acceso a la información en el ámbito público.
                        </li>

                    </div>
                
                </div>

                <div class="col-sm-4" >
                    <div class="row_1">
                        <div class="col-sm-12">
                            <ul>
                                <li><a class="active bor" href="inicio.php"><i class="fa fa-home fa-2x"></i>&ensp;Inicio</a></li>
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
                                <li><a class="bor" href="observaciones.php"><i class="fa fa-file fa-2x"></i>&ensp;Proyectos de Tesis en curso</a></li>
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
        
        </div>

        <div class="card-footer" style="font-size: 10px;">
            <div>Consultas Correo: dginvestigacion@unap.edu.pe</div>
            <div>Vicerrectorado de Investigación Dirección General de Investigación @ Plataforma de Investigación y Desarrollo</div>
            <div>
                <img  style="margin-top: -6%;" src="../../imagenes/jurado/Logo_unap.png" width="30px">
                <span>Universidad Nacional del Altiplano</span>
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

                            
                            $query = "SELECT * FROM notificacionjurado WHERE Jurado_Id = ".$id;

                            $resultado = mysqli_query($mysqli, $query);

                            $cantidad = mysqli_num_rows($resultado);


                            if ($cantidad == 0){
                        ?>
                                <h6>Lista de Notificación vacía</h6>
                        
                        <?php
                            }else{

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                                    <div class="notificaciones" style="margin: 0 0 1.5% 0;background-color: <?php echo ($fila['leido'] == 0) ? '#d0e0ef' : 'white'; ?>;">
                                   
                                        <div class="usuario" style="background-color: <?php echo ($fila['leido'] == 0) ? '#d0e0ef' : 'white'; ?>;">
                                            <i class="fa fa-user fa-3x"></i>
                                            <p style="display: flex;align-items: center;justify-content: center;"><b>PILAR</b></p>
                                        </div>

                                        <div class="asunto" style="background-color: <?php echo ($fila['leido'] == 0) ? '#d0e0ef' : 'white'; ?>;">
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
                                                    <a style="color: rgb(76, 76, 76);"  href="#detalle">Ver más</a>
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
</body>

    <script>
        $(document).ready(function() {
            $('.col-sm-12 li a').click(function() {
                $('.col-sm-12 li a').removeClass('active');
                $(this).addClass('active');
            });
        });


    </script>

</html>