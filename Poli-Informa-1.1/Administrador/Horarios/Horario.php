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

    // Método para obtener el horario según el nombre del laboratorio
    public function getHorarioPorLaboratorio()
    {
        $query = "SELECT * FROM horarios WHERE nombre_laboratorio = 'Taller1' ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    // Función para generar la tabla de horarios
function generarTablaHorarios($conn)
{
    // Crear instancia de la clase Horario
    $horario = new Horario($conn);

    // Obtener horarios por laboratorio
    $stmt = $horario->getHorarioPorLaboratorio();

    // Verificar si hay resultados
    if ($stmt->rowCount() > 0) {
        $table = "<table border='1'>";
        $table .= "<tr><th>Nombre Maestro</th><th>Hora de inicio</th><th>Hora de fin</th><th>Día</th><th>Nombre del laboratorio</th></tr>";

        // Iterar sobre los resultados
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $table .= "<tr>";
            $table .= "<td>{$row['maestro']}</td>";
            $table .= "<td>{$row['hora_inicio']}</td>";
            $table .= "<td>{$row['hora_fin']}</td>";
            $table .= "<td>{$row['dias']}</td>";
            $table .= "<td>{$row['nombre_laboratorio']}</td>";
            $table .= "</tr>";
        }
        $table .= "</table>";
    } else {
        $table = "No se encontraron horarios.";
    }

    return $table;
}


}

?>
