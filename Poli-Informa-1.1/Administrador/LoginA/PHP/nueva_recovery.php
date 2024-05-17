<?php
session_start();
include('../../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if (isset($_COOKIE['recovery_token'])) {
    $token = $_COOKIE['recovery_token'];
    $sql = "SELECT * FROM registro WHERE recovery_token = ? AND token_expiration > NOW()";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];

        // Verificar si la nueva contraseña está en el historial
        $new_pass = $_POST['new_pass'];
        $hashed_new_pass = md5($new_pass);
        $password_history = $row['password_history'];
        $passwords = explode(',', $password_history);

        if (in_array($hashed_new_pass, $passwords)) {
            // La contraseña ya ha sido utilizada anteriormente
            header("Location: ../new_password.php?message=password_used");
            exit();
        }

        // Si la contraseña no ha sido utilizada anteriormente, actualizar la contraseña y el historial
        $passwords[] = $hashed_new_pass;
        $passwords = array_slice($passwords, -5);
        $new_password_history = implode(',', $passwords);

        // Actualizar la base de datos con la nueva contraseña y el historial
        $sql_update = "UPDATE registro SET AdPassword = ?, password_history = ?, recovery_token = NULL, token_expiration = NULL WHERE id = ?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("ssi", $hashed_new_pass, $new_password_history, $user_id);
        if ($stmt_update->execute()) {
            // Redirigir a la página de éxito
            header("Location: ../index.php?message=success_password");
            exit();
        } else {
            // Error al actualizar la contraseña
            header("Location: ../olvido.php?message=error");
            exit();
        }
    } else {
        // Token inválido
        header("Location: ../olvido.php?message=token_invalido");
        exit();
    }
} else {
    // Token no encontrado
    header("Location: ../olvido.php?message=token_invalido");
    exit();
}
?>
