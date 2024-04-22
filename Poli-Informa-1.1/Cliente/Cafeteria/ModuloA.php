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
    <title>Modulo A</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'?>
    <div class="home">
        <div class="text">
            <div class="">
                <h1>Cafeteria Modulo A</h1><br>
                <p>Encontaras algunos productos los cuales esperamos que sean de tu gustos, solamente podras ver productos y no podras pagarlo, pero puedes consultar que es lo que se te puede antojar y ir a la coperative que esta al lado de las escaleras del Modulo A.</p>
            </div>

            <section class="contenedor">
                <!-- //Contenedor de elementos -->
                <div class="contenedor-items">
                    <?php  
                                                
                        // $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 1;
                        // $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                        // $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                        // $sql = "SELECT COUNT(*) AS total FROM cafeteriamodulo_a";
                        // $resultado = mysqli_query($conexion, $sql);
                        // $fila = mysqli_fetch_assoc($resultado);
                        // $total_resultados = $fila['total'];
                        // $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM cafeteriamodulo_a";
                        $consulta = mysqli_query($conexion,$sql);
                        
                        if(mysqli_num_rows($consulta)>0){
                            while($registro = mysqli_fetch_assoc($consulta)){ ?>
                                <div class="item">
                                    <span class="titulo-item"><?php echo $registro["nombre_producto"];?></span>
                                    <?php
                                        echo' <img src="../../Administrador/Cafeteria/Agregar/temp/'.$registro['imagen'].'">'
                                    ?>
                                    <span class="descripcion-item"><?php echo $registro["descripcion"];?></span>
                                    <span class="precio-item">$<?php echo $registro["precio"];?></span>
                                </div>
                            <?php }
                        }else{
                            echo 'No hay productos para mostrar';
                        }?>
                </div>
            </section>

            <!-- Navegación entre páginas -->
            <!-- <div id="paginacion">
                <?php
                if ($total_paginas > 1) {
                    echo "<span>Páginas: </span>";
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        echo "<a href='?pagina=$i&resultados_por_pagina=$resultados_por_pagina' ";
                        if ($pagina_actual == $i) echo "class='current'";
                        echo "> $i </a>";
                    }
                }
                ?>
            </div><br> -->
            <br>
            
        </div>
    </div>
    <?php include '../Partes/footer-page/index.html';?>
</body>
</html>