<?php
session_start();
include('../../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['btn_iniciar_sesion'])){
    $codigo = $_POST['CodeAlu'];
    $contraseña = $_POST['AluPassword'];

    // Verificar si el usuario está intentando iniciar sesión como administrador
    $login_as_admin = isset($_POST['login_as_admin']) ? true : false;

    if($login_as_admin) {
        // Verificar las credenciales del administrador
        $codigo = $_POST['AdCode'];
        $contraseña = $_POST['AdPassword'];
        $stmt = $conexion->prepare("SELECT * FROM registro WHERE AdCode=? AND AdPassword=?");
    } else {
        // Verificar las credenciales del cliente
        $stmt = $conexion->prepare("SELECT * FROM registroalu WHERE CodeAlu=? AND AluPassword=?");
    }

    $stmt->bind_param("ss", $codigo, $contraseña);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        if($login_as_admin) {
            // Iniciar sesión como administrador y redirigir a la página principal del administrador
            $_SESSION['AdCode'] = $row['AdCode'];
            $_SESSION['AdPassword'] = $row['AdPassword'];
            header("Location: ../../../../../Administrador/Avisos/vista_categoria.php");
        } else {
            // Iniciar sesión como cliente y redirigir a la página principal del cliente
            $_SESSION['CodeAlu'] = $row['CodeAlu'];
            $_SESSION['AluPassword'] = $row['AluPassword'];
            header("Location: ../../../Cliente/Avisos/Avisos.php");
        }
    } else {
        // Si las credenciales son incorrectas, redirigir al usuario de vuelta a la página de inicio de sesión con un mensaje de error
        header("Location: ../index.php?message=error");
    }
}
?>
