<?php 

    include("Conectar/conexion.php");

    $imagen = '';

    if(isset($_POST['enviar'])){

        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $categoria = $_POST['categorias'];
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        // $vendedor = $_POST['vendedor'];

        $stmt = $conexion->prepare("INSERT INTO PRODUCTOS (nombre, descripcion, precio, categoria, imagen) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss", $nombre, $descripcion, $precio, $categoria, $imagen);

        $stmt->execute();

        $stmt->close();
        
        $conexion->close();

    }

?>