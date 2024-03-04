<?php

include "ModelLaboratorios.php";

$laboratorio = new Laboratorio();

    $id = $_GET['id'];
    // Llama a la función con el ID del registro que deseas eliminar
    $laboratorio->eliminarRegistro($id); 
    // Reemplaza 123 con el ID del registro que deseas eliminar
    header('Location: ControllerCreate.php');

?>