<?php
include "../../Conexion/conexion.php";
include "../Horarios/Horario.php";
include "../Horarios/Componentes/ComboBoxMaestros.php"; 
$database = new Database();
$db = $database->connect();
$horario = new Horario($db);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $busqueda = $_POST['nombre_laboratorio'];
    $horario->searchCliente($busqueda); // Llama a la función del controlador
    die(); // Detiene la ejecución del script después de procesar la búsqueda
}
?>
