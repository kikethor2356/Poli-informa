<?php
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();
?>
<?php include '../LoginA/inicio.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/sugerencias.css">
    <link rel="stylesheet" href="../Menu/menu.css">
    <script src="js/Comentarios.js"></script>
    <!-- Link separados (iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Sugerencias</title>
</head> 
<body>
    <!-- Ventana emergente para visualizar producto -->
    <div class="ventanaVisualizarComentario" id="ventanaVisualizarComentario">
        <div class="contenidoVentanaVisualizarComentario">
            <!-- Contenido de la ventana emergente de visualización -->
            <h2>Mostrar Comentario</h2>
            <div id="ventana-cerrar3" class="cerrar-ventanaMostrar" onclick="cerrarVentanaVisualizar()"><i class="fa-solid fa-x"></i></div>
            <p id="UsNombre"></p>
            <p id="UsCorreo"></p>
            <textarea id="UsComentario"></textarea>
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
                    <center><h2>Comentarios y Sugerencias</h2></center>
                    <!-- Controles de paginación -->
                    <div id="paginacion">
                        <form action="" method="GET">
                            <label for="resultados_por_pagina">Mostrar 
                            <select name="resultados_por_pagina" id="resultados_por_pagina" onchange="this.form.submit()">
                                <option value="4" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 4) echo 'selected'; ?>>4</option>
                                <option value="7" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 7) echo 'selected'; ?>>7</option>
                                <option value="10" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 10) echo 'selected'; ?>>10</option>
                            </select>
                             Comentarios</label>
                        </form>
                        <?php

                        $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 10;
                        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                        $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                        $sql = "SELECT COUNT(*) AS total FROM sugerencias";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM sugerencias LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $sql);
                        ?>
                    </div><br><br>

                    <!-- Datos para registrar de cafeteria modulo a -->
                    <table id="tablaProductos" border="1px">
                        <thead id="cabeceraTabla">
                            <tr>
                                <th id="cabezaNombre">Nombre</th>
                                <th id="cabezaCorreo">Correos</th>
                                <th id="cabezaSugerencia">Sugerencias</th>
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
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row['UsNombre']; ?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row['UsCorreo']; ?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row['UsComentario']; ?>" readonly></td>
                                    <!-- Botones de Editar y Eliminar  -->
                                    <td id="cabezaAcciones" class="<?php echo $clase_fila; ?>">
                                        <div class="acciones-buttons">
                                            <button type="button" class="iconoVer" title="Ver comentario" onclick="abrirVentanaVisualizar('<?php echo $row['UsNombre']; ?>', '<?php echo $row['UsCorreo']; ?>', '<?php echo $row['UsComentario']; ?>')"><i class="fa-regular fa-eye"></i></button>
                                            <form id="eliminarForm_<?php echo $row['id']; ?>" action="Eliminar/ControlVQys.php" method="POST">
                                                <input type="hidden" name="eliminar_id" value="<?php echo $row['id']; ?>">
                                                <!-- Ventana emergente de confirmación -->
                                                <div class="contenedor-modal">
                                                    <div class="contenedor-eliminar">
                                                        <p>¿Seguro que quieres eliminar el comentario?</p>
                                                        <button type="submit" class="confirmarBtn" name="eliminar_id" id="eliminar_id">Eliminar</button>
                                                        <button type="button" class="cancelarBtn" onclick="cerrarVentanaEliminar()">Cancelar</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="iconoEliminar" title="Eliminar comentario" onclick="mostrarConfirmacion('<?php echo $row['id']; ?>')"><i class="fa-solid fa-trash-can"></i></button>
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
    if(isset($_SESSION['success']) && $_SESSION['success']) {
        echo "<script>
                Swal.fire({
                    title: 'Eliminar',
                    text: 'La eliminación fue todo un exito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
        unset($_SESSION['success']); // Eliminar la variable de sesión
    } else if(isset($_SESSION['error']) && $_SESSION['error']) {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No fue posible eliminarlo, inténtelo de nuevo',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            </script>";
        unset($_SESSION['error']); // Eliminar la variable de sesión
    }
    ?>
</body>
</html>