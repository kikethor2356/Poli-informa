<?php
    include("../../Conexion/conexion.php");
    $db = new Database();
    $conexion = $db->connect();
    session_start();
?>
<?php include '../LoginA/inicio.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/ventanaAdministradores.css">
    <link rel="stylesheet" href="../Menu/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="style/diseño.css">
    <script src="js/productos.js"></script>
    <title>Administrador - Productos</title>
</head>
<body>
    <div id="cafeteria">
        <!-- OPCIONES DEL ADMINISTRADOR -->
        <?php include '../Menu/menu.html'; ?>
        
        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">
            <section id="section-productos">
                    <div id="mostrarProductosPendientes">
                        <h1>Lista de productos pendientes</h1>
                        <!-- <input type="text" id="buscar-producto" placeholder="Ingresar nombre del producto"> -->
                        <!-- <a class="modal_abrir_agregar_producto" onclick="modalAgregarProducto()"><button id="nuevoProducto" name="nuevoProducto"><i class="fa-solid fa-plus"></i>&nbsp;Agregar producto</button></a> -->

                        <!-- Controles de paginación -->
                        <div id="paginacion">
                            <form action="" method="GET">
                                <label for="resultados_por_pagina">Mostrar 
                                <select name="resultados_por_pagina" id="resultados_por_pagina" onchange="this.form.submit()">
                                    <option value="4" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 4) echo 'selected'; ?>>4</option>
                                    <option value="6" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 6) echo 'selected'; ?>>6</option>
                                    <option value="8" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 8) echo 'selected'; ?>>8</option>
                                </select>
                                Producto</label>
                            </form>
                            <?php

                            $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 8;
                            $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                            $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                            $sql = "SELECT COUNT(*) AS total FROM productos";
                            $resultado = mysqli_query($conexion, $sql);
                            $fila = mysqli_fetch_assoc($resultado);
                            $total_resultados = $fila['total'];
                            $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                            $consulta = "SELECT * FROM productos_pendientes LIMIT $inicio, $resultados_por_pagina";
                            $resultado = mysqli_query($conexion, $consulta);
                            ?>
                        </div>

                        <table id="tablaProductosPendientes" border="1px">
                            <thead id="cabeceraTablaProductoPendiente">
                                <tr>
                                    <th id="cabezaNombreProductoPendiente">Producto</th>
                                    <th id="cabezaVendedorProductoPendiente">Vendedor</th>
                                    <th id="cabezaPrecioProductoPendiente">Precio</th>
                                    <th id="cabezaDescripcionProductoPendiente">Descripción</th>
                                    <th id="cabezaImagenProductoPendiente">Imagen</th>
                                    <th id="cabezaCategoriaProductoPendiente">Categoría</th>
                                    <th id="cabezaAccionesProductoPendiente">Acciones</th>
                                </tr>
                            </thead>
                            <?php 
                            $contador = 1; //LLEVA EL SEGUIMIENTO DE LAS FILAS
                            while($mostrar=mysqli_fetch_array($resultado)) {
                                //DETERMINA LA CLASE QUE SE ASIGNARÁ A CADA FILA EN FUNCIÓN DE SI ES PAR O IMPAR
                                $clase_fila = ($contador % 2 == 0) ? 'fila2' : 'fila1';
                                ?>
                                <tr>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombreProductoPendiente" name="campoNombreProductoPendiente" value="<?php echo $mostrar['nombre']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoVendedorProductoPendiente" name="campoVendedorProductoPendiente" value="<?php echo $mostrar['codigoVendedor']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoPrecioProductoPendiente" name="campoPrecioProductoPendiente" value="<?php echo $mostrar['precio']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoDescripcionProductoPendiente" name="campoDescripcionProductoPendiente" value="<?php echo $mostrar['descripcion']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoImagenProductoPendiente" name="campoImagenProductoPendiente" value="<?php echo $mostrar['nombreImagen']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCategoriaProductoPendiente" name="campoCategoriaProductoPendiente" value="<?php echo $mostrar['categoria']?>" readonly></td>
                                    <td id="campoAccionesProductoPendiente" name="campoAccionesProductoPendiente" class="<?php echo $clase_fila; ?>">
                                        <a class="modal_abrir_borrar_producto_pendiente_<?php echo $mostrar['ID'];?>" onclick="modalBorrarProductoPendiente('<?php echo $mostrar['ID'];?>', 
                                        '<?php echo $mostrar['nombreImagen'];?>')">
                                        <img src="iconos/basura.png" alt="eliminar" id="iconoEliminar" title="Eliminar registro"></a>
                                        
                                        <a class="modal_abrir_ver_producto_pendiente_<?php echo $mostrar['ID'];?>" onclick="modalVerProductoPendiente('<?php echo $mostrar['ID'];?>', 
                                        '<?php echo $mostrar['nombre'];?>', '<?php echo $mostrar['codigoVendedor'];?>', '<?php echo $mostrar['precio'];?>', 
                                        '<?php echo $mostrar['descripcion'];?>', '<?php echo $mostrar['nombreImagen'];?>', '<?php echo $mostrar['categoria'];?>')">
                                        <img src="iconos/ver.png" alt="ver" id="iconoVer" title="Ver registro"></a>

                                        <a class="modal_abrir_aceptar_producto_pendiente_<?php echo $mostrar['ID']; ?>" onclick="modalAceptarProductoPendiente('<?php echo $mostrar['ID'];?>')">
                                            <img src="iconos/aceptar.png" alt="aceptar" id="iconoAceptarProductoPendiente" title="Aceptar producto">
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                // Incrementa el contador
                                $contador++;
                            }
                            ?>
                        </table>
                        <!-- Navegación entre páginas -->
                        <div id="paginacion">
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
                        </div>
                    </div>
                    <!-- FIN PARA MOSTRAR PRODUCTOS -->

                <!-- VENTANAS MODALES PARA PRODUCTOS -->

                <!-- VENTANA PARA AGREGAR PRODUCTO -->
                <div class="modal_agregar_producto">
                    <div id="agregar">
                        <!-- DATOS DEL PRODUCTO -->
                        <div id="ventana-agregar-producto">
                            <div id="cerrar" class="modal_cerrar_agregar_producto">✖</div>
                            <h1>Nuevo Producto</h1>
                            <form action="PHP/Acciones.php?metodo=1" method="POST" id="contenedor" name="contenedor" enctype="multipart/form-data">
                                <input type="text" id="nombre" name="nombre" placeholder="Nombre del producto"><br><br>
                                <input type="text" id="codigoVendedor" name="codigoVendedor" placeholder="Vendedor"><br>
                                <p>Precio:  $ <input type="text" id="precio" name="precio"> MXN</p>
                                <textarea id="descripcion" name="descripcion" placeholder="Descripción" ></textarea><br><br>
                                <input type="file" id="imagen" name="imagen" onchange="archivoSeleccionado(event)" accept="image/jpeg, image/png">
                                <label for="imagen" id="labelArchivo"><i class="fa-solid fa-upload"></i>  elegir imagen</label><br><br>
                                <input type="text" id="nombreArchivo" readonly><br>
                                <input type="submit" value="Subir producto" id="enviar" name="enviar">
                        <!-- FIN DATOS DEL PRODUCTO-->

                        <!-- PIDE LA CATEGORÍA A LA QUE PERTENECE EL PRODUCTO -->
                        <div id="contenedor-categoria">
                            <h2>Categoría del producto</h2>
                            <ul>
                                <li>
                                    <input type="radio" name="categoria" id="Dulce" value="Dulce" checked>
                                    <label for="Dulce">Dulce</label>

                                </li>
                                <li>
                                    <input type="radio" name="categoria" id="Salado" value="Salado">
                                    <label for="Salado">Salado</label>

                                </li>
                                <li>
                                    <input type="radio" name="categoria" id="Mezclado" value="Mezclado">
                                    <label for="Mezclado">Mezclado</label>
                                </li>
                                <li>
                                    <input type="radio" name="categoria" id="Tecnología" value="Tecnología">
                                    <label for="Tecnología">Tecnología</label>
                                </li>
                            </ul>
                        <!-- FIN DIV AGREGAR CATEGORÍA -->
                        </div>
                            </form>
                        <!-- FIN DE LA OPCIÓN PARA AGREGAR UN PRODUCTO -->
                        </div>
                        <!-- FIN DEL CONTENEDOR PARA AGREGAR PRODUCTO -->
                    </div>
                </div>
                <!-- FIN DE LA VENTANA MODAL PARA AGREGAR PRODUCTO -->                            
                <!-- VENATANA DE VERIFICACION -->
                <?php
                if(isset($_SESSION['success']) && $_SESSION['success']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Agregar',
                                text: 'El registro fue todo un éxito',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>";
                    unset($_SESSION['success']); // Eliminar la variable de sesión
                } else if(isset($_SESSION['error']) && $_SESSION['error']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'El registro no fue posible, inténtelo de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    unset($_SESSION['error']); // Eliminar la variable de sesión
                }
                ?>
                <!-- FIN DE VENTANA DE VERIFICACION -->

                <!-- VENTANA MODAL PARA VER PRODUCTO PENDIENTE-->
                <div class="modal_ver_producto_pendiente">    
                    <div id="ventana-ver-producto-pendiente">
                        <h1>Producto pendiente</h1>
                        <div id="iconoSalirProductoPendiente" class="modal_cerrar_ver_producto_pendiente">✖</div>
                        <form action="PHP/Acciones.php?metodo=9" method="POST" id="formulario-ver-producto-pendiente" enctype="multipart/form-data">
                            <label for="idProductopendiente" id="paraIdProductoPendiente" hidden>ID: </label>
                            <input type="text" id="idVerProducto" name="idVerProducto" value="" hidden><br>
                            <label for="nombreVerProductoPendiente">Nombre:</label>
                            <input type="text" id="nombreVerProductoPendiente" name="nombreVerProductoPendiente" class="texto" value="" readonly><br><br>
                            <label for="vendedor">Vendedor:</label>
                            <input type="text" id="vendedorVerProductoPendiente" name="vendedorVerProductoPendiente" class="texto" value="" readonly><br><br>   
                            <label for="precio">Precio: </label>
                            <input type="text" id="precioVerProductoPendiente" name="precioVerProductoPendiente" class="texto" value="" readonly><br><br>
                            <label for="descripcionEditar">Descripción: </label><br>
                            <textarea name="descripcionVerProductoPendiente" id="descripcionVerProductoPendiente" readonly></textarea><br><br>
                            <input type="file" id="archivoVerProductoPendiente" name="archivoVerProductoPendiente" onchange="mostrarArchivoEnEditar(event)" accept="image/jpeg, image/png">
                            <label for="archivoEditarProducto" id="label-archivo-producto-pendiente">Imagen</label>
                            <input type="text" id="rutaArchivoVerProductoPendiente" name="rutaArchivoVerProductoPendiente" readonly value=""><br><br>
                            <label for="comboBoxCategoriaVerProductoPendiente">Categoria: </label>
                            <!-- <select id="comboBoxCategoriaVerProductoPendiente" name="comboBoxCategoriaVerProductoPendiente">
                                <option value="Dulce">Dulce</option>
                                <option value="Salado">Salado</option>
                                <option value="Mezclado">Mezclado</option>
                                <option value="Tecnología">Tecnología</option>
                            </select> -->
                            <input type="text" id="categoriaVerProductoPendiente" name="categoriaVerProductoPendiente" class="texto" readonly>
                            <div id="rayaVerProductoPendiente"></div>
                            <!-- <input type="submit" id="verProductoPendiente" name="verProductoPendiente" value="Guardar"> -->
                        </form>     
                    </div>
                </div>
                <!--  FIN DE LA VENTANA MODAL PARA VER PRODUCTOS PENDIENTES-->
               


                <!-- VENTANA MODAL PARA BORRAR PRODUCTOS -->
                <div class="modal_borrar_producto_pendiente">
                    <div id="ventana-eliminar-producto-pendiente">
                        <h1>Eliminar registro</h1>
                        <div id="salirProductoPendiente" class="modal_cerrar_borrar_producto_pendiente">✖</div>
                        <div id="raya1ProductoPendiente"></div>
                        <form action="PHP/Acciones.php?metodo=9" method="post" enctype="multipart/form-data" id="formulario-eliminar">
                            <div id="contenedor-eliminar-producto-pendiente">
                                <p>¿Desea eliminar el producto pendiente?</p>
                            </div>
                            <input type="text" id="idEliminarProductoPendiente" name="idEliminarProductoPendiente" value="" hidden>                            
                            <input type="text" id="archivoEliminarProductoPendiente" name="archivoEliminarProductoPendiente" value="" hidden>
                            <input type="submit" name="borrarProductoPendiente" id="borrarProductoPendiente" value="Borrar">
                            
                        </form>
                        <div id="raya2ProductoPendiente"></div>
                    </div>
                </div>           
                <!-- FIN DE LA VENTANA MODAL PARA BORRAR PRODUCTOS PENDIENTES--> 
                <!-- VENATANA DE VERIFICACION -->
                <?php
                if(isset($_SESSION['success9']) && $_SESSION['success9']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Eliminar',
                                text: 'La eliminación fue todo un éxito',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>";
                    unset($_SESSION['success9']); // Eliminar la variable de sesión
                } else if(isset($_SESSION['error9']) && $_SESSION['error9']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No fue posible eliminarlo, inténtelo de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    unset($_SESSION['error9']); // Eliminar la variable de sesión
                }
                ?>
                <!-- FIN DE VENTANA DE VERIFICACION -->      
                
                <!-- VENTANA MODAL PARA ACEPTAR PRODUCTOS PENDIENTES -->
                <div class="modal_aceptar_producto_pendiente">
                    <div id="ventana-aceptar-producto-pendiente">
                        <h1>Aceptar producto</h1>
                        <div id="salirProductoPendiente" class="modal_cerrar_aceptar_producto_pendiente">✖</div>
                        <div id="raya1ProductoPendiente"></div>
                        <form action="PHP/Acciones.php?metodo=10" method="post" enctype="multipart/form-data" id="formulario-aceptar-producto-pendiente">
                            <div id="contenedor-aceptar-producto-pendiente">
                                <p>¿Desea confirmar el producto?</p>
                            </div>
                            <input type="text" id="idAceptarProductoPendiente" name="idAceptarProductoPendiente" value="" hidden>                            
                            <input type="text" id="archivoAceptarProductoPendiente" name="archivoAceptarProductoPendiente" value="" hidden>
                            <input type="submit" name="aceptarProductoPendiente" id="aceptarProductoPendiente" value="Agregar">
                        </form>
                        <div id="raya2ProductoPendiente"></div>
                    </div>
                </div>           
                <!-- FIN DE LA VENTANA MODAL PARA ACEPTAR PRODUCTOS PENDIENTES--> 
                <!-- VENATANA DE VERIFICACION -->
                <?php
                if(isset($_SESSION['success10']) && $_SESSION['success10']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Eliminar',
                                text: 'Producto agregado',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>";
                    unset($_SESSION['success10']); // Eliminar la variable de sesión
                } else if(isset($_SESSION['error10']) && $_SESSION['error10']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No fue posible agregarlo, inténtelo de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    unset($_SESSION['error10']); // Eliminar la variable de sesión
                }
                ?>
                <!-- FIN DE VENTANA DE VERIFICACION -->



            </section>
        </main>
    </div>
</body>
</html>