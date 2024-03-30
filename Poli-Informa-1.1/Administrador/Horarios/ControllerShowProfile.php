<?php

include "Horario.php";
include "../../Conexion/conexion.php";

$database = new Database();
$db = $database->connect();

$horario = new Horario($db);

// Verificar si se ha proporcionado un ID de maestro en la URL
if(isset($_GET['nombre'])) {
    // Obtener el ID del maestro desde la URL
    $maestro = $_GET['nombre'];

    // Llamar al método PerfilMaestros() con el ID del maestro
    $horario->PerfilMaestros($maestro, $db);
} else {
    echo "No se proporcionó un nombre de maestro.";
}

?>