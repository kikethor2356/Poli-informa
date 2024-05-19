<?php
session_start();
if (!empty($_SESSION['CodeAlu'])) {
    $_SESSION['last_activity'] = time();
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>