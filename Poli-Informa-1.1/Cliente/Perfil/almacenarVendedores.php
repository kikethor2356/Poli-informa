<?php 
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['guardar'])){
        $codigoEstudiante = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $horaInicio = $_POST['hora-inicio'];
        $horaFin = $_POST['hora-fin'];
        $archivo = $_FILES['imagen']['name'];
        $temporal = $_FILES['imagen']['tmp_name'];
        $carpeta = 'imagenes';

        if(!empty($archivo) && !empty($temporal)){
            if(!file_exists($carpeta)){
                mkdir($carpeta, 0777, true);
            }
            $ruta = $carpeta . "/" . $archivo;
            if(!move_uploaded_file($temporal, $ruta)){
                echo "Ocurrió un error al enviar la imagen";
            }
        }

        $stmt = $conexion->prepare("INSERT INTO VENDEDORES_PENDIENTES (codigoVendedor, nombre, descripcion, correo, telefono, horaInicio, horaFin, foto) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $codigoEstudiante, $nombre, $descripcion, $correo, $telefono, $horaInicio, $horaFin, $archivo);
        $stmt->execute();
        $stmt->close();
        $conexion->close();
        header("Location: Perfil.php");    
        exit();
    } else {
        // Manejar el caso en el que 'idVendedorPendiente' no está definido
        echo "Error: El ID del vendedor pendiente no está definido.";
    }
}
?>