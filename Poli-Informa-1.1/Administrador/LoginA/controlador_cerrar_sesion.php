<?php
session_start();

// Elimina solo las variables de sesión del administrador
unset($_SESSION['AdCode']);
unset($_SESSION['AdPassword']);

// Redirecciona a la página de inicio de sesión del administrador
header("Location: ../LoginA/index.php");
exit();
?>
