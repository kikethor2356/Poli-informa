<?php 

    session_start();
    if(empty($_SESSION['codigo'])){
        header("Location: index.php");
    }

    echo "Bienvenido "; 
    echo $_SESSION['codigo']; 

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <a href="controlador_cerrar_sesion.php">Cerrar sesión</a>


</body>
</html>