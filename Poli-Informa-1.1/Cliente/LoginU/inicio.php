Porque según yo lo mande de esta manera
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
    // Verificar si no hay una sesión activa
    if(empty($_SESSION['CodeAlu'])){
        // Redireccionar a la página de inicio de sesión si no hay sesión activa
        header("Location: ../LoginU/index.php");
        exit();
    } elseif (basename($_SERVER['PHP_SELF']) === 'inicio.php') {
        // Si el usuario intenta acceder directamente a este archivo, cerrar la sesión y redireccionar al inicio de sesión
        session_destroy();
        header("Location: ../LoginU/index.php");
        exit();
    }
}
?>