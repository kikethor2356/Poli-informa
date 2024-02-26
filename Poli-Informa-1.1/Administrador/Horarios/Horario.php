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

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para establecer las variables del horario
    public function setHorario($maestro, $hora_inicio, $hora_fin, $dias, $nombre_laboratorio)
    {
        $this->maestro = $maestro;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->dias = $dias;
        $this->nombre_laboratorio = $nombre_laboratorio;
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (maestro,nombre_laboratorio, hora_inicio, hora_fin, dias) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssss', $this->maestro, $this->nombre_laboratorio, $this->hora_inicio, $this->hora_fin, $this->dias);

        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }

    public function obtenerHorario()
    {
        $query = "SELECT * FROM $this->table WHERE nombre_laboratorio = 'Taller1'";
        $resultado = $this->conn->query($query);

        $horario = array(
            'Lunes' => array(),
            'Martes' => array(),
            'Miércoles' => array(),
            'Jueves' => array(),
            'Viernes' => array(),
            'Sábado' => array(),
        );

        while ($fila = $resultado->fetch_assoc()) {
            $dias = $fila['dias'];
            $hora_inicio = $fila['hora_inicio'];
            $hora_fin = $fila['hora_fin'];
            $nombre_laboratorio = $fila['nombre_laboratorio'];
            $maestro = $fila['maestro'];

            $horario[$dias][] = array('hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin, 'maestro' => $maestro);
        }

        return $horario;
    }

    public function mostrarHorario()
    {
        $horario = $this->obtenerHorario();

        // Crear la tabla de horarios
        echo "<table border='1'>";
        echo "<tr><th>Horario</th>";
        foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia) {
            echo "<th>$dia</th>";
        }
        echo "</tr>";

        // Generar las filas de la tabla
        for ($i = 7; $i <= 20; $i++) {
            echo "<tr>";
            if ($i < 12) {
                echo "<td>0$i:00 am</td>";
            } else {
                echo "<td>$i:00 pm</td>";
            }
            foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia) {
                echo "<td>";
                if (isset($horario[$dia])) {
                    foreach ($horario[$dia] as $hora) {
                        if ($i >= (float)$hora['hora_inicio'] && $i <= (float)$hora['hora_fin']) {
                            echo $hora['maestro']; // Corregido aquí

                        }
                    }
                }
                echo "</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }


    function search($busqueda)
    {
        // Consulta SQL para buscar en la base de datos
        $sql = "SELECT * FROM $this->table WHERE nombre_laboratorio LIKE '%$busqueda%'";
        $resultado = $this->conn->query($sql);

        // Mostrar resultados en una tabla

        echo "<h2 style= 'font-size:20px'>$busqueda</h2> ";
        
        echo "<table style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th style='border: 1px solid #ddd; padding: 8px;'>Laboratorio</th><th style='border: 1px solid #ddd; padding: 8px;'>Maestro</th><th style='border: 1px solid #ddd; padding: 8px;'>Hora Inicio</th><th style='border: 1px solid #ddd; padding: 8px;'>Hora Fin</th><th style='border: 1px solid #ddd; padding: 8px;'>Editar</th><th style='border: 1px solid #ddd; padding: 8px;'>Eliminar</th></tr>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $fila['nombre_laboratorio'] . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $fila['maestro'] . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $fila['hora_inicio'] . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'>" . $fila['hora_fin'] . "</td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'><a href='ControllerEdit.php?id=" . $fila['id'] . "'>Editar</a></td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'><a href='ControllerDelete.php?id=" . $fila['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }


    function editarRegistro($id, $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin) {
        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE $this->table SET nombre_laboratorio=?, maestro=?, hora_inicio=?, hora_fin=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $nombre_laboratorio, $maestro, $hora_inicio, $hora_fin, $id);

        if ($stmt->execute()) {
            return "Registro actualizado correctamente";
            header('Location: indexAdmin.php');
        } else {
            return "Error al actualizar el registro: " . $this->conn->error;
        }
    }
    
    function mostrarFormularioEdicion($id) {
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
            <h2>Editar Registro</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <label for="nombre_laboratorio">Nombre laboratorio:</label>
                <input type="text" name="nombre_laboratorio" value="<?php echo $fila['nombre_laboratorio']; ?>"><br><br>
                <label for="maestro">Maestro:</label>
                <input type="text" name="maestro" value="<?php echo $fila['maestro']; ?>"><br><br>
                <label for="hora_inicio">Hora de inicio:</label>
                <input type="text" name="hora_inicio" value="<?php echo $fila['hora_inicio']; ?>"><br><br>
                <label for="hora_fin">Hora de fin:</label>
                <input type="text" name="hora_fin" value="<?php echo $fila['hora_fin']; ?>"><br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
            <?php
        } else {
            echo "No se encontró ningún registro con el ID proporcionado";
        }
    }


    function eliminarRegistro($id) {
        // Consulta SQL para eliminar el registro de la base de datos
        $sql = "DELETE FROM $this->table WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            return "Registro eliminado correctamente";
            
        } else {
            return "Error al eliminar el registro: " . $this->conn->error;
        }
    }


    /* public function __destruct()
    {
        $this->conn->close();
    } */
}
