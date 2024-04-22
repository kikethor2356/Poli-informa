<?php
session_start();

// Elimina solo las variables de sesión del cliente
unset($_SESSION['CodeAlu']);
unset($_SESSION['AluPassword']);

// Redirecciona a la página de inicio de sesión del cliente
header("Location: ../LoginU/index.php");
exit();
?>
