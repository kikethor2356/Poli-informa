<?php
session_start();
include('../../../Conexion/conexion.php');
include('functions.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['btn_iniciar_sesion'])){
    $codigo = $_POST['AdCode'];
    $contraseña = $_POST['AdPassword'];
    $hashed_password = md5($contraseña);

    $login_status = handle_login_attempt($conexion, $codigo);

    if ($login_status['status'] === 'locked') {
        $time_left = gmdate("H:i:s", $login_status['time_left']);
        header("Location: ../index.php?message=locked_time&time_left=".$time_left."&unlock_time=".$login_status['unlock_time']);
        exit();
    }

    // Verificar si el usuario existe en la base de datos
    $stmt_check_user = $conexion->prepare("SELECT * FROM registro WHERE AdCode=?");
    $stmt_check_user->bind_param("s", $codigo);
    $stmt_check_user->execute();
    $result_check_user = $stmt_check_user->get_result();

    if($result_check_user->num_rows === 0) {
        // Si el usuario no está registrado, mostrar un mensaje de error personalizado
        header("Location: ../index.php?message=user_not_found");
        exit();
    }

    // Si el usuario existe, verificar la contraseña
    $stmt = $conexion->prepare("SELECT * FROM registro WHERE AdCode=? AND AdPassword=?");
    $stmt->bind_param("ss", $codigo, $hashed_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        $_SESSION['AdCode'] = $row['AdCode'];
        reset_login_attempts($conexion, $codigo);
        header("Location: ../../../Administrador/Avisos/AdminAvisos.php");
        exit();
    } else {
        increment_login_attempts($conexion, $codigo);
        
        // Obtener el número restante de intentos
        $remaining_attempts = 3 - $login_status['login_attempts']; // Cambia 3 al número máximo de intentos
        
        // Redirigir con el número restante de intentos como parámetro
        header("Location: ../index.php?message=error&remaining_attempts=" . $remaining_attempts);
        exit();
    }
}
?>