<?php
//error_reporting( ~E_ALL & ~E_NOTICE);
use PHPMailer\PHPMailer\PHPMailer;
require '../Notificaciones/PHPMailer/src/PHPMailer.php';
require '../NotificacionesPHPMailer/src/SMTP.php';
require '../NotificacionesPHPMailer/src/Exception.php';
$ids = $_SESSION['id_usuario'];
// Configuración de la base de datos
include '../../conexiones/database.php';

$sql = "SELECT Realizado FROM tesista WHERE Realizado = 0";

$resultado = mysqli_query($msqlli, $sql);

// Comprobar si se obtuvo el resultado de la consulta
if ($resultado) {
    // Verificar si hay registros encontrados
    if (mysqli_num_rows($resultado) > 0) {

        // Consulta para obtener los números de teléfono de destinatarios desde la base de datos
        $sqlData = "SELECT
                        pt.Tesista_Id AS id_tesista_proyectodetesis,
                        t.id AS tesista_id,
                        t.Email AS email,
                        t.Celular AS celular,
                        nt.Fecha AS fecha_notificacion
                    FROM
                        proyectotesis pt
                    INNER JOIN
                        tesista t ON pt.Tesista_Id = t.id
                    INNER JOIN
                        notificaciontesista nt ON t.id = nt.Tesista_Id
                    WHERE
                        pt.Jurado_1 = '$ids
                        OR pt.Jurado_2 = $ids
                        OR pt.Jurado_3 = $ids";
        $resultData = $mysqli->query($sqlData);

        $destinatarios = array();
        $usuarios = array();
        $id = array();
        if ($resultData && $resultData->num_rows > 0) {
            while ($row = $resultData->fetch_assoc()) {
                $destinatarios[] = array(
                    'id' => $row['tesista_id'], // Almacenamos el tesista_id en el array de destinatarios
                    'celular' => $row['celular']
                );
                $usuarios[] = array(
                    'id' => $row['tesista_id'],
                    'email' => $row['email']
                ); // Almacenamos los correos electrónicos en el array de usuarios
                // Almacenamos las fechas de notificación en el array $fechas_notificacion
                $fechas_notificacion[] = $row['fecha_notificacion'];
            }
        }

        // Mensaje de texto para enviar
        $asunto = 'Asunto: Recordatorio de Revision de la plataforma Pilar';
        $mensajeTexto = '
        Estimado Tesista,
        Espero que esté teniendo un buen día. Quería informarle qaun tiene algo pendiente que realizar en la plataforma Pilar. 
        Ingrese a la plataforma Pilar para ver a detalle.
        Agradezco mucho su tiempo.';

        // Datos de la API de UltraMsg
        $tokenUltraMsg = 'wthv7lry1g7x6snq'; // Reemplaza con el token de autenticación proporcionado por UltraMsg.com
        $urlUltraMsg = 'https://api.ultramsg.com/instance54498/messages/chat';

        // Correo electrónico del administrador
        $adminEmail = 'seguridadgrupojade@gmail.com';

        // Mensaje de correo electrónico
        $subject = 'Notificacion Recordatorio de Revision de la plataforma Pilar';
        $message = '
        Estimado Tesista,
        Espero que esté teniendo un buen día. Quería informarle qaun tiene algo pendiente que realizar en la plataforma Pilar. 
        Ingrese a la plataforma Pilar para ver a detalle.
        Agradezco mucho su tiempo.';

        // Configurar PHPMailer
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seguridadgrupojade@gmail.com';
        $mail->Password = 'bqmkjkdnswhtgptw';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        try {
            // Enviar mensajes de texto
            foreach ($destinatarios as $key => $destinatario) {
                $fecha_notificacion = new DateTime($fechas_notificacion[$key]);
                $fecha_actual = new DateTime();
                $diferencia = $fecha_notificacion->diff($fecha_actual);
                $dias_transcurridos = $diferencia->days;

                if ($dias_transcurridos >= 8) {
                    $params = array(
                        'token' => $tokenUltraMsg,
                        'body' => $mensajeTexto,
                        'to' => $destinatario['celular']
                    );
                    $Descripcion = $asunto;
                    $contenido = $mensajeTexto;
                    $Tesista_Id = $destinatario['id'];
                    $tipo = 'SMS';
                    $sqlInsertSMS = "INSERT INTO recordatoriotesista(Descripcion,contenido, Tipo, Fecha, hora, Tesista_Id) VALUES ('$Descripcion', '$contenido','$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Tesista_Id')";
                    $mysqli->query($sqlInsertSMS);

                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $urlUltraMsg,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_SSL_VERIFYHOST => 0,
                        CURLOPT_SSL_VERIFYPEER => 0,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => http_build_query($params),
                        CURLOPT_HTTPHEADER => array(
                            "content-type: application/x-www-form-urlencoded"
                        ),
                    ));

                    $response = curl_exec($curl);
                    $err = curl_error($curl);

                    curl_close($curl);

                    if ($err) {
                        // Error al enviar el mensaje de texto a $destinatario: cURL Error # $err
                        // Puedes hacer algo si deseas manejar el error.
                    } else {
                        // Mensaje de texto enviado correctamente a $destinatario: $response
                        // Puedes hacer algo si deseas verificar el éxito del envío.
                    }
                }
            }

            // Enviar notificaciones por correo electrónico
            foreach ($usuarios as $key => $usuario) {
                $fecha_notificacion = new DateTime($fechas_notificacion[$key]);
                $fecha_actual = new DateTime();
                $diferencia = $fecha_notificacion->diff($fecha_actual);
                $dias_transcurridos = $diferencia->days;

                if ($dias_transcurridos >= 8) {
                    $mail->setFrom('seguridadgrupojade@gmail.com', 'Sistema Pilar');
                    $mail->addAddress($usuario['email']); // Accede al campo 'email' del array $usuario
                    $mail->Subject = $subject;
                    $mail->Body = $message;
                    $mail->send();
                    $mail->clearAddresses();

                    $Tesista_Id = $usuario['id'];
                    $Descripcion = $subject;
                    $contenido = $message;
                    $tipo = 'Email';
                    $sqlInsertSMS = "INSERT INTO recordatoriotesista(Descripcion, contenido,Tipo, Fecha, hora, Tesista_Id) VALUES ('$Descripcion','$contenido', '$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Tesista_Id')";
                    $mysqli->query($sqlInsertSMS);
                }
            }

        } catch (Exception $e) {
            // Error al enviar las notificaciones: $mail->ErrorInfo
            // Puedes hacer algo si deseas manejar el error.
        }
    } 
} else {
    // Manejo de error en la consulta
    echo "Error al obtener los datos: " . mysqli_error($mysqli);
}
// Cerrar la conexión a la base de datos
$connmysqli->close();
?>
