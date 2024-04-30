<?php
    include('../../Conexion/conexion.php');
    session_start();
?>
<?php include '../LoginU/inicio.php'; ?>
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
    <title>Productos</title>
</head>
<body>
    <?php include '../Partes/MenuUsuario.php'; ?>
    <div class="home">
            <header class="cabecera">
                <img class="cabecera__imagen" src="img/cabecera.jpg" alt="imagen inicio">    
                <div class="cabecera__hero">
                    <div class="cabecera__contenido_1">
                        <h1>Poli-Commerce</h1>
                        <p class="cabecera__texto">Descubre una amplia variedad de productos únicos ofrecidos por nuestros vendedores. ¡Apoya a los emprendedores y disfruta de una experiencia de compra única!</p>
                        <a class="cabecera__enlace" href="#explorar">Explorar productos</a>
                    </div> <!-- .cabecera__contenido_1 -->
                    <div class="cabecera__contenido_2">
                        <h2>Bienvenido a Poli_Commerce</h2>
                        <p>Explora nuestra selección de productos únicos y encuentra lo que buscas</p>
                    </div> <!-- .cabecera__contenido_2 -->
                </div> <!-- .cabecera__hero -->
            </header>


            <nav class="navegacion" id="navegacion">
                <a class="navegacion__enlace" href="#alimentos">Alimentos y bebidas</a>
                <a class="navegacion__enlace" href="#tecnologia">Tecnología</a>
                <a class="navegacion__enlace" href="#ropa">Ropa y moda</a>
                <a class="navegacion__enlace" href="#joyeria">Joyería y accesorios</a>
                <a class="navegacion__enlace" href="#servicios">Servicios</a>
            </nav>

            <div id="explorar"></div>

            <main class="contenedor-principal">

                <section class="alimentos contenedor" id="alimentos">
                    <h2 class="alimentos__titulo subtitulo">Alimentos y bebidas</h2>
                    <div class="productos">
                        <?php 
                            mostrarProductos("Alimentos y bebidas");
                        ?>
                    </div> <!-- .productos -->
                </section> <!-- .alimentos -->

                <section class="contenedor-publicidad contenedor">
                    <h2 class="contenedor-publicidad__titulo subtitulo">Encuentra todo lo que buscas</h2>
                    <div class="publicidad">
                        <div class="publicidad__elemento">
                            <img class="publicidad__imagen imagen-redonda" src="img/alimentos.png" alt="imagen de la categoria">
                            <h3 class="publicidad__titulo">Alimentos y bebidas</h3>
                        </div> <!-- .publicidad__elemento -->
                        <div class="publicidad__elemento">
                            <img class="publicidad__imagen imagen-redonda" src="img/tecnologia.jpg" alt="imagen de la categoria">
                            <h3 class="publicidad__titulo">Tecnología</h3>
                        </div> <!-- .publicidad__elemento -->
                        <div class="publicidad__elemento">
                            <img class="publicidad__imagen imagen-redonda" src="img/ropa.jpg" alt="imagen de la categoria">
                            <h3 class="publicidad__titulo">Ropa y moda</h3>
                        </div> <!-- .publicidad__elemento -->
                        <div class="publicidad__elemento">
                            <img class="publicidad__imagen imagen-redonda" src="img/joyeria.jpg" alt="imagen de la categoria">
                            <h3 class="publicidad__titulo">Joyería y accesorios</h3>
                        </div> <!-- .publicidad__elemento -->
                        <div class="publicidad__elemento">
                            <img class="publicidad__imagen imagen-redonda" src="img/servicios.jpg" alt="imagen de la categoria">
                            <h3 class="publicidad__titulo">Servicios</h3>
                        </div> <!-- .publicidad__elemento -->
                    </div> <!-- .publicidad -->
                </section> <!-- .contenedor-publicidad -->

                <section class="tecnologia contenedor" id="tecnologia">
                    <h2 class="tecnologia__titulo subtitulo">Tecnología</h2>
                    <div class="productos">
                        <?php
                            mostrarProductos("Tecnología");
                        ?>
                    </div> <!-- .productos -->
                </section> <!-- .tecnologia -->

                <section class="ropa contenedor" id="ropa">
                    <h2 class="ropa__titulo subtitulo">Ropa y moda</h2>
                    <div class="productos">
                        <?php 
                            mostrarProductos("Ropa y moda");
                        ?>
                    </div> <!-- .productos -->
                </section> <!-- .ropa -->

                <section class="joyeria contenedor" id="joyeria">
                    <h2 class="joyeria__titulo subtitulo">Joyería y accesorios</h2>
                    <div class="productos">
                        <?php 
                            mostrarProductos("Joyería y accesorios");
                        ?>
                    </div> <!-- .productos -->
                </section> <!-- .joyeria -->

                <section class="servicios contenedor" id="servicios">
                    <h2 class="servicios__titulo subtitulo">Servicios</h2>
                    <div class="productos">
                        <?php 
                            mostrarProductos("Servicios");
                        ?>
                    </div> <!-- .productos -->
                </section> <!-- .servicios -->
                
                <section class="vendedores contenedor">
                    <a href="vendedores.php">Vendedores</a>
                </section>

            </main>

    </div> <!-- .home -->

    <script src="js/java.js"></script>

    <?php 
        function mostrarProductos($nombreCategoria){
            $db = new Database();
            $conexion = $db->connect();

            $consulta = "SELECT * FROM productos where categoria='$nombreCategoria' "; 
            $resultado = mysqli_query($conexion, $consulta);
            while($mostrar=mysqli_fetch_array($resultado)){
    ?>
                <div class="producto">
                    <a href="producto.php?dnf=<?php echo $mostrar['ID']; ?>"><img class="producto__imagen" src="img/<?php echo $mostrar['nombreImagen']; ?>" alt="imagen del producto"></a>
                    <a class="producto__nombre" href="producto.php?dnf=<?php echo $mostrar['ID']; ?>"><h3><?php echo $mostrar['nombre'];?></h3></a>
                    <p class="producto__precio">$<?php echo $mostrar['precio'];?></p>
                    <a class="producto__enlace" href="producto.php?dnf=<?php echo $mostrar['ID']; ?>">Ver más</a>
                </div>
    <?php   
            }//while
            $conexion->close();
        }//mostrarProductos
        include("../Partes/footer-page/index.html");
    ?>
</body>
</html>