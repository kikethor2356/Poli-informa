<?php
include('../../../Conexion/conexion.php');
session_start();

if(isset($_POST['Agregar1'])){
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen']['name'];
    $categoria = $_POST['categoria_nombre'];

    $sql = "INSERT INTO cafeteriamodulo_a (nombre_producto, descripcion, precio, imagen, prodcategoria_id) VALUES ('$nombre', '$descripcion', '$precio', '$imagen', '$categoria')";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "temp/".$_FILES["imagen"]["name"]);
        $_SESSION['success'] = true;
        header("location: ../AdminCafeteria1.php");
    } else{
        $_SESSION['error'] = true;
        header("location: ../AdminCafeteria1.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
}
?>
