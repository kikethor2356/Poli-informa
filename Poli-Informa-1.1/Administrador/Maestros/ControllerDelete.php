<?php

include "ModelMaestros.php";
$maestro = new Maestro();

    $id = $_GET['id'];
    // Llama a la función con el ID del registro que deseas eliminar
    $maestro->eliminarRegistro($id); 
    // Reemplaza 123 con el ID del registro que deseas eliminar
    header('Location: ControllerCreate.php');

?>