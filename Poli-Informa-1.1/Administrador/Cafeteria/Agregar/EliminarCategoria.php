<?php
include('../../../Conexion/conexion.php');
session_start();

$categoriaid = $_POST['eliminar_id'];

// Verificar si la categoría está vinculada a algún producto en cafetería modulo A
$sqlCheck = "SELECT COUNT(*) AS count FROM cafeteriamodulo_a WHERE prodcategoria_id = '$categoriaid'";
$resultCheck = mysqli_query($conexion, $sqlCheck);
$rowCheck = mysqli_fetch_assoc($resultCheck);
$productosEnCategoria = $rowCheck['count'];

// Verificar si la categoría está vinculada a algún producto en cafetería canchas
$sqlCheck2 = "SELECT COUNT(*) AS count FROM cafeteriacanchas WHERE prodcategoria_id = '$categoriaid'";
$resultCheck2 = mysqli_query($conexion, $sqlCheck2);
$rowCheck2 = mysqli_fetch_assoc($resultCheck2);
$productosEnCategoria2 = $rowCheck2['count'];

// Si hay productos en alguna de las categorías, mostrar un mensaje de error y redireccionar
if ($productosEnCategoria > 0 || $productosEnCategoria2 > 0) {
    $_SESSION['success3'] = true;
    header("Location: ../Categorias.php");
    exit(); // Asegura que el script termine aquí
} else {
    // Si no hay productos en la categoría, proceder con la eliminación
    $sqlDelete = "DELETE FROM categorias_cafeteria WHERE categoria_id ='$categoriaid'";
    $queryDelete = mysqli_query($conexion, $sqlDelete);

    if ($queryDelete === TRUE) {
        $_SESSION['success2'] = true;
        header("location: ../Categorias.php");
    } else {
        $_SESSION['success2'] = true;
        header("location: ../Categorias.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
}
?>