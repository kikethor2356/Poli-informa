<?php
    include '../LoginU/inicio.php';
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();

    $idProducto = (int) filter_var($_REQUEST['dnf'], FILTER_SANITIZE_NUMBER_INT);

    $consulta = "SELECT ID FROM productos";
    $resultado = $conexion->query($consulta);

    $productos = [];

    while ($fila = $resultado->fetch_assoc()) {
        $productos[] = $fila['ID'];
    }

    if(!in_array($idProducto, $productos)) {
        header("Location: poli-commerce.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preload" href="css/diseño.css" as="style">
    <link rel="stylesheet" href="css/diseño.css">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>producto</title>
</head>
<body>
    
    <?php include("../Partes/MenuUsuario.php"); ?>

    <div class="home">
        <div class="text">
            <?php
                $consultaProducto = "SELECT * FROM productos where ID='$idProducto' ";
                $resultadoProducto = mysqli_query($conexion, $consultaProducto);
                $mostrarProducto=mysqli_fetch_array($resultadoProducto);
                $categoriaProducto = $mostrarProducto['categoria'];
            ?>
            <main class="contenedor-principal">

                <section class="contenedor-producto contenedor">
                    <img class="contenedor-producto__imagen" src="img/<?php echo $mostrarProducto['nombreImagen']; ?>" alt="imagen del producto">
                    <div class="contenido-producto">
                        <h2 class="contenido-producto__titulo"><?php echo $mostrarProducto['nombre']; ?></h2>
                        <p class="contenido-producto__precio">Precio: $<?php echo $mostrarProducto['precio']; ?></p>
                        <h3 class="contenido-producto__subtitulo">Descripción del producto</h3>
                        <p class="contenido-producto__descripcion"><?php echo $mostrarProducto['descripcion']; ?></p>
                        <a class="contenido-producto__enlace" href="#"><i class="fa-solid fa-message"></i>&nbsp;&nbsp;Informar sobre un problema con este producto</a>
                    </div> <!-- .producto -->
                </section> <!-- .contenedor-producto -->

                <section class="contenedor-vendedor contenedor">
                    <h2 class="subtitulo">Acerca del vendedor</h2>
                    <?php
                        $consultaVendedor = "SELECT v.*
                        FROM vendedores v
                        JOIN productos p ON v.codigoVendedor = p.codigoVendedor
                        WHERE p.ID = '$idProducto'";
                        $resultadoVendedor = mysqli_query($conexion, $consultaVendedor);
                        $mostrarVendedor=mysqli_fetch_array($resultadoVendedor);
                    ?>
                    
                    <div class="grid-vendedor">
                        <div class="contenido-vendedor-1">
                            <h3 class="contenido-vendedor__titulo"><?php echo $mostrarVendedor['nombre']; ?></h3>
                            <p class="contenido-vendedor__descripcion"><?php echo $mostrarVendedor['descripcion']; ?></p>
                            <h3 class="contenido-vendedor__subtitulo"con>Horario de ventas</h3>
                            <p class="contenido-vendedor__inicio"><b>Inicio:</b> <?php echo $mostrarVendedor['horaInicio']; ?></p>
                            <p class="contenido-vendedor__fin"><b>Fin:</b> <?php echo $mostrarVendedor['horaFin']; ?></p>
                            <h3 class="contenido-vendedor__subtitulo"con>Datos de contacto</h3>
                            <div class="grid-contactos">
                                <div class="flex-contacto">
                                    <a class="flex-contacto__enlace" href="https://wa.me/<?php echo $mostrarVendedor['telefono']; ?>" target="_blank"><i class="fa-brands fa-whatsapp"></i></a>
                                    <p class="flex-contacto__texto"><?php echo $mostrarVendedor['telefono']; ?></p>
                                </div> <!-- .flex-contacto -->
                                <div class="flex-contacto">
                                    <a class="flex-contacto__enlace" href="mailto:<?php echo $mostrarVendedor['correo']; ?>?subject=Informes desde Poli_Informa&body=Saludos, podrías darme más información sobre <?php echo $mostrarProducto['nombre']; ?>"><i class="fa-solid fa-envelope"></i></a>
                                    <p class="flex-contacto__texto"><?php echo $mostrarVendedor['correo']; ?></p>
                                </div> <!-- .flex-contacto -->
                            </div> <!-- .grid-contactos -->
                        </div> <!-- .contenido-vendedor-1 -->
                        <div class="contenido-vendedor-2">
                            <img class="contenido-vendedor__imagen" src="img/<?php echo $mostrarVendedor['foto']; ?>" alt="imagen del vendedor">
                        </div> <!-- .contenido-vendedor-2 -->
                    </div> <!-- .grid-vendedor -->
                </section> <!-- .contenedor-vendedor -->

                <section class="productos-vendedor contenedor">
                    <h2 class="subtitulo">Productos de <?php echo $mostrarVendedor['nombre']?></h2>
                    <div class="productos">
                    <?php
                        $codigoVendedor = $mostrarVendedor['codigoVendedor'];
                        $consulta = "SELECT productos.* 
                        FROM productos JOIN vendedores ON 
                        productos.codigoVendedor = vendedores.codigoVendedor 
                        WHERE vendedores.codigoVendedor = $codigoVendedor ";
                        mostrarProductos($consulta);
                    ?>
                    </div> <!-- .productos -->
                </section> <!-- .productos-vendedor -->

                <section class="productos-relacionados contenedor">
                    <h2 class="subtitulo">Más productos en <?php echo $categoriaProducto ?></h2>
                    <div class="productos">
                    <?php
                        // $consultaProducto = "SELECT * FROM productos where ID = $idProducto";
                        $resultado = mysqli_query($conexion, $consultaProducto);
                        $mostrar = mysqli_fetch_array($resultado);
                        $categoriaProducto = $mostrar['categoria'];
                        $consulta = "SELECT * FROM productos WHERE categoria = '$categoriaProducto' AND ID != $idProducto ";
                        mostrarProductos($consulta);
                    ?>
                    </div> <!-- .productos -->
                </section> <!-- .productos-relacionados -->

            </main>

        </div> <!-- .text -->
    </div> <!-- .home -->

    <script src="js/java.js"></script>

    <?php
        function mostrarProductos($consulta){
            $db = new Database();
            $conexion = $db->connect();
            
            $resultado = mysqli_query($conexion, $consulta);
            while($mostrar=mysqli_fetch_array($resultado)){
    ?>
                <div class="producto">
                    <a href="producto.php?dnf=<?php echo $mostrar['ID']; ?>"><img class="producto__imagen" src="img/<?php echo $mostrar['nombreImagen']; ?>" alt="imagen del producto"></a>
                    <a class="producto__nombre" href="producto.php?dnf=<?php echo $mostrar['ID']; ?>"><h3><?php echo $mostrar['nombre'];?></h3></a>
                    <p class="producto__precio">$<?php echo $mostrar['precio'];?></p>
                    <a class="producto__enlace" href="producto.php?dnf=<?php echo $mostrar['ID']; ?>">Ver mas</a>
                </div> <!-- .producto -->
    <?php
            }//while
            $conexion->close();
        }//mostrarProductos
        $conexion->close();
        include("../Partes/footer-page/index.html");
    ?>

</body>
</html>