<?php
class Horario {
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
    // Método para obtener todos los horarios
    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Otros métodos para actualizar y eliminar horarios...
}

?>