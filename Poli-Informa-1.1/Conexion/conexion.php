<?php
require_once 'config.php';

class Database {
    private $conn;

    public function __construct() {
        global $db_host, $db_user, $db_pass, $db_name;
        $this->conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function connect() {
        return $this->conn;
    }
}


?>
