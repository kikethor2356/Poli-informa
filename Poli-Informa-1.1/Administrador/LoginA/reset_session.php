<?php
session_start();
if (!empty($_SESSION['AdCode'])) {
    $_SESSION['last_activity'] = time();
    $_SESSION['sessionContinued'] = true; // Marcar que se ha permitido continuar con la sesión
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
