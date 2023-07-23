<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
$ids = $_SESSION['id_usuario'];
// Configuración de la base de datos
include '../../conexiones/database.php';
$ids = $_SESSION['id_usuario'];
// Consulta para obtener los números de teléfono de destinatarios desde la base de datos
$sqlData = "SELECT
                j.id AS id_jurados,
                j.Email AS email_jurados,
                j.Celular AS celular_jurados
                FROM 
                tesista t
                LEFT JOIN 
                proyectotesis pt ON t.id = pt.Tesista_id
                LEFT JOIN 
                jurados j ON pt.Jurado_1 = j.id OR pt.Jurado_2 = j.id OR pt.Jurado_3 = j.id
                WHERE
                t.id = $ids"; // Corrigiendo las comillas en la consulta SQL

$resultData = $mysqli->query($sqlData);

$destinatarios = array();
$usuarios = array();
if ($resultData->num_rows > 0) {
    while ($row = $resultData->fetch_assoc()) {
        $destinatarios[] = array(
            'id' => $row['id_jurados'], // Almacenamos los Jurado_Id concatenados en el array de destinatarios
            'celular' => $row['celular_jurados'] // Almacenamos los números de celular concatenados en el array de destinatarios
        );
        $usuarios[] = array( 
            'id' => $row['id_jurados'], // Almacenamos los Jurado_Id concatenados en el array de usuarios
            'email' => $row['email_jurados'] // Almacenamos los correos electrónicos concatenados en el array de usuarios
        );
    }
}
// Mensaje de texto para enviar
$asunto =  'Asunto: Corrección del Proyecto de Tesis';
$mensajeTexto = '
Estimado Jurado,
Le informo que se ha realizado las correcciones en el proyecto de tesis y ya está disponible para su revisión en la plataforma Pilar. 
Agradezco su tiempo y quedo atento/a a cualquier consulta.
Gracias y saludos cordiales';

// Datos de la API de UltraMsg
$tokenUltraMsg = 'wthv7lry1g7x6snq'; // Reemplaza con el token de autenticación proporcionado por UltraMsg.com
$urlUltraMsg = 'https://api.ultramsg.com/instance54498/messages/chat';

// Correo electrónico del administrador
$adminEmail = 'seguridadgrupojade@gmail.com';

// Mensaje de correo electrónico
$subject = 'Notificacion de correccion del Proyecto de Tesis';
$message = '
Estimado Jurado,
Espero que esté teniendo un buen día. Quería informarle que se ha subido una nueva versión corregida del proyecto de tesis. 
El archivo actualizado está disponible para su revisión y evaluación.
Agradezco mucho su tiempo y esfuerzo dedicados a la revisión del proyecto.';

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
            'to' => $destinatario['celular'] // Accede al campo 'celular' del array $destinatario
        );

        $Descripcion = $asunto;
        $contenido = $mensajeTexto;
        $Jurado_Id = $destinatario['id'];
        $tipo = 'SMS';
        $sqlInsertSMS = "INSERT INTO notificacionjurado (Descripcion, contenido, Tipo, Fecha, hora, Jurado_Id) VALUES ('$Descripcion', '$contenido', '$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Jurado_Id')";
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

        $Jurado_Id = $usuario['id'];
        $contenido = $message;
        $Descripcion = $subject;
        $tipo = 'Email';
        $sqlInsertEmail = "INSERT INTO notificacionjurado (Descripcion, contenido, Tipo, Fecha, hora, Jurado_Id) VALUES ('$Descripcion', '$contenido', '$tipo', CURRENT_DATE(), CURRENT_TIME(), '$Jurado_Id')";
        $mysqli->query($sqlInsertEmail);
    }

} catch (Exception $e) {
    // Manejo de errores al enviar las notificaciones
    // ...
}

//SCerrar la conexión a la base de datos
$mysqli->close();
?>

