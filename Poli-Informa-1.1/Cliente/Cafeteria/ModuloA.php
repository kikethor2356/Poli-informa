<?php
include('../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();
?>
<?php include '../LoginU/inicio.php'; ?>
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
        <div class="acerca">
            <section class="principal">
                <div class="wrapper"><br>
                    <h1>Cafeteria Modulo A</h1><br>
                    <p>Encontaras algunos productos los cuales esperamos que sean de tu gustos, solamente podras ver productos y no podras pagarlo, pero puedes consultar que es lo que se te puede antojar y ir a la coperative que esta al lado de las escaleras del Modulo A.</p>

                    <!-- Contenedor de elementos -->
                    <div id="search-container"> <!-- Buscador -->
                        <input type="search" id="search-input" placeholder="Buscar por el nombre del producto o descripción aquí...">
                        <button id="search">Buscar</button>
                    </div>
                    <div id="search-container"> <!-- Buscador -->
                        <input type="number" id="price-input" placeholder="Ingrese un precio accesible...">
                        <button id="search-button">Buscar</button>
                    </div>


                    <!-- Contenedor de botones de categoría -->
                    <div id="buttons">
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
                        <?php endforeach; ?>
                    </div>                    

                    <!-- Contenedor de productos -->
                    <div id="productos">
                        <?php                                                                                                                     
                            // Consultar productos según la categoría seleccionada y la búsqueda
                            $query_productos = "SELECT p.*, c.categoria_nombre FROM cafeteriamodulo_a p LEFT JOIN categorias_cafeteria c ON p.prodcategoria_id = c.categoria_id";

                            $value = isset($_GET['categoria']) ? $_GET['categoria'] : "Todo";
                            $search = isset($_GET['search']) ? $_GET['search'] : "";
                            $price = isset($_GET['price']) ? $_GET['price'] : "";

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

                            if ($price !== "") {
                                if ($price !== "Todo" || $search !== "") {
                                    $query_productos .= " AND p.precio > $price"; // Modificado para que el precio sea mayor que el valor ingresado
                                } else {
                                    $query_productos .= " WHERE p.precio <= $price";
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
                    </div>
                </div>    
            </section><br>
        </div>
    </div>

    <?php include '../Partes/footer-page/index.html';?>
</body>
</html>