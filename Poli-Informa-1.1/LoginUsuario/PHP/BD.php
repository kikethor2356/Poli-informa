<?php
    session_start();
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
    
    if(isset($_POST['btn_iniciar_sesion'])){
        $codigo = $_POST['CodeAlu'];
        $contraseña = $_POST['AluPassword'];
        $stmt = $conexion->prepare("SELECT * FROM registroalu WHERE CodeAlu=? AND AluPassword=?");
        $stmt->bind_param("ss", $codigo, $contraseña);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 1){
            $row = $result->fetch_assoc();
            $_SESSION['CodeAlu']=$row['CodeAlu'];
            $_SESSION['AluPassword']=$row['AluPassword'];
            header("Location: ../../Cliente/Avisos/Avisos.php");
        }else{
            header("Location: ../index.php?message=error");
        }//FIN IF-ELSE
    }//FIN IF
?> 