<?php
    include('../../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
    session_start();

    $UsNombre = $_POST['UsNombre'];
    $UsCorreo = $_POST['UsCorreo'];
    $UsComentario = $_POST['UsComentario'];

    $conexion = mysqli_connect("localhost", "root", "", "poli_informa");
    $sql = "INSERT INTO venqys(UsNombre, UsCorreo, UsComentario) VALUES('$UsNombre', '$UsCorreo', '$UsComentario')";
    $rta = mysqli_query($conexion, $sql);
    if (!$rta) {
        echo "No se inserto!";
    } 
    else{
        header("Location: ../ContactanosVista.php");
    }
?>