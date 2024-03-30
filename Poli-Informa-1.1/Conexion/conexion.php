<?php
require_once 'config.php';

class Database {
    private $conexion;

    public function __construct() {
        global $db_host, $db_user, $db_pass, $db_name;
        $this->conexion = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function connect() {
        return $this->conexion;
    }
}


?>
