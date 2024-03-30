<?php

    //NOMBRE DEL SERVIDOR
    $server = "localhost";

    //NOMBRE DE USUARIO
    $user = "root";

    //CONTRASEÑA (NO TIENE)
    $pass = "";

    //B.D.
    $db = "poli_informa";

    //ESTABLECE LA CONEXIÓN
    $conexion = new mysqli($server, $user, $pass, $db);

    //MENSAJES EN CASO DE ERROR
    if($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error);
    }else{

    }//FIN IF
    
?>