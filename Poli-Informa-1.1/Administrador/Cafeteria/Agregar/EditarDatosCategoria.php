<?php
include('../../../Conexion/conexion.php');
session_start();

if(isset($_POST['Editar1'])){

    $categoriaid = $_POST['categoria_id'];
    $categorianombre = $_POST['categoria_nombre'];
    
    $sql = "UPDATE categorias_cafeteria SET categoria_nombre = '$categorianombre' WHERE categoria_id = '$categoriaid'";
    $resultado = $conexion->query($sql);
    
    if($resultado){
        $_SESSION['success1'] = true;
        header("location: ../Categorias.php");
    } else {
        $_SESSION['error1'] = true;
        header("location: ../Categorias.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
}
?>