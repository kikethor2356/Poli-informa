<?php
    include '../LoginU/inicio.php';
    include('../../Conexion/conexion.php');
    session_start();
    $db = new Database();
    $conexion = $db->connect();    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/moduloa.css">
    <script src="js/moduloa.js"></script>
    <title>Modulo A</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'?>
    <div class="home">
        <div class="text">
            <div class="acerca">
                <div class="wrapper">
                    <h1>Cafeteria Modulo A</h1><br><br><br>
                    <p>Encontrarás algunos productos los cuales esperamos que sean de tu gusto. Solamente podrás ver productos y no podrás pagarlos, pero puedes consultar qué es lo que se te antoja e ir a la cooperativa que está al lado de las escaleras del Modulo A.</p>

                    <!-- Contenedor de elementos -->
                    <div id="search-container"> <!-- Buscador -->
                        <input type="search" id="search-input" placeholder="Buscar por el nombre del producto o descripción aquí...">
                        <!-- <button id="search">Buscar</button> -->
                    </div>
                    <div id="search-container2"> <!-- Buscador -->
                        <input type="number" id="price-input" placeholder="Ingrese un precio accesible...">
                        <button id="search-button">Buscar</button>
                    </div>

                    <!-- Contenedor de botones de categoría -->
                    <div id="buttons"><br>
                        <!-- Botón para mostrar todos los productos -->
                        <button class="button-value active1" onclick="filterProductos('Todo', '')">Todo</button>
                        <?php                                             
                            $query = "SELECT * FROM categorias_cafeteria";
                            $result = $conexion->query($query);
                            $categorias = $result->fetch_all(MYSQLI_ASSOC);
                            
                            foreach ($categorias as $categoria): ?>
                                <button class="button-value" onclick="filterProductos('<?php echo $categoria['categoria_nombre']; ?>', '')">
                                    <?php echo $categoria['categoria_nombre']; ?>
                                </button>
                        <?php endforeach; ?><br><br>
                    </div>                    

                    <!-- Contenedor de productos -->
                    <div id="productos">
                        <?php        
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
                            }                        ?>
                    </div>

                </div>    
            </div><br>
        </div>
    </div>
    <?php include '../Partes/footer-page/index.html';?>
</body>
</html>
