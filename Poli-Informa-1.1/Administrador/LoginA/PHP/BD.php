<?php
session_start();
include('../../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['btn_iniciar_sesion'])){
    // Verificar las credenciales del administrador
    $codigo = $_POST['AdCode'];
    $contraseña = $_POST['AdPassword'];
        
    $stmt = $conexion->prepare("SELECT * FROM registro WHERE AdCode=?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        // Verificar si la contraseña ingresada coincide con el hash almacenado en la base de datos
        if(password_verify($contraseña, $row['AdPassword'])){
            // Iniciar sesión como administrador y redirigir a la página principal del administrador
            $_SESSION['AdCode'] = $row['AdCode'];
            header("Location: ../../../Administrador/Avisos/AdminAvisos.php");
        } else {
            // Contraseña incorrecta, redirigir al usuario a la página de inicio de sesión con un mensaje de error
            header("Location: ../index.php?message=error");
        }
    } else {
        // Si no se encuentra un usuario con el código proporcionado, redirigir al usuario a la página de inicio de sesión con un mensaje de error
        header("Location: ../index.php?message=error");
    }
}
?>