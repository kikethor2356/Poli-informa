<?php

include "../../Conexion/conexion.php";
include "../Horarios/Horario.php";


$database = new Database();
    $db = $database->connect();
        $horario = new Horario($db);

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $busqueda = $_POST['nombre_laboratorio'];
}


$horario->search($busqueda);


?>