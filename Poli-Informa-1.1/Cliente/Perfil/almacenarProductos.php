<?php 
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['enviar'])){
        $codigoEstudiante = $_POST['codigovendedor'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];        
        $archivo = $_FILES['imagen']['name'];
        $temporal = $_FILES['imagen']['tmp_name'];
        $carpeta = 'imagenes';
        $categoria = $_POST['categoria'];

        if(!empty($archivo) && !empty($temporal)){
            if(!file_exists($carpeta)){
                mkdir($carpeta, 0777, true);
            }
            $ruta = $carpeta . "../../Administrador/Vendedores/PHP/imagenes/" . $archivo;
            if(!move_uploaded_file($temporal, $ruta)){
                echo "Ocurrió un error al enviar la imagen";
            }
        }

        $stmt = $conexion->prepare("INSERT INTO productos_pendientes (nombre, codigoVendedor, precio, descripcion, nombreImagen, categoria) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $nombre, $codigoEstudiante, $precio, $descripcion, $archivo, $categoria);
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