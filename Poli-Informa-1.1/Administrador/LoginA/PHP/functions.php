<?php
function handle_login_attempt($conexion, $codigo) {
    $stmt = $conexion->prepare("SELECT login_attempts, last_attempt FROM registro WHERE AdCode=?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        if (!empty($row['login_attempts']) && !empty($row['last_attempt'])) {
            $login_attempts = $row['login_attempts'];
            $last_attempt = strtotime($row['last_attempt']);
            $current_time = time();
            $lockout_time = 15 * 60; // 15 minutos de bloqueo

            if ($login_attempts >= 3 && ($current_time - $last_attempt) < $lockout_time) {
                return ['status' => 'locked', 'time_left' => $lockout_time - ($current_time - $last_attempt)];
            }

            if ($login_attempts >= 3 && ($current_time - $last_attempt) >= $lockout_time) {
                return ['status' => 'locked_time', 'time_left' => 0];
            }

            return ['status' => 'ok', 'login_attempts' => $login_attempts, 'last_attempt' => $last_attempt];
        }
    }

    return ['status' => 'error'];
}

function increment_login_attempts($conexion, $codigo) {
    $stmt = $conexion->prepare("UPDATE registro SET login_attempts = login_attempts + 1, last_attempt = NOW() WHERE AdCode = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
}

function reset_login_attempts($conexion, $codigo) {
    $stmt = $conexion->prepare("UPDATE registro SET login_attempts = 0, last_attempt = NULL WHERE AdCode = ?");
    $stmt->bind_param("s", $codigo);
    $stmt->execute();
}
?>