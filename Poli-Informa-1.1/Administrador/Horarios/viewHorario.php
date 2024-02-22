<?php
include "../../Conexion/conexion.php";
include "Horario.php";

  // Crear una instancia de la clase Database
  $database = new Database();
  $db = $database->connect();

  // Crear una instancia de la clase Horario
  $horario = new Horario($db);

  $horario->mostrarHorario();


?>