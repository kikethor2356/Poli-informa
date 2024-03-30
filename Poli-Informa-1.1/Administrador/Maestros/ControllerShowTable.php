<?php

include '../Maestros/Maestro.php';

// Después del envío del formulario, obtén la lista de maestros
$maestro = new Maestro();
/* $maestro->MostrarMaestros(); */
$maestro->MostrarMaestrosTabla();


?>