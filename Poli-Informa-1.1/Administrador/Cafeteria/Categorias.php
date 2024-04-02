<?php
include('../../Conexion/conexion.php');
session_start();
$db = new Database();
$conexion = $db->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/AdminCafeteria.css">
    <link rel="stylesheet" href="../menu.css">
    <script src="js/Categorias.js"></script>
    <!-- Link separados (iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Administracion Cafeteria</title>
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
    <div class="ventanaEmergenteCategoria">
        <div class="contenidoVentanaEmergenteCategoria">
            <div id="ventana-cerrarCategoria" class="cerrar-ventanaAgregarCate"><i class="fa-solid fa-x"></i></div>
            <h2>Agregar Categoria</h2>
            <form action="Agregar/InsertarCategoria.php" method="POST" enctype="multipart/form-data">

                <input type="text" id="nombrecategoria" name="categoria_nombre" required placeholder="Nombre de la categoria">

                <button type="submit" name="Agregar1" id="Agregar1Categoria">Agregar Categoria</button>
                <button type="button" class="ventanacerrarCategoria" onclick="limpiarDatos()">Cancelar</button>
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
    <div class="ventanaEditarProductoCategoria">
        <div class="contenidoVentanaEditarProductoCategoria">
            <h2>Editar Producto</h2>
            <div id="ventana-cerrar2Categoria" class="cerrar-ventanaEditarCategoria" onclick="cerrarVentanaEditar()"><i class="fa-solid fa-x"></i></div>
            <form action="Agregar/EditarDatosCategoria.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="categoria_id" name="categoria_id">

                <p>Nombre <input type="text" id="categoria_nombre" name="categoria_nombre" placeholder="Nombre de la categoria"></p>

                <button type="submit" name="Editar1" id="Editar1Categoria">Guardar cambios</button>
                <button type="button" class="ventanacerrarEditarCategoria" onclick="cerrarVentanaEditar()">Cancelar</button>
            </form>
        </div>
    </div>
    <!-- Fin de la ventana emergente de edición -->

    <div id="productos">
        <!-- OPCIONES DEL ADMINISTRADOR -->
        <?php include '../menu.html'; ?>

        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">
            <section id="section-productos">
                <div id="mostrarProductos">
                    <center><h2>CATEGORIAS EN CAFETERIA</h2></center>

                    <button id="nuevoProducto" class="nuevoProducto" name="nuevoProducto" title="Agregar Producto" onclick="mostrarVentana()"><i class="fa-solid fa-circle-plus"></i> Agregar Categoria</button>

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

                        $sql = "SELECT COUNT(*) AS total FROM categorias_cafeteria";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM categorias_cafeteria LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $sql);
                        ?>
                    </div><br><br>

                    <!-- Datos para registrar de cafeteria modulo a -->
                    <table id="tablaProductosCategoria" border="1px">
                        <thead id="cabeceraTabla">
                            <tr>
                                <th id="cabezaNombreCategoria">Categoria</th>
                                <th id="cabezaAccionesCategoria">Acciones</th>
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
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row['categoria_nombre']; ?>" readonly></td>
                                    <!-- Botones de Editar y Eliminar  -->
                                    <td id="cabezaAcciones" class="<?php echo $clase_fila; ?>">
                                        <div class="acciones-buttons">
                                            <button type="button" class="iconoEditar" title="Editar Categoria" onclick="abrirVentanaEditar('<?php echo $row['categoria_id']; ?>', '<?php echo $row['categoria_nombre']; ?>')"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form id="eliminarForm_<?php echo $row['categoria_id']; ?>" action="Agregar/EliminarCategoria.php" method="POST">
                                                <input type="hidden" name="eliminar_id" value="<?php echo $row['categoria_id']; ?>">
                                                <!-- Ventana emergente de confirmación -->
                                                <div class="contenedor-modal">
                                                    <div class="contenedor-eliminar">
                                                        <p>¿Seguro que quieres eliminar el registro?</p>
                                                        <button type="submit" class="confirmarBtn" name="eliminar_id" id="eliminar_id">Eliminar</button>
                                                        <button type="button" class="cancelarBtn" onclick="cerrarVentanaEliminar()">Cancelar</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="iconoEliminar" title="Eliminar registro" onclick="mostrarConfirmacion('<?php echo $row['categoria_id']; ?>')"><i class="fa-solid fa-trash-can"></i></button>
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
        <?php
    if(isset($_SESSION['success3']) && $_SESSION['success3']) {
        echo "<script>
                Swal.fire({
                    title: 'Categoria',
                    text: 'La categoria no se puede eliminar porque esta siendo ocupado, <br>
                    elimine el producto relaciono',
                    icon: 'question',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
        unset($_SESSION['success3']); // Eliminar la variable de sesión
    }
    ?>
</body>
</html>