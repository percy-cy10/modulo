<?php
session_start();
error_reporting( ~E_ALL & ~E_NOTICE);
// Verificar si la variable de sesión del contador existe
if (!isset($_SESSION['contador_fallidos'])) {
    // Si no existe, inicializarla a 0
    $_SESSION['contador_fallidos'] = 0;
}

$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];

$ip = $_SERVER["REMOTE_ADDR"];
$captcha = $_POST['g-recaptcha-response'];
$secretKey = '6LcCEUAnAAAAAGg1bpLbrw7o0DurLFUFbxpKPnGe';

$responsta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$captcha}&remoteip={$ip}");


// $responsta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}&remoteip={$ip}");

$atributos = json_decode($responsta, TRUE);

if (!$atributos['success']) {
    ?>
    <p class="error_captcha">*Validar CAPTCHA</p>;
    <?php
    include("index1.html");
}
else{

//$conexion=mysqli_connect("localhost","root","","login");
include('conexiones/database.php');

$consulta_tesista = "SELECT id, Email FROM tesista WHERE Email='$usuario' AND Contraseña='$contraseña'";
$consulta_jurado = "SELECT id, Email FROM jurados WHERE Email='$usuario' AND Contraseña='$contraseña'";

$resultado_tesista = mysqli_query($mysqli, $consulta_tesista);
$resultado_jurado = mysqli_query($mysqli, $consulta_jurado);

$filas_tesista = mysqli_fetch_array($resultado_tesista);
$filas_jurado = mysqli_fetch_array($resultado_jurado);

if ($filas_tesista !== null) {
    // Restablecer el contador de intentos fallidos a 0 si el inicio de sesión como tesista es exitoso
    $_SESSION['contador_fallidos'] = 0;
    $_SESSION['id_usuario'] = $filas_tesista['id']; // Almacenar el ID del usuario en la variable de sesión
    header("Location: paginas/tesista/pagina_principal.php");
} elseif ($filas_jurado !== null) {
    // Restablecer el contador de intentos fallidos a 0 si el inicio de sesión como jurado es exitoso
    $_SESSION['contador_fallidos'] = 0;
    $_SESSION['id_usuario'] = $filas_jurado['id']; // Almacenar el ID del usuario en la variable de sesión
    header("Location: jurado.php");
} else {
    // Incrementar el contador de intentos fallidos
    $_SESSION['contador_fallidos']++;

    if ($_SESSION['contador_fallidos'] <= 1) {
        ?>
        <p class="error">*Error de usuario o contraseña</p>;
        <?php
        include("index1.html");
        // Mostrar un mensaje de error o redirigir al usuario según corresponda
    } else {
        ?>
        <p class="error1">*Error de usuario o contraseña</p>;
        <?php
        include("index1.html");
        // Mostrar un mensaje de error o redirigir al usuario según corresponda
    }
}

mysqli_free_result($resultado_tesista);
mysqli_free_result($resultado_jurado);
mysqli_close($mysqli);

}
?>