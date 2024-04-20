<?php
    session_start();
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
    
    if(isset($_POST['btn_iniciar_sesion'])){
        $codigo = $_POST['codigo'];
        $contraseña = $_POST['contraseña'];
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE codigo=? AND contraseña=?");
        $stmt->bind_param("ss", $codigo, $contraseña);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows === 1){
            $row = $result->fetch_assoc();
            $_SESSION['codigo']=$row['codigo'];
            $_SESSION['contraseña']=$row['contraseña'];
            header("Location: ../../Cliente/Avisos/Avisos.php?codigo=" . $_SESSION['codigo'] . "&nombre=" . $_SESSION['nombre']);
        }else{
            header("Location: ../index.php");
        }//FIN IF-ELSE
    }//FIN IF
?>