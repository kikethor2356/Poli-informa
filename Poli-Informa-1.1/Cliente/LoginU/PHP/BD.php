<?php
session_start();
include('../../../Conexion/conexion.php');
include('functions.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['btn_iniciar_sesion'])){
    $codigo = $_POST['CodeAlu'];
    $contraseña = $_POST['AluPassword'];
    $hashed_password = md5($contraseña);

    $login_status = handle_login_attempt($conexion, $codigo);

    if ($login_status['status'] === 'locked') {
        header("Location: ../index.php?message=locked_out&time_left=".$login_status['time_left']);
        exit();
    }

    if ($login_status['status'] === 'locked_time') {
        header("Location: ../index.php?message=locked_time&time_left=".$login_status['time_left']);
        exit();
    }

    $stmt = $conexion->prepare("SELECT * FROM registroalu WHERE CodeAlu=? AND AluPassword=?");
    $stmt->bind_param("ss", $codigo, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $_SESSION['CodeAlu'] = $row['CodeAlu'];
        reset_login_attempts($conexion, $codigo);
        header("Location: ../../../Administrador/Avisos/AdminAvisos.php");
        exit();
    } else {
        increment_login_attempts($conexion, $codigo);
        header("Location: ../index.php?message=error");
        exit();
    }
}
?>