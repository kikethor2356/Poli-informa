<?php
include "../../Conexion/conexion.php";
include "Horario.php";

// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $maestro = $_POST['maestro'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $dias = $_POST['dias'];
    $nombre_laboratorio = $_POST['nombre_laboratorio'];

    // Crear una instancia de la clase Database
    $database = new Database();
    $db = $database->connect();

    // Crear una instancia de la clase Horario
    $horario = new Horario($db);
    // Obtener los horarios por laboratorio
/* 
    $horario->mostrarHorario(); */

    // Establecer las variables del horario
    $horario->setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio);

    // Crear un nuevo horario
    if ($horario->create($nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $dias)) {
        echo "Horario creado exitosamente.";
        header('Location: indexAdmin.php');
     
    } else {
        echo "Error al crear el horario.";

        echo "<a href='indexAdmin.php'>Regresar</a>";
    
    }
    mysqli_close($db);
}


