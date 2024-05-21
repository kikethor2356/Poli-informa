<?php
include('../../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['Agregar1'])){
    $carrera = $_POST['carrera'];
    $carreranombre = $_POST['carrera_inicial'];

    $sql = "INSERT INTO carreras(carrera, carrera_inicial) VALUES ('$carrera', '$carreranombre')";
    $resultado = $conexion -> query($sql);

    if($resultado == TRUE){
        $_SESSION['success'] = true;
        header("location: ../Carreras.php");
    } else{
        $_SESSION['error'] = true;
        echo "Datos NO insertados";
        header("location: ../Carreras.php");
    }
}
?>