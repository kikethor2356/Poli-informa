<?php
include('../../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['registro'])){

    $UsNombre = $_POST['UsNombre'];
    $UsCorreo = $_POST['UsCorreo'];
    $UsComentario = $_POST['UsComentario'];

    $sql = "INSERT INTO sugerencias (UsNombre, UsCorreo, UsComentario) VALUES ('$UsNombre', '$UsCorreo', '$UsComentario')";
    $resultado = $conexion -> query($sql);

    if($resultado == TRUE){
        $_SESSION['success'] = true;
        header("Location: ../ContactanosVista.php");
    } else{
        $_SESSION['error'] = true;
        echo "Datos NO insertados";
        header("Location: ../ContactanosVista.php");
    }
}
?>