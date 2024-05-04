<?php
include('../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['Agregar1'])){
    $informacion = $_POST['informacion'];
    $imagen = $_FILES['foto']['name'];

    $sql = "INSERT INTO avisos (informacion, foto) VALUES ('$informacion', '$imagen')";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/".$_FILES["foto"]["name"]);
        $_SESSION['success'] = true;
        header("location: AdminAvisos.php");
    } else{
        $_SESSION['error'] = true;
        header("location: AdminAvisos.php");
    }
}
?>