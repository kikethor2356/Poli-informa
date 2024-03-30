<?php
include "../../Conexion/conexion.php";
include "Horario.php";
$database = new Database();
$db = $database->connect();
$horario = new Horario($db);

// Verificar si se ha pasado el ID del registro en la URL



if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Llamar al método eliminarRegistro() y mostrar el resultado
    echo $horario->eliminarRegistro($id);
    
} else {
    echo "ID de registro no proporcionado";
}
?>
