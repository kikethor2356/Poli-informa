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
            echo "<td style='border: 1px solid #ddd; padding: 8px;'><a href='editar.php?id=" . $fila['id'] . "'>Editar</a></td>";
            echo "<td style='border: 1px solid #ddd; padding: 8px;'><a href='eliminar.php?id=" . $fila['id'] . "'>Eliminar</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function __destruct()
    {
        $this->conn->close();
    }
}
