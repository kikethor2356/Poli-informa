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
    $turno = $_POST['turno'];
    $grupo = $_POST['grupo'];
    $carrera = $_POST['carrera'];

    // Crear una instancia de la clase Database
    $database = new Database();
    $db = $database->connect();

    // Crear una instancia de la clase Horario
    $horario = new Horario($db);

    // Establecer las variables del horario
    $horario->setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio, $turno, $grupo, $carrera);

    // Crear un nuevo horario
    if ($horario->create()) {

        $horario->obtenerHorario($nombre_laboratorio);
        $horario->mostrarHorario($nombre_laboratorio);

    } else {
        // Mostrar el horario existente
        $horario->mostrarHorario($nombre_laboratorio);
    ?>
        <!-- Formulario para crear un nuevo horario -->
       
<?php

    }
    mysqli_close($db);
}
?>