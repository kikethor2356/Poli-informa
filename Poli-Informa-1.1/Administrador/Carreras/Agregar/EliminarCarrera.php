<?php
    include('../../../Conexion/conexion.php');
    session_start();
    $db = new Database();
    $conexion = $db->connect();

    $id = $_POST['eliminar_id'];

    $sql = "DELETE FROM carreras WHERE id ='$id' ";
    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
        $_SESSION['success2'] = true;
        header("location: ../Carreras.php");
    } else {
        // Si el registro no se elimina exitosamente
        $_SESSION['error2'] = true;
        header("location: ../Carreras.php");    
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
?>