<?php
// Incluir el archivo de conexión a la base de datos
include "../../Conexion/conexion.php";
include "Horario.php";


$database = new Database();
$db = $database->connect();

$horario = new Horario($db);


// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesar los datos del formulario y actualizar el registro en la base de datos
    $id = $_POST['id'];
    $maestro = $_POST['maestro'];
    $nombre_laboratorio = $_POST['nombre_laboratorio'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $turno = $_POST['turno'];


    // Llamar a la función para editar el registro
    $horario->editarRegistro($id, $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno);
   
} else {
    // Mostrar el formulario de edición con los datos actuales del registro
    $id = $_GET['id'];
    $horario-> mostrarFormularioEdicion($id,$db);
}

// Cerrar conexión a la base de datos
mysqli_close($db);
?>


