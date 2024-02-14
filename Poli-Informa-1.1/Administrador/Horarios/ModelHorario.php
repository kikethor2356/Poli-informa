<?php
class Horario{
    private $conn;
    private $table = 'horarios_maestros';
    private $maestro_id;
    private $hora_inicio;
    private $hora_fin;
    private $dia_semana;

    public function __construct($db) {
        $this->conn = $db;
    }


    // Método para establecer las variables del horario
    public function setHorario($maestro_id, $hora_inicio, $hora_fin, $dia_semana) {
        $this->maestro_id = $maestro_id;
        $this->hora_inicio = $hora_inicio;
        $this->hora_fin = $hora_fin;
        $this->dia_semana = $dia_semana;
    }

    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' (maestro_id, hora_inicio, hora_fin, dia_semana) VALUES (:maestro_id, :hora_inicio, :hora_fin, :dia_semana)';
        $stmt = $this->conn->prepare($query);
    
        $stmt->bindParam(':maestro_id', $this->maestro_id);
        $stmt->bindParam(':hora_inicio', $this->hora_inicio);
        $stmt->bindParam(':hora_fin', $this->hora_fin);
        $stmt->bindParam(':dia_semana', $this->dia_semana);
    
        if($stmt->execute()) {
            return true;
            
        }
    
        printf("Error: %s.\n", $stmt->error);
    
        return false;
    }




    public function obtenerHorario() {
        $query = "SELECT * FROM horarios_maestros";
        $resultado = $this->conn->query($query);

        while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
            $dia_semana = $fila['dia_semana'];
            $hora_inicio = $fila['hora_inicio'];
            $hora_fin = $fila['hora_fin'];
            /* $nombre_clase = $fila['nombre_clase']; */

            $horario[$dia_semana][] = array('hora_inicio' => $hora_inicio, 'hora_fin' => $hora_fin /* 'nombre_clase' => $nombre_clase */);
        }

        return $horario;
    }


    public function show() {
        // Obtener los horarios
        $horario = $this->obtenerHorario();
    
        // Crear la tabla de horarios
        echo "<table border='1'>";
        echo "<tr><th>Horario</th>";
        foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia) {
            echo "<th>$dia</th>";
        }
        echo "</tr>";
    
        // Generar las filas de la tabla
        for ($i = 7; $i < 17; $i++) {
            echo "<tr>";
            if ($i < 10) {
                echo "<td>0$i:00 am</td>";
            } else {
                echo "<td>$i:00 pm</td>";
            }
            foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'] as $dia) {
                echo "<td>";
                if (isset($horario[$dia])) {
                    foreach ($horario[$dia] as $hora) {
                        if ($i >= (int)$hora['hora_inicio'] && $i < (int)$hora['hora_fin']) {
                            echo "Disponible";
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