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

   
    <title>Pagina de Incio</title>
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
                    <h4 style="color: rgb(4, 4, 113);margin: 2% 0 2% 0;"><b>Proyectos de Tesis Asignados</b></h4>
                    
                    <div class="contenido" style="overflow-y: auto;max-height: 66.2vh;">

                        <table style="width: 100%; ">
                            <tr style="background-color: #b4c1c5; color: #021068; ">
                                <th style="text-align: center;"><b>Código de Proyecto de Tesis</b></th>
                                <th style="text-align: center;"><b>Estado de Proyecto de Tesis</b></th>
                                <th style="text-align: center;"><b>Realizar Acciones</b></th>
                                <th style="text-align: center;"><b>Ver Detalles</b></th>
                            </tr>

                            <?php

                            $query = "SELECT * FROM proyectotesis WHERE Jurado_1 =".$id." OR Jurado_2 = ".$id." OR Jurado_3 = ".$id;

                            $resultado = mysqli_query($mysqli, $query);

                            while ($fila = mysqli_fetch_assoc($resultado)) { ?>

                            <tr style="background-color: white;">

                                <td style="width: auto; text-align: center;"><b><?php echo $fila['Codigo'];  ?></b></td>
                                <td style="width: auto; text-align: center;" >
                                    <div class="col-sm-12">
                                        <p style="color: rgb(4, 4, 113); margin: 0 0 -1% 0"><b>Estado General</b></p>                                       
                                        <button  class="btn personalizado_3" style="background-color: <?php echo ($fila['Estado']  == 0) ? '#fefe0a' : '#0bac08'; ?>; !important">
                                            <p style="font-size:12px;"><b><?php echo ($fila['Estado']  == 0) ? 'Proceso de Revisión' : 'Sustentado'; ?></b></p>
                                        </button>
                                        
                                    </div>
                                </td>
                                <td style="width: auto; text-align: center;">
                                    <div class="col-sm-12">
                                        <p style="color: rgb(4, 4, 113); margin: 0 0 -1% 0"><b>Realizar Correcciones</b></p>
                                        
                                        <?php
                                            $ubicacionDocumento = $fila['Documento'];
                                        ?>
                                        
                                        <button <?php echo ($fila['Estado'] == 0) ? 'data-toggle="modal" data-target="#proyecto" data-documento="../../documentos/'.$ubicacionDocumento.'#toolbar=0&navpanes=0"' : ''; ?> class="btn personalizado" style="background-color: <?php echo ($fila['Estado'] == 0) ? '#0bac08' : '#88898a'; ?>; !important">
                                            <p style="font-size:12px;"><b>Revisar Proyecto de Tesis</b></p>
                                        </button>
                                        
                                        <?php

                                            $registroID = $fila['id'];
                                        ?>
                                        

                                        <p style="color: rgb(4, 4, 113); margin: 6% 0 -1% 0"><b>Realizar Dictamen</b></p>                                       
                                        <button <?php echo ($fila['Estado']  == 0) ? 'data-toggle="modal" data-target="#dictamen" data-id="'.$registroID.'"' : ''; ?> class="btn personalizado_2" style="background-color: <?php echo ($fila['Estado'] == 0) ? '#021068 ' : '#88898a'; ?>; !important">
                                            <p style="font-size:12px;"><b>Dictaminar Proyecto de Tesis</b></p>
                                        </button>
                                    
                                    </div>
                                </td>
                                <td style="width: 30%; text-align: center;">
                                    <div class="col-sm-12">                                     
                                        <button class="btn personalizados" ><p style="font-size:12px; margin: 0;"><b>Descargar Proyecto de Tesis</b></p></button>
                                  
                                        <button class="btn personalizados" ><p style="font-size:12px; margin: 0;"><b>Descargar Acta de Sorteo</b></p></button>
                                        
                                        <button class="btn personalizados" ><p style="font-size:12px; margin: 0;"><b>Descargar Acta de Aprobación</b></p></button>
                                  
                                        <button class="btn personalizado_1" style="background-color: <?php echo ($fila['Estado']  == 0) ? '#88898a' : '#021068'; ?>; !important">
                                            <p style="font-size:12px; margin: 0;"><b>Descargar Acta de Dictamen</b></p>
                                        </button>
                              
                                    </div>
                                </td>
                            
                            </tr>
                            <?php } ?>

                        </table>
                   
                    </div>
                
                </div>

                <div class="col-sm-4" >
                    <div class="row_1">
                        <div class="col-sm-12">
                            <ul>
                                <li><a class="bor" href="inicio.php"><i class="fa fa-home fa-2x"></i>&ensp;Inicio</a></li>
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
                                <li><a class="active bor" href="observaciones.php"><i class="fa fa-file fa-2x"></i>&ensp;Proyectos de Tesis en curso</a></li>
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


        <?php

            $query = "SELECT * FROM proyectotesis WHERE id = 1"; //

            $resultado_tesista = mysqli_query($mysqli, $query);

            
            if ($resultado_tesista) {
                if (mysqli_num_rows($resultado_tesista) > 0) {
                    $fila = mysqli_fetch_assoc($resultado_tesista);
                    $documento = $fila['Documento'];
                }
            }
        ?>
        <!-- Modal proyecto-->

        <div class="modal fade " id="proyecto">
            <div class="modal-dialog-p" >
                <div class="modal-content-p">
                    <div class="row" style="background-color: white;">
                        <div class="col-md-8" style="border-right: 1px solid #c0c0c0">
                            <iframe id="iframe-documento" width="100%" height="100%" style="margin:0 0 0 -5%"></iframe>

                        </div>
                        <div class="col-md-4">
                            <div class="modal-header">
                                <h5 style="color: rgb(4, 4, 113); margin-left: 13%;"><b>Realizar observaciones</b></h5>
                                <a href="observaciones.php" ><i class="fa fa-times icon-x fa-2x"></i></a>
                
                            </div>

                            <div class="modal-body" style="overflow-y: auto;max-height: 62.2vh;"><br>

                                <form action="actualizar_observaciones.php" method="post" id="myForm">
                                    <textarea class="form-control" rows="3" placeholder="Observaciones" required></textarea><br>
                                    <textarea class="form-control" rows="3" placeholder="Observaciones" required></textarea><br>
                                    <br><br><ul>
                                        <a class="bor3" href="#" style=" margin: -20% 0 0 -17.5%; background-color: rgb(212, 212, 212);!important; color: black !important;">
                                            Agregar Observación</span>
                                        </a>
                                    </ul>  
                            </div>

                            <div class="modal-footer">

                                    <button class="btn" style="background-color: #021068; color: white; border-radius: 10px; width: 100%;  " type="submit" >Enviar Observación</button>
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>

        <!--Dictamen-->
        <div class="modal fade " id="dictamen">
            <div class="modal-dialog-p" >
                <div class="modal-content-p">
                    <div class="row_2">
       
                        <div class="modal-body">

                            <div class="modal-header">

                                <h5 style="color: rgb(4, 4, 113); margin: auto;"><b>DICTAMINAR <br> Proyecto de Tesis</b></h5>
                                <a href="observaciones.php" ><i class="fa fa-times icon-x fa-2x"></i></a>
                            </div>

                            <form action="actualizar_estado.php" method="POST">
                                <input type="hidden" name="registro_id" id="registro_id" value="">

                                

                                <label  class="form-label">
                                    <input type="radio" name="opcion" value="1">
                                    APROBAR PROYECTO DE TESIS
                                </label>
                                <br>
                                <label  class="form-label">
                                    <input type="radio" name="opcion" value="2">
                                    DESAPROBAR PROYECTO DE TESIS
                                </label>

                                <div class="modal-footer">
                                    <button class="btn" style="background-color: #021068; color: white; border-radius: 10px; width: 100%;  " type="submit" >
                                        <p style="display: flex;justify-content: center; margin-top:2%">Confirmar Dictamen</p>
                                    </button>
                                </div>

                            </form>    

                        </div>

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

        document.querySelectorAll('.personalizado').forEach(button => {
            button.addEventListener('click', function() {
                // Obtener la ubicación del documento desde el atributo 'data-documento'
                const ubicacionDocumento = this.getAttribute('data-documento');

                // Cargar el contenido del documento en el iframe del modal
                const iframeDocumento = document.getElementById('iframe-documento');
                iframeDocumento.src = ubicacionDocumento;
            });
        });

        // Capturar el evento de clic en el botón con clase 'personalizado_2'
        document.querySelectorAll('.personalizado_2').forEach(button => {
            button.addEventListener('click', function() {
                // Obtener el ID del registro desde el atributo 'data-id'
                const registroID = this.getAttribute('data-id');

                // Asignar el valor del ID del registro al campo oculto en el formulario del modal
                document.getElementById('registro_id').value = registroID;
            });
        });

    </script>


</html>
