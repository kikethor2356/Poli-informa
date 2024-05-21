<?php
include('../../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['Editar1'])){

    $id = $_POST['id'];
    $carrera = $_POST['carrera'];
    $carreranombre = $_POST['carrera_inicial'];
    
    $sql = "UPDATE carreras SET carrera = '$carrera', carrera_inicial = '$carreranombre' WHERE id = '$id'";
    $resultado = $conexion->query($sql);
    
    if($resultado){
        $_SESSION['success1'] = true;
        header("location: ../Carreras.php");
    } else {
        $_SESSION['error1'] = true;
        header("location: ../Carreras.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
}
?>