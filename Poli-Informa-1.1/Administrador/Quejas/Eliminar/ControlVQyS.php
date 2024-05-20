<?php
    include('../../../Conexion/conexion.php');
    session_start();
    $db = new Database();
    $conexion = $db->connect();

    $id = $_POST['eliminar_id'];

    $sql = "DELETE FROM sugerencias WHERE id ='$id' ";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        $_SESSION['success'] = true;
        header("location: ../Sugerencias.php");
    } else {
        // Si el registro no se elimina exitosamente
        $_SESSION['error'] = true;
        header("location: ../Sugerencias.php");    
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
?>