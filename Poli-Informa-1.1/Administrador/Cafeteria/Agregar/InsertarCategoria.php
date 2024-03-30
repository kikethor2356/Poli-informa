<?php
include('../../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['Agregar1'])){
    $categorianombre = $_POST['categoria_nombre'];

    $sql = "INSERT INTO categorias_cafeteria(categoria_nombre) VALUES ('$categorianombre')";
    $resultado = $conexion -> query($sql);

    if($resultado == TRUE){
        $_SESSION['success'] = true;
        header("location: ../Categorias.php");
    } else{
        $_SESSION['error'] = true;
        echo "Datos NO insertados";
        header("location: ../Categorias.php");
    }
}
?>