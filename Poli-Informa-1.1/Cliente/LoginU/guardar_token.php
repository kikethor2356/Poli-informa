<?php
session_start();
include('../../Conexion/conexion.php');
include('PHP/functions.php');  // Incluir el archivo de funciones
$db = new Database();
$conexion = $db->connect();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    // Verificar el token y la fecha de expiración
    $sql = "SELECT * FROM registroalu WHERE recovery_token = ? AND token_expiration > NOW()";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        setcookie("recovery_token", $token, time() + 3600, "/"); // 1 hora de duración
        header("Location: new_password.php");
    } else {
        // Manejar intentos de recuperación de contraseña
        $codigo = $_SESSION['CodeAlu'];
        $hashed_password = md5($_SESSION['AluPassword']);
        $login_status = handle_login_attempt($conexion, $codigo);
        if ($login_status['status'] === 'locked') {
            header("Location: olvido.php?message=locked_out&time_left=".$login_status['time_left']);
            exit();
        }

        increment_login_attempts($conexion, $codigo);
        header("Location: olvido.php?message=token_invalido");
    }
} else {
    header("Location: olvido.php?message=token_invalido");
}
?>