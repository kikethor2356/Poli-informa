<?php
    include "../../Conexion/conexion.php";
    include "../Horarios/ModelHorario.php";
// Verificar si se han enviado datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $maestro_id = $_POST['maestro_id'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $dia_semana = $_POST['dia_semana'];

    // Crear una instancia de la clase Database
    $database = new Database();
    $db = $database->connect();

    // Crear una instancia de la clase Horario
    $horario = new Horario($db);

    // Establecer las variables del horario
    $horario->setHorario($maestro_id, $hora_inicio, $hora_fin, $dia_semana);

    // Crear un nuevo horario
    if ($horario->create($maestro_id, $hora_inicio, $hora_fin, $dia_semana)) {
        echo "Horario creado exitosamente.";
    } else {
        echo "Error al crear el horario.";
    }


   
    $horarioModelo = new Horario($db);
    $horario = $horarioModelo->show();
    
    

    
    
}
?>