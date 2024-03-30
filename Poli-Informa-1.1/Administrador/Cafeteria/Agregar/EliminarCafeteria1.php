<?php
include('../../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();

$cafeteriama = $_POST['eliminar_id'];
$eliminar_imagen = $_POST['eliminar_imagen'];

// Comprobar si la imagen todavía está en uso por otros registros
$check_sql = "SELECT COUNT(*) as count FROM cafeteriamodulo_a WHERE imagen = '$eliminar_imagen' AND cafeteriama_id != '$cafeteriama'";
$check_result = mysqli_query($conexion, $check_sql);
$row = mysqli_fetch_assoc($check_result);
$imageInUse = $row['count'] > 0;

$sql = "DELETE FROM cafeteriamodulo_a WHERE cafeteriama_id ='$cafeteriama' ";
$resultado = mysqli_query($conexion, $sql);

if($resultado){
    // Si el registro se elimina exitosamente

    // Comprobar si la imagen todavía está en uso por otros registros
    if (!$imageInUse) {
        // Si la imagen no está siendo utilizada por ningún otro registro, elimínela de la carpeta temporal
        unlink("temp/" .$eliminar_imagen);
    }

    $_SESSION['success2'] = true;
    header("location: ../AdminCafeteria1.php");
} else {
    // Si el registro no se elimina exitosamente
    $_SESSION['error2'] = true;
    header("location: ../AdminCafeteria1.php");    
    die("Datos NO eliminados: " . mysqli_error($conexion));
}
?>