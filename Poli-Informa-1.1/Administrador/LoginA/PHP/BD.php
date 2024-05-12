<?php
session_start();
include('../../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['btn_iniciar_sesion'])){
    $codigo = $_POST['AdCode'];
    $contraseña = $_POST['AdPassword'];

    $stmt = $conexion->prepare("SELECT * FROM registro WHERE AdCode=?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        // Iniciar sesión como cliente y redirigir a la página principal del cliente
        if(password_verify($contraseña, $row['AdPassword'])){
            $_SESSION['AdCode'] = $row['AdCode'];
            header("Location: ../../../Administrador/Avisos/AdminAvisos.php");
        } else{
            header("Location: ../index.php?message=error");
        }
    } else {
        // Si las credenciales son incorrectas, redirigir al usuario de vuelta a la página de inicio de sesión con un mensaje de error
        header("Location: ../index.php?message=error");
    }
}
?>
