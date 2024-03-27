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

    // Establecer las variables del horario
    $horario->setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio);

    // Crear un nuevo horario
    if ($horario->create($nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $dias)) {
       
        $horario->obtenerHorario($nombre_laboratorio);
        $horario->mostrarHorario($nombre_laboratorio);
?>
        <!-- Formulario para crear un nuevo horario -->
        <form action="ControllerCreate.php" method="post">
            <?php
            // Incluir funciones para mostrar opciones de maestros y laboratorios
            include "Componentes/ComboBoxMaestros.php";
            mostrarOpcionesMaestros($db);
            ?>
            <input type="hidden" name="nombre_laboratorio" value="<?php echo $nombre_laboratorio; ?>">
             <select name="hora_inicio" id="hora_inicio">
             <option value="7:00 am">7:00am</option>
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">11:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="13:00 pm">1:00pm</option>
        <option value="14:00 pm">2:00pm</option>
        <option value="15:00 pm">3:00pm</option>
        <option value="16:00 pm">4:00pm</option>
        <option value="17:00 pm">5:00pm</option>
        <option value="18:00 pm">6:00pm</option>
        <option value="19:00 pm">7:00pm</option>
        <option value="20:00 pm">8:00pm</option>
    </select>
   <select name="hora_fin" id="hora_fin">
   <option value="7:00 am">7:00am</option>
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">11:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="13:00 pm">1:00pm</option>
        <option value="14:00 pm">2:00pm</option>
        <option value="15:00 pm">3:00pm</option>
        <option value="16:00 pm">4:00pm</option>
        <option value="17:00 pm">5:00pm</option>
        <option value="18:00 pm">6:00pm</option>
        <option value="19:00 pm">7:00pm</option>
        <option value="20:00 pm">8:00pm</option>
   </select>
   <select name="dias" id="dia_semana">
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
        <option value="Sabado">Sabado</option>
   </select>
            <input type="submit" name="submit" value="Guardar">
        </form>
<?php
    } else {
        // Mostrar el horario existente
        $horario->mostrarHorario($nombre_laboratorio);
        echo "<a href='indexAdmin.php'>Regresar</a>";
        ?>
     <!-- Formulario para crear un nuevo horario -->
     <form action="ControllerCreate.php" method="post">
            <?php
            // Incluir funciones para mostrar opciones de maestros y laboratorios
            include "Componentes/ComboBoxMaestros.php";
            mostrarOpcionesMaestros($db);
            ?>
            <input type="hidden" name="nombre_laboratorio" value="<?php echo $nombre_laboratorio; ?>">

           <select name="hora_inicio" id="hora_inicio">
           <option value="7:00 am">7:00am</option>
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">11:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="13:00 pm">1:00pm</option>
        <option value="14:00 pm">2:00pm</option>
        <option value="15:00 pm">3:00pm</option>
        <option value="16:00 pm">4:00pm</option>
        <option value="17:00 pm">5:00pm</option>
        <option value="18:00 pm">6:00pm</option>
        <option value="19:00 pm">7:00pm</option>
        <option value="20:00 pm">8:00pm</option>
    </select>
   <select name="hora_fin" id="hora_fin">
   <option value="7:00 am">7:00am</option>
        <option value="8:00 am">8:00am</option>
        <option value="9:00 am">9:00am</option>
        <option value="10:00 am">10:00am</option>
        <option value="11:00 am">11:00am</option>
        <option value="12:00 pm">12:00pm</option>
        <option value="13:00 pm">1:00pm</option>
        <option value="14:00 pm">2:00pm</option>
        <option value="15:00 pm">3:00pm</option>
        <option value="16:00 pm">4:00pm</option>
        <option value="17:00 pm">5:00pm</option>
        <option value="18:00 pm">6:00pm</option>
        <option value="19:00 pm">7:00pm</option>
        <option value="20:00 pm">8:00pm</option>
   </select>
   <select name="dias" id="dia_semana">
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miercoles">Miercoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Lunes">Viernes</option>
        <option value="Lunes">Sabado</option>
   </select>
            <input type="submit" name="submit" value="Guardar">
        </form>

        <?php

    }
    mysqli_close($db);
}
?>
