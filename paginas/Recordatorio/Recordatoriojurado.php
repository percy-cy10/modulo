<?php
use PHPMailer\PHPMailer\PHPMailer;
require '../Notificaciones/PHPMailer/src/PHPMailer.php';
require '../NotificacionesPHPMailer/src/SMTP.php';
require '../NotificacionesPHPMailer/src/Exception.php';
$ids = $_SESSION['id_usuario'];
// Configuración de la base de datos
include '../../conexiones/database.php';

$sql = "SELECT Realizado FROM jurados WHERE Realizado = 0";

$resultado = mysqli_query($mysqli, $sql);

// Comprobar si se obtuvo el resultado de la consulta
if ($resultado) {
    // Verificar si hay registros encontrados
    if (mysqli_num_rows($resultado) > 0) {
        $sqlData = "SELECT
                        j.id AS id_jurados,
                        j.Email AS email_jurados,
                        j.Celular AS celular_jurados,
                        nj.Fecha AS fecha_notificacion
                    FROM 
                        tesista t
                    LEFT JOIN 
                        proyectotesis pt ON t.id = pt.Tesista_id
                    LEFT JOIN 
                        jurados j ON pt.Jurado_1 = j.id OR pt.Jurado_2 = j.id OR pt.Jurado_3 = j.id
                    LEFT JOIN 
                        notificacionjurado nj ON j.id = nj.Jurado_id
                    WHERE
                        t.id = $ids";
        $resultData = $mysqli->query($sqlData);

        $destinatarios = array();
        $usuarios = array();
        $id = array();
        if ($resultData && $resultData->num_rows > 0) {
            while ($row = $resultData->fetch_assoc()) {
                $destinatarios[] = array(
                    'id' => $row['id_jurados'], // Almacenamos el tesista_id en el array de destinatarios
                    'celular' => $row['celular_jurados']
                );
                $usuarios[] = array(
                    'id' => $row['id_jurados'],
                    'email' => $row['email_jurados']
                ); // Almacenamos los correos electrónicos en el array de usuarios
                // Almacenamos las fechas de notificación en el array $fechas_notificacion
                $fechas_notificacion[] = $row['fecha_notificacion'];
            }
        }
        //Mensaje de texto para enviar
        $asunto = 'Asunto: Recordatorio de Revision de la plataforma Pilar';
        $mensajeTexto = '
        Estimado Jurado,
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
        Estimado Jurado,
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
                $fecha_notificacion = new DateTime($fechas_notificacion[$key])+10;
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
                    $sqlInsertSMS = "INSERT INTO recordatoriojurado(Descripcion,contenido, Tipo, Fecha, hora, Tesista_Id) VALUES ('$Descripcion', '$contenido','$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Tesista_Id')";
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
                $fecha_notificacion = new DateTime($fechas_notificacion[$key])+10;
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
                    $sqlInsertSMS = "INSERT INTO recordatoriojurado(Descripcion,contenido, Tipo, Fecha, hora, Tesista_Id) VALUES ('$Descripcion','$contenido', '$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Tesista_Id')";
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

/* Consulta para obtener los números de teléfono de destinatarios desde la base de datos
$sqlData = "SELECT j.id AS jurado_id, j.Celular AS celular, j.Email AS email, nj.Fecha AS fecha_notificacion
            FROM jurados j
            INNER JOIN notificacionjurado jt ON j.id = jt.jurado_id";
$resultData = $conn->query($sqlData);

$destinatarios = array();
$usuarios = array();
$id = array();
if ($resultData && $resultData->num_rows > 0) {
    while ($row = $resultData->fetch_assoc()) {
        $destinatarios[] = array(
            'id' => $row['jurado_id'], // Almacenamos el tesista_id en el array de destinatarios
            'celular' => $row['celular']
        );
        $usuarios[] = array(
            'id' => $row['jurado_id'],
            'email' => $row['email']
        ); // Almacenamos los correos electrónicos en el array de usuarios
        // Almacenamos las fechas de notificación en el array $fechas_notificacion
        $fechas_notificacion[] = $row['fecha_notificacion'];
    }
}
Mensaje de texto para enviar
$mensajeTexto = 'Asunto: Revision de la plataforma Pilar
Estimado Jurado,
Espero que esté teniendo un buen día. Quería informarle qaun tiene algo pendiente que realizar en la plataforma Pilar. 
Ingrese a la plataforma Pilar para ver a detalle.
Agradezco mucho su tiempo.';

// Datos de la API de UltraMsg
$tokenUltraMsg = 'wthv7lry1g7x6snq'; // Reemplaza con el token de autenticación proporcionado por UltraMsg.com
$urlUltraMsg = 'https://api.ultramsg.com/instance54498/messages/chat';

// Correo electrónico del administrador
$adminEmail = 'seguridadgrupojade@gmail.com';

// Mensaje de correo electrónico
$subject = 'Notificacion de Dictamen del Proyecto de Tesis';
$message = '
Estimado Jurado,
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
            $Descripcion = $mensajeTexto;
            $Tesista_Id = $destinatario['id'];
            $tipo = 'SMS';
            $sqlInsertSMS = "INSERT INTO recordatoriojurado(Descripcion, Tipo, Fecha, hora, Tesista_Id) VALUES ('$Descripcion', '$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Tesista_Id')";
            $conn->query($sqlInsertSMS);

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
            $Descripcion = $message;
            $tipo = 'Email';
            $sqlInsertSMS = "INSERT INTO recordatoriojurado(Descripcion, Tipo, Fecha, hora, Tesista_Id) VALUES ('$Descripcion', '$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Tesista_Id')";
            $conn->query($sqlInsertSMS);
        }
    }

} catch (Exception $e) {
    // Error al enviar las notificaciones: $mail->ErrorInfo
    // Puedes hacer algo si deseas manejar el error.
}
// Cerrar la conexión a la base de datos */
$mysqli->close();
?>