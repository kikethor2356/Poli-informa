<?php
require_once 'ModelLaboratorios.php';
$laboratorio = new Laboratorio();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre_laboratorio'];

    // Crear una instancia de la clase Maestro y llamar al método crearMaestro
    $laboratorio->crearLaboratorio($nombre);

}

header('Location: ControllerShowTable.php');


?>
