<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/productos.css">
    <link rel="stylesheet" href="../style/diseñoFunciones.css">
    <script src="../js/productos.js"></script>
    <title>Administrador - Productos</title>
</head>
<body>
    
    <div id="productos">

        <!-- BARRA SUPERIOR -->
        <header id="cabecera-productos">

            
        </header>


        <!-- OPCIONES DEL ADMINISTRADOR -->
        <nav id="navegacion-productos">        
            
            <h4>Productos</h4>
            
            <ul id="opciones-productos">
                <li onclick="mostrarAgregarProducto()"><img src="../iconos/agregar.png" alt="">   Agregar</li>
                <li><img src="../iconos/eliminar.png" alt="">   Eliminar</li>
                <li><img src="../iconos//editar.png" alt="">   Editar</li>
                <li><img src="../iconos/mostrar.png" alt="">   Mostrar</li>
                <li><img src="../iconos/buscar.png" alt="">   Buscar</li>
                <li><img src="../iconos/estadisticas.png" alt="">   Estadísticas</li>
            </ul>

        </nav>



        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">

            <section id="section-productos">

                <!-- OPCIÓN PARA AGREGAR PRODUCTO -->
                <div id="agregar" hidden>

                    <!-- DATOS DEL PRODUCTO -->
                    <h1>Agregar producto</h1>

                    <div id="agregar-producto">

                        <h2>Nuevo producto</h2>

                        <form action="BD/agregarProducto.php" method="post" id="contenedor" name="contenedor">

                            <input type="text" id="nombre" name="nombre" placeholder="nombre del producto"><br><br>

                            <textarea id="descripcion" name="descripcion" cols="60" rows="5" placeholder="Descripción"></textarea>

                            <p>Precio: $ <input type="text" id="precio" name="precio"> MXN</p>

                            <input type="file" name="imagen" id="imagen" accept="image/*"><br><br>

                            <input type="submit" value="Guardar" id="enviar" name="enviar">

                    </div>
                    <!-- FIN DATOS DEL PRODUCTO-->

                    <!-- PIDE LA CATEGORÍA A LA QUE PERTENECE EL PRODUCTO -->
                    <div id="categoria" class="categoria">

                        <h3>¿A qué categoría pertenece tu producto?</h3>

                        <input type="radio" id="categoria1" name="categorias" class="nueva" value="dulce">

                        <label for="categoria1">Dulce</label><br>

                        <input type="radio" id="categoria2" name="categorias" value="salado">

                        <label for="categoria2">Salado</label><br>

                        <input type="radio" id="categoria3" name="categorias" value="ropa">

                        <label for="categoria3">Ropa</label><br>

                        <input type="radio" id="categoria4" name="categorias" value="calzado">

                        <label for="categoria4">Calzado</label><br>
                        
                        <input type="radio" id="categoria5" name="categorias" value="electronica" >

                        <label for="categoria5">Electrónica</label>
                        
                    </div>
                    <!-- FIN PARA ELEGIR LA CATEGORÍA -->

                    </form>

                </div>
                <!-- FIN DE LA OPCIÓN PARA AGREGAR UN PRODUCTO -->


            </section>

        </main>





        <!-- PIE DE PÁGINA -->
        <footer id="pie-productos">


        </footer>
    

    </div>






</body>
</html>