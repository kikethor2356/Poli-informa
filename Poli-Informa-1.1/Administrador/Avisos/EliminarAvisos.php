<?php
    require '../../Conexion/conexion.php';
   
    session_start();
    $db = new Database();
    $conexion = $db->connect();
        
        $id_aviso = $_POST['eliminar_id'];
        $foto = $_POST['eliminar_imagen'];
    
        // Comprobar si la imagen todavía está en uso por otros registros
        $check_sql = "SELECT COUNT(*) as count FROM avisos WHERE foto = '$foto' AND id_aviso != '$id_aviso'";
        $check_result = mysqli_query($conexion, $check_sql);
        $row = mysqli_fetch_assoc($check_result);
        $imageInUse = $row['count'] > 0;

        // Eliminar el registro de la base de datos
        $consulta = "DELETE FROM avisos WHERE id_aviso='$id_aviso'";
        $resultado = mysqli_query($conexion, $consulta);

        if($resultado){

            if(!$imageInUse){
                unlink("fotos/" .$foto);
            }
            $_SESSION['success2'] = "Datos y la imagen se borraron exitosamente";
            header("location: AdminAvisos.php");
        } else {
            // Si el registro no se elimina exitosamente
            $_SESSION['error2'] = "Datos no se borraron";
            header("location: AdminAvisos.php");
        }
?>