<?php
session_start();
//error_reporting( ~E_ALL & ~E_NOTICE);
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$ids = $_SESSION['id_usuario'];
// Configuración de la base de datos
include '../../conexiones/database.php';

// Consulta para obtener los números de teléfono de destinatarios desde la base de datos
$sqlData = "SELECT p.Tesista_Id, t.id, t.Email, t.Celular
            FROM proyectotesis p
            INNER JOIN jurados j ON p.Jurado_1 = j.id OR p.Jurado_2 = j.id OR p.Jurado_3 = j.id
            INNER JOIN tesista t ON p.Tesista_Id = t.id
            WHERE j.id = $ids"; // Agregamos la condición de unión con la tabla 'proyecto_de_tesis'
$resultData = $mysqli->query($sqlData);

$destinatarios = array();
$usuarios = array();
$id = array();
if ($resultData && $resultData->num_rows > 0) {
    while ($row = $resultData->fetch_assoc()) {
        $destinatarios[] = array(
            'id' => $row['id'], // Almacenamos el tesista_id en el array de destinatarios
            'celular' => $row['Celular']
        );
        $usuarios[] = array(
            'id' => $row['id'],
            'email' => $row['Email']
        ); // Almacenamos los correos electrónicos en el array de usuarios
    }
}


// Resto del código para enviar mensajes de texto y correos electrónicos (sin cambios)...

// Mensaje de texto para enviar
$asunto = 'Asunto: Revision del Proyecto de Tesis';
$mensajeTexto = '
Estimado Tesista,
Le informo que se ha realizado la revision del proyecto de tesis y ya está disponible para realizar las correcciones en la plataforma Pilar. 
Agradezco su tiempo.
Gracias y saludos cordiales';

// Datos de la API de UltraMsg
$tokenUltraMsg = 'wthv7lry1g7x6snq'; // Reemplaza con el token de autenticación proporcionado por UltraMsg.com
$urlUltraMsg = 'https://api.ultramsg.com/instance54498/messages/chat';

// Correo electrónico del administrador
$adminEmail = 'seguridadgrupojade@gmail.com';

// Mensaje de correo electrónico
$subject = 'Notificacion de Revision del Proyecto de Tesis';
$message = '
Estimado Tesista,
Espero que esté teniendo un buen día. Quería informarle que se ha realizado la revision del proyecto de tesis. 
Ya vestá disponible para realizar las correcciones correspondientes.
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
    foreach ($destinatarios as $destinatario) {
        $params = array(
            'token' => $tokenUltraMsg,
            'body' => $mensajeTexto,
            'to' => $destinatario
        );
        $contenido = $mensajeTexto;
        $Descripcion = $asunto;
        $Tesista_Id = $destinatario['id'];
        $tipo = 'SMS';
        $sqlInsertSMS = "INSERT INTO notificaciontesista(Descripcion,contenido, Tipo,Fecha, hora,Tesista_Id) VALUES ('$Descripcion','$contenido', '$tipo',CURRENT_DATE(),CURRENT_TIME(),'$Tesista_Id')";
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
            // Error al enviar el mensaje a $destinatario: cURL Error # $err
            // Puedes hacer algo si deseas manejar el error.
        } else {
            // Mensaje de texto enviado correctamente a $destinatario: $response
            // Puedes hacer algo si deseas verificar el éxito del envío.
        }
    }

    // Enviar notificaciones por correo electrónico
    foreach ($usuarios as $usuario) {
        $mail->setFrom('seguridadgrupojade@gmail.com', 'Sistema Pilar');
        $mail->addAddress($usuario['email']); // Accede al campo 'email' del array $usuario
        $mail->Subject = $subject;
        $mail->Body = $message;
        $mail->send();
        $mail->clearAddresses();
    
        $Tesista_Id = $usuario['id'];
        $contenido = $message;
        $Descripcion = $subject;
        $tipo = 'Email';
        $sqlInsertSMS = "INSERT INTO notificaciontesista(Descripcion,contenido, Tipo,Fecha, hora,Tesista_Id) VALUES ('$Descripcion','$contenido', '$tipo',CURRENT_DATE(),CURRENT_TIME(),'$Tesista_Id')";
        $mysqli->query($sqlInsertSMS);
    }

} catch (Exception $e) {
    // Error al enviar las notificaciones: $mail->ErrorInfo
    // Puedes hacer algo si deseas manejar el error.
}
// Cerrar la conexión a la base de datos
$mysqli->close();
?>