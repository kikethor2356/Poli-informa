<?php
date_default_timezone_set('America/Mexico_City'); // Ajusta según tu zona horaria

function handle_login_attempt($conexion, $codigo) {
    $stmt = $conexion->prepare("SELECT login_attempts, last_attempt, unlock_time FROM registroalu WHERE CodeAlu=?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login_attempts = $row['login_attempts'];
        $last_attempt = strtotime($row['last_attempt']);
        $current_time = time();
        $lockout_time = 15 * 60; // 15 minutos de bloqueo

        if ($login_attempts >= 3) { // 3 intentos para que en el tercero se le avise
            $unlock_time = strtotime($row['unlock_time']);
            if ($current_time < $unlock_time) {
                return [
                    'status' => 'locked', 
                    'time_left' => $unlock_time - $current_time, 
                    'unlock_time' => date('H:i:s', $unlock_time) // Mostrar solo la hora
                ];
            } else {
                reset_login_attempts($conexion, $codigo);
                return ['status' => 'ok'];
            }
        }
        return ['status' => 'ok', 'login_attempts' => $login_attempts];
    }
    return ['status' => 'error'];
}

function increment_login_attempts($conexion, $codigo) {
    $stmt = $conexion->prepare("SELECT login_attempts FROM registroalu WHERE CodeAlu = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $login_attempts = $row['login_attempts'] + 1;
        $unlock_time = null;
        if ($login_attempts >= 3) { // 3 intentos para que en el tercero se le avise
            $unlock_time = date('Y-m-d H:i:s', time() + 15 * 60); // 15 minutos
        }

        $stmt = $conexion->prepare("UPDATE registroalu SET login_attempts = ?, last_attempt = NOW(), unlock_time = ? WHERE CodeAlu = ?");
        $stmt->bind_param("iss", $login_attempts, $unlock_time, $codigo);
        $stmt->execute();
    }
}

function reset_login_attempts($conexion, $codigo) {
    $stmt = $conexion->prepare("UPDATE registroalu SET login_attempts = 0, last_attempt = NULL, unlock_time = NULL WHERE CodeAlu = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
}
?>