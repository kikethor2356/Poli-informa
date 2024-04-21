<?php
    session_start();
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
    
    if(isset($_POST['btn_iniciar_sesion'])){
        $codigo = $_POST['AdCode'];
        $contraseña = $_POST['AdPassword'];
        $stmt = $conexion->prepare("SELECT * FROM registro WHERE AdCode=? AND AdPassword=?");
        $stmt->bind_param("ss", $codigo, $contraseña);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 1){
            $row = $result->fetch_assoc();
            $_SESSION['AdCode']=$row['AdCode'];
            $_SESSION['AdPassword']=$row['AdPassword'];
            header("Location: ../../Administrador/Avisos/vista_categoria.php");
        }else{
            header("Location: ../index.php?message=error");
        }//FIN IF-ELSE
    }//FIN IF
?> 