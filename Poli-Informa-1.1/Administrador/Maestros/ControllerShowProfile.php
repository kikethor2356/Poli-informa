<?php

include "Maestro.php";

// Verificar si se ha proporcionado un ID de maestro en la URL
if(isset($_GET['id'])) {
    // Obtener el ID del maestro desde la URL
    $id = $_GET['id'];

    // Crear una instancia de tu clase
    $maestro = new Maestro();
    $database = new Database();
    $db = $database->connect();

    // Llamar al método PerfilMaestros() con el ID del maestro
    $maestro->PerfilMaestros($id,$db);
} else {
    echo "No se proporcionó un ID de maestro.";
}
?>