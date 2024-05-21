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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Carrera.css">
    <script src="js/Carrera.js"></script>
    <!-- Link separados (iconos) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Administracion Careras</title>
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
    <div class="ventanaEmergenteCarrera">
        <div class="contenidoVentanaEmergenteCarrera">
            <div id="ventana-cerrarCarrera" class="cerrar-ventanaAgregarCarrera"><i class="fa-solid fa-x"></i></div>
            <h2>Agregar Carrera</h2>
            <form action="Agregar/InsertarCarrera.php" method="POST" enctype="multipart/form-data">

                <input type="text" id="nombreinicial" name="carrera_inicial" required placeholder="Inicial de la carrera">
                <input type="text" id="nombrecarrera" name="carrera" required placeholder="Nombre de la carrera">

                <button type="submit" name="Agregar1" id="Agregar1Categoria">Agregar Carrea</button>
                <button type="button" class="ventanacerrarCarrera" onclick="limpiarDatos()">Cancelar</button>
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
    <div class="ventanaEditarCarrera">
        <div class="contenidoVentanaEditarCarrera">
            <h2>Editar Carrera</h2>
            <div id="ventana-cerrar2Carrera" class="cerrar-ventanaEditarCarrera" onclick="cerrarVentanaEditar()"><i class="fa-solid fa-x"></i></div>
            <form action="Agregar/EditarDatosCarrera.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id">

                <p>Iniciales de la carrera<input type="text" id="carrera_inicial" name="carrera_inicial" required placeholder="Inicial de la carrera"></p>
                <p>Nombre de la carrera completo<input type="text" id="carrera" name="carrera" required placeholder="Nombre de la carrera"></p>

                <button type="submit" name="Editar1" id="Editar1Categoria">Guardar cambios</button>
                <button type="button" class="ventanacerrarEditarCarrera" onclick="cerrarVentanaEditar()">Cancelar</button>
            </form>
        </div>
    </div>
    <!-- Fin de la ventana emergente de edición -->

    <div id="productos">
        <!-- OPCIONES DEL ADMINISTRADOR -->
        <?php include '../Menu/menu.html'; ?>
        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">
            <section id="section-productos">
                <div id="mostrarProductos">
                    <center><h2>CARRERAS</h2></center>

                    <button id="nuevoCarrera" class="nuevoCarrera" name="nuevoCarrera" title="Agregar Cerrera" onclick="mostrarVentana()"><i class="fa-solid fa-circle-plus"></i> Agregar Carrera</button>

                    <!-- Controles de paginación -->
                    <div id="paginacion">
                        <form action="" method="GET">
                            <label for="resultados_por_pagina">Mostrar 
                            <select name="resultados_por_pagina" id="resultados_por_pagina" onchange="this.form.submit()">
                                <option value="4" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 4) echo 'selected'; ?>>4</option>
                                <option value="7" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 7) echo 'selected'; ?>>7</option>
                                <option value="10" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 10) echo 'selected'; ?>>10</option>
                            </select>
                             Carrera</label>
                        </form>
                        <?php

                        $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 10;
                        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                        $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                        $sql = "SELECT COUNT(*) AS total FROM carreras";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM carreras LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $sql);
                        ?>
                    </div><br><br>

                    <!-- Datos para registrar de cafeteria modulo a -->
                    <table id="tablaProductos" border="1px">
                        <thead id="cabeceraTabla">
                            <tr>
                                <th id="cabezaInicialCarrera">Carrera</th>
                                <th id="cabezaNombreCarrera">Nombre de la Crrera</th>
                                <th id="cabezaAccionesCarrera">Acciones</th>
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
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoInicial" value="<?php echo $row['carrera_inicial']; ?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row['carrera']; ?>" readonly></td>
                                    <!-- Botones de Editar y Eliminar  -->
                                    <td id="cabezaAccionesCarrera" class="<?php echo $clase_fila; ?>">
                                        <div class="acciones-buttons">
                                            <button type="button" class="iconoEditar" title="Editar Carrera" onclick="abrirVentanaEditar('<?php echo $row['id']; ?>', '<?php echo $row['carrera']; ?>', '<?php echo $row['carrera_inicial']; ?>')"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form id="eliminarForm_<?php echo $row['id']; ?>" action="Agregar/EliminarCarrera.php" method="POST">
                                                <input type="hidden" name="eliminar_id" value="<?php echo $row['id']; ?>">
                                                <!-- Ventana emergente de confirmación -->
                                                <div class="contenedor-modal">
                                                    <div class="contenedor-eliminar">
                                                        <p>¿Seguro que quieres eliminar la carrera?</p>
                                                        <button type="submit" class="confirmarBtn" name="eliminar_id" id="eliminar_id">Eliminar</button>
                                                        <button type="button" class="cancelarBtn" onclick="cerrarVentanaEliminar()">Cancelar</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="iconoEliminar" title="Eliminar registro" onclick="mostrarConfirmacion('<?php echo $row['id']; ?>')"><i class="fa-solid fa-trash-can"></i></button>
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