<?php
    session_start();
    include('../../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
        
    $id = $_POST['id'];
    $pass = $_POST['new_pass'];

    $sql = "UPDATE registroalu SET AluPassword = '$pass', recovery_token = NULL, token_expiration = NULL WHERE id = $id";
    $conexion->query($sql);

    header("Location: ../index.php?message=success_password");
?>