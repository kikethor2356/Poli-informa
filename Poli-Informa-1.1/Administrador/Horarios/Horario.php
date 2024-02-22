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
    public function setHorario($maestro,$hora_inicio, $hora_fin,$dias,$nombre_laboratorio)
    {
        $this->maestro = $maestro;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->dias = $dias;
        $this->nombre_laboratorio = $nombre_laboratorio;
        
    }

    public function create()
    {
        $query = 'INSERT INTO ' . $this->table . ' (maestro,nombre_laboratorio, hora_inicio, hora_fin, dias) VALUES (:maestro,:nombre_laboratorio, :hora_inicio, :hora_fin, :dias)';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':maestro', $this->maestro);
        $stmt->bindParam(':nombre_laboratorio', $this->nombre_laboratorio);
        $stmt->bindParam(':hora_inicio', $this->hora_inicio);
        $stmt->bindParam(':hora_fin', $this->hora_fin);
        $stmt->bindParam(':dias', $this->dias);
        if ($stmt->execute()) {
            return true;
        }

        printf("Error: %s.\n", $stmt->error);

        return false;
    }


    
      
        public function obtenerHorario() {
            $query = "SELECT * FROM $this->table WHERE nombre_laboratorio = 'Taller1'";
            $resultado = $this->conn->query($query);
    
            $horario = array(
                'Lunes' => array(),
                'Martes' => array(),
                'Miércoles' => array(),
                'Jueves' => array(),
                'Viernes' => array(),
                'Sábado' => array(),
                'Domingo' => array()
            );
    
            while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                $dias = $fila['dias'];
                $hora_inicio = $fila['hora_inicio'];
                $hora_fin = $fila['hora_fin'];
                $nombre_laboratorio = $fila['nombre_laboratorio'];
                $maestro = $fila['maestro'];
    
                $horario[$dias][] = array('hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin, 'maestro' => $maestro);
            }
    
            return $horario;
        }
    
        public function mostrarHorario() {
            $horario = $this->obtenerHorario();
    
           // Crear la tabla de horarios
    echo "<table border='1'>";
    echo "<tr><th>Horario</th>";
    foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia) {
        echo "<th>$dia</th>";
    }
    echo "</tr>";

    // Generar las filas de la tabla
    for ($i = 0; $i < 20; $i++) {
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
                    if ($i >= (int)$hora['hora_inicio'] && $i <= (int)$hora['hora_fin']) {
                        echo "No disponible";
                        break;
                    }
                }
            }
            echo "</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
        }
    
        public function __destruct() {
            $this->conn = null;
        }
    }
    




?>
