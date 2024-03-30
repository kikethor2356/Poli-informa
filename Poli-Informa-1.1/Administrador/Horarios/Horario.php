<?php


class Horario
{
    private $conn;
    private $table = 'horarios';
    private $maestro;
    private $hora_inicio;
    private $hora_fin;
    private $dias;
    private $nombre_laboratorio;
    private $turno;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para establecer las variables del horario
    public function setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio, $turno)
    {
        $this->maestro = $maestro;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->dias = $dias;
        $this->nombre_laboratorio = $nombre_laboratorio;
        $this->turno = $turno;
    }

    public function create()
    {
        // Verificar si hay un registro con el mismo nombre de laboratorio, hora de inicio, hora de fin y día
        $query_check = "SELECT * FROM " . $this->table . " WHERE nombre_laboratorio = ? AND hora_inicio = ? AND hora_fin = ? AND dias = ?";
        $stmt_check = $this->conn->prepare($query_check);
        $stmt_check->bind_param('ssss', $this->nombre_laboratorio, $this->hora_inicio, $this->hora_fin, $this->dias);
        $stmt_check->execute();
        $result = $stmt_check->get_result();

        if ($result->num_rows > 0) {
            // Si se encontró un registro, enviar un mensaje al cliente para mostrar la alerta
            echo "<script>alert('Ya existe esa clase');</script>";
            return false;
        }

        // Si no se encontró ningún registro, proceder con la inserción
        $query_insert = 'INSERT INTO ' . $this->table . ' (maestro, nombre_laboratorio, hora_inicio, hora_fin, dias, turno) VALUES (?, ?, ?, ?, ?, ?)';
        $stmt_insert = $this->conn->prepare($query_insert);
        $stmt_insert->bind_param('ssssss', $this->maestro, $this->nombre_laboratorio, $this->hora_inicio, $this->hora_fin, $this->dias, $this->turno);

        if ($stmt_insert->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt_insert->error);

        return false;
    }



    public function obtenerHorario($nombre_laboratorio)
    {
        $query = "SELECT id, dias, hora_inicio, hora_fin, maestro FROM $this->table WHERE nombre_laboratorio = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('s', $nombre_laboratorio);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $horario = array(
            'Lunes' => array(),
            'Martes' => array(),
            'Miercoles' => array(),
            'Jueves' => array(),
            'Viernes' => array(),
            'Sabado' => array(),
        );

        while ($fila = $resultado->fetch_assoc()) {
            $id = $fila['id'];
            $dias = $fila['dias'];
            $hora_inicio = $fila['hora_inicio'];
            $hora_fin = $fila['hora_fin'];
            $maestro = $fila['maestro'];

            // Agregar el horario al día correspondiente
            if (isset($horario[$dias])) {
                $horario[$dias][] = array('id' => $id, 'hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin, 'maestro' => $maestro);
            } else {
                // Si el día no está configurado correctamente, mostrar un mensaje de error
                echo "Error: Día inválido: $dias";
            }
        }

        return array('nombre_laboratorio' => $nombre_laboratorio, 'horario' => $horario);
    }

    public function mostrarHorario($nombre_laboratorio)
    {
        $datos_horario = $this->obtenerHorario($nombre_laboratorio);
        $nombre_laboratorio = $datos_horario['nombre_laboratorio'];
        $horario = $datos_horario['horario'];

        // Crear la tabla de horarios
        echo "<h1>$nombre_laboratorio</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Horario</th>";
        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
            echo "<th>$dia</th>";
        }
        echo "</tr>";

        // Generar las filas de la tabla
        for ($i = 7; $i < 20; $i++) {
            echo "<tr>";
            $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
            $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
            echo "<td>$hora_inicio - $hora_fin</td>";

            foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                echo "<td>";
                if (isset($horario[$dia])) {
                    foreach ($horario[$dia] as $hora) {
                        if ($i >= (float)$hora['hora_inicio'] && $i <= (float)$hora['hora_fin'] - 1) {
                            echo '<a href="ControllerShowProfile.php?nombre=' . $hora["maestro"] . '">' . $hora["maestro"] . '</a>';
                            echo " <a href='ControllerEdit.php?id=" . $hora['id'] . "'>Editar</a>";
                            echo " <a href='ControllerDelete.php?id=" . $hora['id'] . "'>Eliminar</a>";
                        }
                    }
                }
                echo "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }

    public function PerfilMaestros($maestro, $db)
    {
        // Preparar la consulta SQL para seleccionar un maestro basado en su ID
        $sql = "SELECT * FROM maestros WHERE nombre = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $maestro);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtener el perfil del maestro
            $row = $result->fetch_assoc();
            echo "Nombre: " . $row["Nombre"] . " - Apellidos: " . $row["Apellidos"] . " - Código: " . $row["Codigo"] . " - Correo: " . $row["Correo"] . "<br>";
            echo '<img src="../Maestros/ImgCroquis/' . $row["Imagen_croquis"] . '" alt="Imagen de Maestro">';
        } else {
            echo "No se encontró ningún maestro con ese nombre.";
        }

        $stmt->close();
    }



    function search($busqueda)
    {
        // Consulta SQL para buscar en la base de datos
        $sql = "SELECT * FROM $this->table WHERE nombre_laboratorio LIKE '%$busqueda%'";
        $resultado = $this->conn->query($sql);
        $datos_horario = $this->obtenerHorario($busqueda);
        $nombre_laboratorio = $datos_horario['nombre_laboratorio'];
        $horario = $datos_horario['horario'];

        // Crear la tabla de horarios
        echo "<h1>$nombre_laboratorio</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Horario</th>";
        foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
            echo "<th>$dia</th>";
        }
        echo "</tr>";

        // Generar las filas de la tabla
        for ($i = 7; $i < 20; $i++) {
            echo "<tr>";
            $hora_inicio = str_pad($i, 2, "0", STR_PAD_LEFT) . ":00";
            $hora_fin = str_pad(($i + 1), 2, "0", STR_PAD_LEFT) . ":00";
            echo "<td>$hora_inicio - $hora_fin</td>";

            foreach (['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'] as $dia) {
                echo "<td>";
                if (isset($horario[$dia])) {
                    foreach ($horario[$dia] as $hora) {
                        if ($i >= (int)$hora['hora_inicio'] && $i <=  (int)$hora['hora_fin'] - 1) {
                            echo '<a href="ControllerShowProfile.php?nombre=' . $hora["maestro"] . '">' . $hora["maestro"] . '</a>';
                            echo " <a href='ControllerEdit.php?id=" . $hora['id'] . "'>Editar</a>";
                            echo " <a href='ControllerDelete.php?id=" . $hora['id'] . "'>Eliminar</a>";
                        }
                    }
                }
                echo "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";

        $database = new Database();
        $db = $database->connect();

?>
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
            <select name="turno" id="turno">
                <option value="Matutino">Matutino</option>
                <option value="Vespertino">Vespertino</option>
            </select>
            <input type="submit" name="submit" value="Guardar">
        </form>
        <?php

    }


    function editarRegistro($id, $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno)
    {
        $database = new Database();
        $db = $database->connect();

        // Crear una instancia de la clase Horario
        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE $this->table SET nombre_laboratorio=?, maestro=?, hora_inicio=?, hora_fin=?, turno=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssss', $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $turno, $id);

        if ($stmt->execute()) {
            // Actualizar el horario después de editar el registro
            $this->obtenerHorario($nombre_laboratorio);
            // Mostrar el horario actualizado después de editar el registro
            $this->mostrarHorario($nombre_laboratorio);
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
                <select name="turno" id="turno">
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
                <input type="submit" name="submit" value="Guardar">
            </form>
        <?php
            return "Registro actualizado correctamente";
        } else {
            return "Error al actualizar el registro: " . $this->conn->error;
        }
    }


    function mostrarFormularioEdicion($id, $db)
    {
        // Consulta SQL para obtener los datos del registro
        $sql = "SELECT * FROM $this->table WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Mostrar el formulario de edición con los datos actuales del registro
            $fila = $resultado->fetch_assoc();
        ?>
            <h2>Editando a <?php echo $fila['maestro'] ?></h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <?php
                include "../Horarios/Componentes/Selectes.php";
                echo "<label for='maestro'>Maestro:</label> <br>";
                mostrarOpcionesMaestrosEdicion($db, $fila['maestro']);
                echo " <br><br><label for='nombre_laboratorio'>Nombre laboratorio:</label> <br>";
                mostrarOpcionesLaboratoriosEdicion($db, $fila['nombre_laboratorio']);
                ?>
                <br><br><label for="hora_inicio">Hora de inicio:</label>
                <select name="hora_inicio">
                    <option value="7:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '7:00 am' ? 'selected' : ''; ?>>7:00 am</option>
                    <option value="8:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '8:00 am' ? 'selected' : ''; ?>>8:00 am</option>
                    <option value="9:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '9:00 am' ? 'selected' : ''; ?>>9:00 am</option>
                    <option value="10:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '10:00 am' ? 'selected' : ''; ?>>10:00 am</option>
                    <option value="11:00 am" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '11:00 am' ? 'selected' : ''; ?>>11:00 am</option>
                    <option value="12:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '12:00 pm' ? 'selected' : ''; ?>>12:00 pm</option>
                    <option value="13:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '13:00 pm' ? 'selected' : ''; ?>>1:00 pm</option>
                    <option value="14:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '14:00 pm' ? 'selected' : ''; ?>>2:00 pm</option>
                    <option value="15:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '15:00 pm' ? 'selected' : ''; ?>>3:00 pm</option>
                    <option value="16:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '16:00 pm' ? 'selected' : ''; ?>>4:00 pm</option>
                    <option value="17:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '17:00 pm' ? 'selected' : ''; ?>>5:00 pm</option>
                    <option value="18:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '18:00 pm' ? 'selected' : ''; ?>>6:00 pm</option>
                    <option value="19:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '19:00 pm' ? 'selected' : ''; ?>>7:00 pm</option>
                    <option value="20:00 pm" <?php echo isset($fila['hora_inicio']) && $fila['hora_inicio'] == '20:00 pm' ? 'selected' : ''; ?>>8:00 pm</option>



                    <!-- Agrega más opciones según sea necesario -->
                </select><br><br>
                <label for="hora_fin">Hora de fin:</label>
                <select name="hora_fin">
                    <option value="7:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '7:00 am' ? 'selected' : ''; ?>>7:00 am</option>
                    <option value="8:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '8:00 am' ? 'selected' : ''; ?>>8:00 am</option>
                    <option value="9:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '9:00 am' ? 'selected' : ''; ?>>9:00 am</option>
                    <option value="10:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '10:00 am' ? 'selected' : ''; ?>>10:00 am</option>
                    <option value="11:00 am" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '11:00 am' ? 'selected' : ''; ?>>11:00 am</option>
                    <option value="12:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '12:00 pm' ? 'selected' : ''; ?>>12:00 pm</option>
                    <option value="13:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '13:00 pm' ? 'selected' : ''; ?>>1:00 pm</option>
                    <option value="14:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '14:00 pm' ? 'selected' : ''; ?>>2:00 pm</option>
                    <option value="15:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '15:00 pm' ? 'selected' : ''; ?>>3:00 pm</option>
                    <option value="16:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '16:00 pm' ? 'selected' : ''; ?>>4:00 pm</option>
                    <option value="17:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '17:00 pm' ? 'selected' : ''; ?>>5:00 pm</option>
                    <option value="18:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '18:00 pm' ? 'selected' : ''; ?>>6:00 pm</option>
                    <option value="19:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '19:00 pm' ? 'selected' : ''; ?>>7:00 pm</option>
                    <option value="20:00 pm" <?php echo isset($fila['hora_fin']) && $fila['hora_fin'] == '20:00 pm' ? 'selected' : ''; ?>>8:00 pm</option>
                    <!-- Agrega más opciones según sea necesario -->
                </select><br><br>

                <select name="turno" id="turno">
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
                <br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
<?php
        } else {
            echo "No se encontró ningún registro con el ID proporcionado";
        }
    }

    public function eliminarRegistro($id)
    {
        $database = new Database();
        $db = $database->connect();

        // Consulta SQL para eliminar el registro de la base de datos
        $sql = "DELETE FROM $this->table WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            // Si se eliminó correctamente, retornamos un mensaje de éxito
            echo "Registro eliminado correctamente";
            header('Location:indexAdmin.php');
        } else {
            // Si hubo un error al eliminar, retornamos un mensaje de error
            return "Error al eliminar el registro: " . $this->conn->error;
        }
    }
}
