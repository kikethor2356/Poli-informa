<?php
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

$value = isset($_GET['categoria']) ? $_GET['categoria'] : "Todo";
$search = isset($_GET['search']) ? $_GET['search'] : "";

// Consultar productos según la categoría seleccionada y la búsqueda
$query_productos = "SELECT p.*, c.categoria_nombre FROM cafeteriamodulo_a p LEFT JOIN categorias_cafeteria c ON p.prodcategoria_id = c.categoria_id";

if ($value !== "Todo") {
    $query_productos .= " WHERE c.categoria_nombre = '$value'";
    if ($search !== "") {
        $query_productos .= " AND (p.nombre_producto LIKE '%$search%' OR p.descripcion LIKE '%$search%')";
    }
} else {
    if ($search !== "") {
        $query_productos .= " WHERE p.nombre_producto LIKE '%$search%' OR p.descripcion LIKE '%$search%'";
    }
}

$result_productos = $conexion->query($query_productos);
$productos = $result_productos->fetch_all(MYSQLI_ASSOC);

// Generar las tarjetas de producto
foreach ($productos as $producto) {
    echo '<div class="card ' . $producto['categoria_nombre'] . '">';
    echo '<div class="image-container">';
    echo '<img src="../../Administrador/Cafeteria/Agregar/temp/' . $producto['imagen'] . '" alt="' . $producto['nombre_producto'] . '">';
    echo '</div>';
    echo '<div class="container">';
    echo '<h5 class="producto-name">' . $producto['nombre_producto'] . '</h5>';
    echo '<p>' . $producto['descripcion'] . '</p>';
    echo '<h6>$' . $producto['precio'] . '</h6>';
    echo '</div>';
    echo '</div>';
}
?>
