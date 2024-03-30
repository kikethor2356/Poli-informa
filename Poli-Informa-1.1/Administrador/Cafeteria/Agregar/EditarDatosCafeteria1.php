<?php
include('../../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

if(isset($_POST['Editar1'])){
    $cafeteriama_id = $_POST['cafeteriamaid'];
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $new_imagen  = $_FILES['imagen']['name'];
    $old_imagen = $_POST['imagen_old'];
    $categoria = $_POST['categoria_nombre'];

    if($new_imagen != ''){
        // Genera un nombre único para la nueva imagen
        $imagen = uniqid().'_'.$_FILES['imagen']['name'];
        // Mueve la nueva imagen a la carpeta temporal con el nombre único
        move_uploaded_file($_FILES["imagen"]["tmp_name"], "temp/".$imagen);

        // Si había una imagen anterior, elimínala (excepto si está siendo utilizada por otro registro)
        if($old_imagen != '') {
            $check_sql = "SELECT COUNT(*) as count FROM cafeteriamodulo_a WHERE imagen = '$old_imagen' AND cafeteriama_id != '$cafeteriama_id'";
            $check_result = mysqli_query($conexion, $check_sql);
            $row = mysqli_fetch_assoc($check_result);
            $imageInUse = $row['count'] > 0;
    
            // Si la imagen no está siendo utilizada por otro registro, elimínala
            if(!$imageInUse) {
                unlink("temp/".$old_imagen);
            }
        }
    } else {
        // Si no se subió una nueva imagen, mantén la imagen existente
        $imagen = $old_imagen;
    }

    $sql = "UPDATE cafeteriamodulo_a SET nombre_producto = '$nombre', descripcion = '$descripcion', precio = '$precio', imagen = '$imagen', prodcategoria_id = '$categoria' WHERE cafeteriama_id = '$cafeteriama_id'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $_SESSION['success1'] = true;
        header("location: ../AdminCafeteria1.php");
    } else {
        $_SESSION['error1'] = true;
        header("location: ../AdminCafeteria1.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
}
?>
