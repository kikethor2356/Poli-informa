<?php

    //NOMBRE DEL SERVIDOR
    $server = "localhost";

    //NOMBRE DE USUARIO
    $user = "root";

    //CONTRASEÑA (NO TIENE)
    $pass = "";

    //B.D.
    $db = "polinova";

    //ESTABLECE LA CONEXIÓN
    $conexion = new mysqli($server, $user, $pass, $db);

    //MENSAJES EN CASO DE ERROR
    if($conexion->connect_errno){
        die("Conexion fallida" . $conexion->connect_errno);
    }else{

    }//FIN IF
    
?>