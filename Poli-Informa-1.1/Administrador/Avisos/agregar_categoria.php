<?php
include('../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();
session_start();

if(isset($_POST['Agregar1'])){
    $nombre = $_POST['categoria'];
    $imagen = $_FILES['foto']['name'];

    $sql = "INSERT INTO avisos (categoria, foto) VALUES ('$nombre', '$imagen')";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/".$_FILES["foto"]["name"]);
        $_SESSION['success'] = true;
        header("location: vista_categoria.php");
    } else{
        $_SESSION['error'] = true;
        header("location: vista_categoria.php");
    }
}
?>