<?php
    include('../../Conexion/conexion.php');
    include '../LoginA/inicio.php';
    $db = new Database();
    $conexion = $db->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AdminCafeteria.css">
    <script src="js/AdminCafeteria.js"></script>
    <!-- Link separados (iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Administración Cafeteria</title>
</head>
<body>
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
    <!-- Ventana emergente para agregar producto -->
    <div class="ventanaEmergente">
        <div class="contenidoVentanaEmergente">
            <h2>Agregar Producto</h2>
            <div id="ventana-cerrar1" class="cerrar-ventanaAgregar"><i class="fa-solid fa-x"></i></div>
            <form action="Agregar/InsertarDatosCafeteria1.php" method="POST" enctype="multipart/form-data">

                <input type="text" id="nombre" name="nombre_producto" required placeholder="Nombre de Producto">

                <textarea id="descripcion" name="descripcion" required placeholder="Descripción"></textarea>

                <p>Precio $<input type="number" id="precio" name="precio" required placeholder="$00.00"> MXN</p>

                <div id="contenedor-imagen">                   
                    <input type="file" name="imagen" id="imagenInput" onchange="previewImage()" required> 
                    <label for="imagenInput" id="imagen"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label>
                    <img src="" id="imagenPreview" alt="Imagen del producto">
                    <input type="text" id="nombreArchivo" readonly>
                </div>

                <p>Categoría</p>
                <select name="categoria_nombre" id="categoria_nombre" required>
                    <option selected disabled>----Seleccionar----</option>
                    <?php 
                    $sql = $conexion->query("SELECT * FROM categorias_cafeteria");
                    while($resultado = $sql->fetch_assoc()){
                        echo "<option value='".$resultado['categoria_id']."'>".$resultado['categoria_nombre']."</option>";
                    }
                    ?>
                </select>

                <button type="submit" name="Agregar1" id="Agregar1">Agregar Producto</button>
                <button type="button" class="ventanacerrar" onclick="limpiarDatos()">Cancelar</button>
            </form>
        </div>
    </div>
    <!-- Fin de la ventana emergente -->

    <?php
    if(isset($_SESSION['success1']) && $_SESSION['success1']) {
        echo "<script>
                Swal.fire({
                    title: 'Editar',
                    text: 'La editación fue todo un exito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
        unset($_SESSION['success1']); // Eliminar la variable de sesión
    } else if(isset($_SESSION['error1']) && $_SESSION['error1']) {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No fue posible editarlo, inténtelo de nuevo',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            </script>";
        unset($_SESSION['error1']); // Eliminar la variable de sesión
    }
    ?>
    <!-- Ventana emergente para editar producto -->
    <div class="ventanaEditarProducto">
        <div class="contenidoVentanaEditarProducto">
            <h2>Editar Producto</h2>
            <div id="ventana-cerrar2" class="cerrar-ventanaEditar" onclick="cerrarVentanaEditar()"><i class="fa-solid fa-x"></i></div>
            <form action="Agregar/EditarDatosCafeteria1.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="cafeteriamaid" name="cafeteriamaid">

                <p>Nombre <input type="text" id="nombre_producto1" name="nombre_producto" placeholder="Nombre del producto"></p>

                <p>Descripción</p> 
                <textarea name="descripcion" id="descripcion1" placeholder="Descripción del producto"></textarea>

                <p>Precio $<input type="number" id="precio1" name="precio" placeholder="$00.00"> MXN</p>

                <div id="contenedor-imagen1">
                    <label id="imagen_mos">Imagen</label>
                    <input type="file" name="imagen" id="imagenInputEditar" onchange="previewImageEditar(this)">
                    <input type="hidden" name="imagen_old" id="imagen_old">
                    <label for="imagenInputEditar" id="imagen1"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label>
                    <img src="" alt="" id="imagenPreviewEditar">
                    <input type="text" id="nombreArchivoEditar" readonly>
                </div>
                
                <p>Categoría</p>
                <select name="categoria_nombre" id="categoria_nombre1">
                    <option selected disabled>----Seleccionar----</option>
                    <?php
                        $categoria_id = $_GET['categoria_id'];
                        $sql1 = "SELECT * FROM categorias_cafeteria WHERE categoria_id='$categoria_id'";
                        $resultado1 = $conexion->query($sql1);

                        $row1 = $resultado1->fetch_assoc();

                        echo "<option selected value='".$row1['categoria_id']."'>".$row1['categoria_nombre']."</option>";

                        $sql2 = "SELECT * FROM categorias_cafeteria";
                        $resultado2 = $conexion->query($sql2);

                        while($fila = $resultado2->fetch_array()){
                            echo "<option value='".$fila['categoria_id']."'>".$fila['categoria_nombre']."</option>";
                        }                 
                    ?>
                </select>
            
                <button type="submit" name="Editar1" id="Editar1">Guardar cambios</button>
                <button type="button" class="ventanacerrarEditar" onclick="cerrarVentanaEditar()">Cancelar</button>
            </form>
        </div>
    </div>
    <!-- Fin de la ventana emergente de edición -->

    <!-- Ventana emergente para visualizar producto -->
    <div class="ventanaVisualizarProducto" id="ventanaVisualizarProducto">
        <div class="contenidoVentanaVisualizarProducto">
            <!-- Contenido de la ventana emergente de visualización -->
            <h2>Mostrar Producto</h2>
            <div id="ventana-cerrar3" class="cerrar-ventanaMostrar" onclick="cerrarVentanaVisualizar()"><i class="fa-solid fa-x"></i></div>
            <p id="nombreProducto"></p>
            <textarea id="descripcionProducto"></textarea>
            <p id="precioProducto"></p>
            <p id="categoriaProducto"></p>
            <div id="contenedor-imagen3">
                <img id="imagenProducto" src="" alt="">    
            </div>
            <button onclick="cerrarVentanaVisualizar()" class="vetanacerrarvista">Cerrar</button>
        </div>
    </div>
    <!-- Fin de la ventana emergencia visualizar -->

    <div id="productos">
        <!-- OPCIONES DEL ADMINISTRADOR -->
        <?php include '../Menu/menu.html'; ?>

        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">
            <section id="section-productos">
                <div id="mostrarProductos">
                    <h2>CAFETERIA MODULO A</h2>

                    <button id="nuevoProducto" class="nuevoProducto" name="nuevoProducto" title="Agregar Producto" onclick="mostrarVentana()"><i class="fa-solid fa-circle-plus"></i> Agregar Producto</button>   

                    <!-- Controles de paginación -->
                    <div id="paginacion">
                        <form action="" method="GET">
                            <label for="resultados_por_pagina">Mostrar 
                            <select name="resultados_por_pagina" id="resultados_por_pagina" onchange="this.form.submit()">
                                <option value="4" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 4) echo 'selected'; ?>>4</option>
                                <option value="7" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 7) echo 'selected'; ?>>7</option>
                                <option value="10" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 10) echo 'selected'; ?>>10</option>
                            </select>
                             Producto</label>
                        </form>
                        <?php
                        
                        $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 10;
                        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                        $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                        $sql = "SELECT COUNT(*) AS total FROM cafeteriamodulo_a";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM cafeteriamodulo_a INNER JOIN categorias_cafeteria ON cafeteriamodulo_a.prodcategoria_id = categorias_cafeteria.categoria_id LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $sql);
                        ?>
                    </div>

                    <!-- Datos para registrar de cafeteria modulo a -->
                    <table id="tablaProductos" border="1px">
                        <thead id="cabeceraTabla">
                            <tr>
                                <th id="cabezaNombre">Producto</th>
                                <th id="cabezaDescripcion">Descripcion</th>
                                <th id="cabezaPrecio">Precio</th>
                                <th id="cabezaImagen">Imagen</th>
                                <th id="cabezaCategoria">Categoria</th>
                                <th id="cabezaAcciones">Acciones</th>
                            </tr>
                        </thead>
                        <?php 
                        if(mysqli_num_rows($resultado) > 0){  
                            $contador = 1; // Inicializar el contador dentro del bucle

                            foreach($resultado as $row){
                                // DETERMINA LA CLASE QUE SE ASIGNARÁ A CADA FILA EN FUNCIÓN DE SI ES PAR O IMPAR
                                $clase_fila = ($contador % 2 == 0) ? 'fila2' : 'fila1';
                                    
                                ?>
                                <tr>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row['nombre_producto']; ?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoDescripcion" value="<?php echo $row['descripcion']; ?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoPrecio" value="<?php echo $row['precio']; ?>" readonly></td>
                                    <!-- <td class="<?php echo $clase_fila; ?>" id="campoImagen"><img src="<?php echo "Agregar/temp/".$row['imagen']; ?>" width = "300px" height = "120px" alt="Imagenes"></td> -->
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoImagen" value="<?php echo $row['imagen']; ?>" readonly></td>
                                    <!-- en vez de utilizar prodcategoria_id utilizo lo que quiero que muestre, ya que INNER JOIN sirve para relacionar tablas y me deja usar el la variable de la tabla, ojo debe de ser en la misma posicion porque da error-->
                                    <td class="<?php echo $clase_fila; ?>"><input type="text"  id="campoCategoria" value="<?php echo $row['categoria_nombre'] ?>" readonly></td>
                                    <!-- Botones de Editar y Eliminar  -->
                                    <td id="cabezaAcciones" class="<?php echo $clase_fila; ?>">
                                        <div class="acciones-buttons">
                                            <button type="button" class="iconoVer" title="Ver registro" onclick="abrirVentanaVisualizar('<?php echo $row['nombre_producto']; ?>', '<?php echo $row['descripcion']; ?>', '<?php echo $row['precio']; ?>', '<?php echo $row['imagen']; ?>', '<?php echo $row['categoria_nombre']; ?>')"><i class="fa-regular fa-eye"></i></button>
                                            <button type="button" class="iconoEditar" title="Editar registro" onclick="abrirVentanaEditar('<?php echo $row['cafeteriama_id']; ?>', '<?php echo $row['nombre_producto']; ?>', '<?php echo $row['descripcion']; ?>', '<?php echo $row['precio']; ?>', '<?php echo $row['imagen']; ?>', '<?php echo $row['categoria_nombre']; ?>', '<?php echo $row['prodcategoria_id']; ?>', '<?php echo $row['imagen']; ?>')"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form id="eliminarForm_<?php echo $row['cafeteriama_id']; ?>" action="Agregar/EliminarCafeteria1.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="eliminar_id" value="<?php echo $row['cafeteriama_id']; ?>">
                                                <input type="hidden" name="eliminar_imagen" value="<?php echo $row['imagen']; ?>">
                                                <!-- Ventana emergente de confirmación -->
                                                <div class="contenedor-modal">
                                                    <div class="contenedor-eliminar">
                                                        <p>¿Seguro que quieres eliminar el registro?</p>
                                                        <button type="submit" class="confirmarBtn" name="Eliminar_imag_id" id="Eliminar_imag_id">Eliminar</button>
                                                        <button type="button" class="cancelarBtn" onclick="cerrarVentanaEliminar()">Cancelar</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="iconoEliminar" title="Eliminar registro" onclick="mostrarConfirmacion('<?php echo $row['cafeteriama_id']; ?>')"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                // Incrementa el contador
                                $contador++;
                            }
                        } else{
                            ?>
                                <tr><td colspan="2">No hay categorías disponibles.</td></tr>
                            <?php
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
            </section>
        </main>
    </div>
    <?php
    if(isset($_SESSION['success2']) && $_SESSION['success2']) {
        echo "<script>
                Swal.fire({
                    title: 'Eliminar',
                    text: 'La eliminación fue todo un exito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
        unset($_SESSION['success2']); // Eliminar la variable de sesión
    } else if(isset($_SESSION['error2']) && $_SESSION['error2']) {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No fue posible eliminarlo, inténtelo de nuevo',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            </script>";
        unset($_SESSION['error2']); // Eliminar la variable de sesión
    }
    ?>
</body>
</html>