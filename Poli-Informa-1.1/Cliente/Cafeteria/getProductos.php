<?php
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

$value = isset($_GET['categoria']) ? $_GET['categoria'] : "";
$search = isset($_GET['search']) ? $_GET['search'] : "";
$price = isset($_GET['price']) ? $_GET['price'] : "";

$query_productos = "SELECT p.*, c.categoria_nombre FROM cafeteriamodulo_a p LEFT JOIN categorias_cafeteria c ON p.prodcategoria_id = c.categoria_id";

// Modificar la consulta para incluir la condición de la categoría
if ($value !== "Todo") {
    $query_productos .= " WHERE c.categoria_nombre = '$value'";
}

// Modificar la consulta para incluir la condición de búsqueda
if ($search !== "") {
    if ($value !== "Todo") {
        $query_productos .= " AND (p.nombre_producto LIKE '%$search%' OR p.descripcion LIKE '%$search%')";
    } else {
        $query_productos .= " WHERE (p.nombre_producto LIKE '%$search%' OR p.descripcion LIKE '%$search%')";
    }
}

// Modificar la consulta para incluir la condición del precio
if ($price !== "" && $price !== "undefined") {
    if ($search !== "" || $value !== "Todo") {
        $query_productos .= " AND p.precio <= $price"; // Modificado para que el precio sea menor o igual al valor ingresado
    } else {
        $query_productos .= " WHERE p.precio <= $price"; // Consultar todos los productos con precio menor o igual al valor ingresado
    }
}

$query_productos .= " ORDER BY p.prodcategoria_id, p.nombre_producto"; // Agregar ordenamiento al final de la consulta

$result_productos = $conexion->query($query_productos);

if (!$result_productos) {
    die("Error en la consulta SQL: " . mysqli_error($conexion));
}

// Array asociativo para almacenar los productos agrupados por categoría
$productos_por_categoria = array();

// Recorrer los resultados y agrupar los productos por categoría
while ($producto = $result_productos->fetch_assoc()) {
    $categoria = $producto['categoria_nombre'];
    if (!isset($productos_por_categoria[$categoria])) {
        $productos_por_categoria[$categoria] = array();
    }
    $productos_por_categoria[$categoria][] = $producto;
}

// Imprimir los productos agrupados por categoría
foreach ($productos_por_categoria as $categoria => $productos) {
    echo '<div class="categoria-container">';
    echo '<h3 class="categoria-name">' . $categoria . '</h3>';
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
    echo '</div>'; // Cerrar la clase categoria-container
}
?>