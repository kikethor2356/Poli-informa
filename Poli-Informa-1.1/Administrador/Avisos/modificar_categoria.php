<?php
require '../../Conexion/conexion.php';
session_start();

if(isset($_POST['Guardar'])){

    $id_categoria = $_POST['id_categoria'];
    $categoria = $_POST['categoria'];

    $new_imagen  = $_FILES['foto']['name'];
    $old_imagen = $_POST['imagen_old'];

    // Verificar si se ha seleccionado una nueva imagen
    if($new_imagen != ''){
        // Genera un nombre único para la nueva imagen
        $imagen = uniqid().'_'.$_FILES['foto']['name'];
        // Mueve la nueva imagen a la carpeta temporal con el nombre único
        move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/".$imagen);

        // Si había una imagen anterior, elimínala (excepto si está siendo utilizada por otro registro)
        if($old_imagen != ''){    
            $check_sql = "SELECT COUNT(*) as count FROM avisos WHERE foto = '$old_imagen' AND id_categoria != '$id_categoria'";
            $check_result = mysqli_query($conexion, $check_sql);
            $row = mysqli_fetch_assoc($check_result);
            $imageInUse = $row['count'] > 0;
    
            // Si la imagen no está siendo utilizada por otro registro, elimínala
            if(!$imageInUse) {
                unlink("fotos/".$old_imagen);
            }
        }
    } else {
        // Si no se selecciona una nueva imagen, mantener la imagen actual
        $imagen = $old_imagen;
    }

    $sql = "UPDATE avisos SET categoria = '$categoria', foto = '$imagen' WHERE id_categoria = '$id_categoria'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $_SESSION['status'] = "Datos actualizados fue exitoso";
        header("location: vista_categoria.php");
    } else {
        $_SESSION['status'] = "Los datos no se insertaron";
        header("location: vista_categoria.php");
    }
}
?>