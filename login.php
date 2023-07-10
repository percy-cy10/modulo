<?php

    require_once 'conexiones/database.php';


    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    

    if ($usuario === 'admin' && $contrasena === 'admin123') {
        header('Location: paginas/pagina_principal.php');
        exit();
    } else {
        echo 'Usuario o contraseña incorrectos';
    }
    
?>
