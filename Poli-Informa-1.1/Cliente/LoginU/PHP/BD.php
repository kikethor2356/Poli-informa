<?php
session_start();
include('../../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['btn_iniciar_sesion'])){
    $codigo = $_POST['CodeAlu'];
    $contraseña = $_POST['AluPassword'];

    $stmt = $conexion->prepare("SELECT * FROM registroalu WHERE CodeAlu=?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $row = $result->fetch_assoc();
        // Iniciar sesión como cliente y redirigir a la página principal del cliente
        if(password_verify($contraseña, $row['AluPassword'])){
            $_SESSION['CodeAlu'] = $row['CodeAlu'];
            header("Location: ../../../Cliente/Avisos/Avisos.php");
        } else{
            header("Location: ../index.php?message=error");
        }
    } else {
        // Si las credenciales son incorrectas, redirigir al usuario de vuelta a la página de inicio de sesión con un mensaje de error
        header("Location: ../index.php?message=error");
    }
}
?>
