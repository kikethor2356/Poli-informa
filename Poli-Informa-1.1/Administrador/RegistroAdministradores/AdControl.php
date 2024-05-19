<?php 
    require 'ConexFuncion.php'; 
    include '../LoginA/inicio.php';
    $db = new Database();
    $conexion = $db->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/AdControlR1.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
    <title>Registro Administrador</title>
</head>
<body>
    <div id="productos">
        <?php include '../Menu/menu.html'; ?>

        <main id="principal-productos">
            <section id="section-productos">
                <div id="mostrarProductos">
                    <h2>Control de Administrador</h2>

                    <!-- Controles de paginación -->
                    <div id="paginacion">
                        <form action="" method="GET">
                            <label for="resultados_por_pagina">Mostrar 
                            <select name="resultados_por_pagina" id="resultados_por_pagina" onchange="this.form.submit()">
                                <option value="4" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 4) echo 'selected'; ?>>4</option>
                                <option value="6" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 6) echo 'selected'; ?>>6</option>
                                <option value="8" <?php if(isset($_GET['resultados_por_pagina']) && $_GET['resultados_por_pagina'] == 8) echo 'selected'; ?>>8</option>
                            </select>
                             Registro</label>
                        </form>
                        <?php

                        $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 8;
                        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                        $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                        $sql = "SELECT COUNT(*) AS total FROM registro";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM registro LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $sql);
                        ?>
                    </div>
                    
                    <form class="ConexFuncion.php" action="" method="post" enctype="multipart/form-data">
                        <a href="AdAgregar.php" class="btn btn-primary" id="nuevoProducto"><i class="fa-solid fa-mostrar-plus">Agregar</i></a>

                        <table id="tablaProductos" border="1px">
                            <thead id="cabeceraTabla">
                                <tr>
                                    <th id="cabezaCodigo">Codigo</th>
                                    <th id="cabezaNombre">Nombre</th>
                                    <th id="cabezaApellidoP">Ap. Parteno</th>
                                    <th id="cabezaApellidoM">Ap. Materno</th>
                                    <th id="cabezaCorreo">Correo</th>
                                    <th id="cabezaImagen">Imagen</th>
                                    <th id="cabezaAcciones">Opciones</th>
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
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCodigo" value="<?php echo $row["AdCode"]; ?>" readonly ></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" value="<?php echo $row["AdNombre"]; ?>" readonly ></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoApellidoP" value="<?php echo $row["AdApellidoP"]; ?>" readonly ></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoApellidoM" value="<?php echo $row["AdApellidoM"]; ?>" readonly ></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCorreo" value="<?php echo $row["AdCorreo"]; ?>" readonly ></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoImagen" value="<?php echo $row["AdImagen"]; ?>" readonly ></td>
                                        <!-- Botones de Editar y Eliminar -->
                                        <td id="cabezaAccones" class="<?php echo $clase_fila; ?>">
                                            <div class="acciones-buttons">
                                                <button type="button" class="btn btn-samll btn-warning" onclick="mostrarEditar('<?php echo $row['id']; ?>' ,'<?php echo $row['AdCode']; ?>', '<?php echo $row['AdNombre']; ?>', '<?php echo $row['AdApellidoP']; ?>', '<?php echo $row['AdApellidoM']; ?>', '<?php echo $row['AdCorreo']; ?>', '<?php echo $row['AdImagen']; ?>', '<?php echo $row['AdImagen']; ?>')"><i class="fa-regular fa-pen-to-square"></i></button>
                                                <!-- Button trigger modal -->
                                                <form id="eliminarForm_<?php echo $row['id']; ?>" action="ConexFuncion.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="idEliminar" value="<?php echo $row['id']; ?>">
                                                    <input type="hidden" name="eliminar_imagen" value="<?php echo $row['AdImagen']; ?>">
                                                    <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="mostrarBorrar(<?php echo $row['id']; ?>)">
                                                        <i class="fa-regular fa-trash-can"></i>
                                                    </button>   
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
                                <tr><td colspan="2">No hay registros disponibles.</td></tr>
                                <?php
                            }
                            ?>
                        </table>
                    </form>    
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
                    
                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="" action="ConexFuncion.php" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Administrador</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="idEliminar" id="idEliminar" value="" hidden>
                                        ¿Seguro que quieres eliminar este registro?
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-samll btn-danger" type="submit" name="submit" value="borrar">Eliminar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal editar -->
                    <div class="modal_editar">
                        <div class="contenidoVentanaEmergente">
                            <div class="contenidoFooter">
                                <h2>Editar Administrador</h2>
                            </div>
                            <form action="ConexFuncion.php" method="post" enctype="multipart/form-data" class="formulario_modal">
                            <table>
                                <input type="hidden" value="" id="idUsuario" name="idUsuario" >
                                <tr>
                                    <td>Codigo:</td>
                                    <td><input type="text" maxlength="9" minlength="9" name="AdCode" placeholder="123456789" value="" id="soloNumeros" oninput="vaslidarLonCo(this)" required></td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td><input type="text" maxlength="15" name="AdNombre" placeholder="Anonimo" value="" id="campoNombre"  onkeypress="validarInput(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Apellido Paterno:</td>
                                    <td><input type="text" maxlength="15" name="AdApellidoP" placeholder="Anonimato" value="" id="campoApellidoPaterno" onkeypress="validarInput(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Apellido Materno:</td>
                                    <td><input type="text" maxlength="15" name="AdApellidoM" placeholder="Anonimatario" value="" id="campoApellidoMaterno" onkeypress="validarInput(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Correo:</td>
                                    <td><input type="email" name="AdCorreo"  placeholder="anonimato@alumnos.udg.mx" value="" id="campoCorreo"  required></td>
                                </tr>
                                <tr class="caja_imagen">
                                    <td class="cajita_textImagen">Imagen</td>
                                    <td class="caja_atributos_imagen">
                                        <input type="hidden" name="AdImagen_old" id="AdImagen_old"><br>
                                        <!-- <label for="imagenInputEditar" id="imagen1"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label> -->
                                        <img src="" alt="" id="imagenPreviewEditar" width="100%" height="60%"><br>
                                        <div class="envoltura_imag_1"><input type="text" id="nombreArchivoEditar" readonly></div>
                                        <div class="envoltura_imag_2"><input type="file" name="AdImagen" id="imagenInputEditar" onchange="previewImageEditar(this)"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><button type="button" class="cerrarModal" onclick="cerrarVentanaEditar()">Cancelar</button></td>
                                    <td><input type="submit" name="submit" value="Editar"></td>
                                </tr>
                            </table>
                            </form>
                        </div>
                    </div> <!-- .modal_editar -->

                </div>
            </section>
        </main>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="JS/AdFunciones.js"></script>
    
        <!-- Agregar -->
            <?php
        if(isset($_SESSION['success']) && $_SESSION['success']) {
            echo "<script>
                    Swal.fire({
                        title: 'Agregar',
                        text: 'El Admin fue agregado exitosamente',
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                </script>";
            unset($_SESSION['success']); // Eliminar la variable de sesión
        } else if(isset($_SESSION['error']) && $_SESSION['error']) {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No fue posible agregarlo, inténtelo de nuevo',
                        icon: 'error',
                        confirmButtonText: 'Cerrar'
                    });
                </script>";
            unset($_SESSION['error']); // Eliminar la variable de sesión
        }
        ?>
        <!-- Editar -->
        <?php
        if(isset($_SESSION['success1']) && $_SESSION['success1']) {
            echo "<script>
                    Swal.fire({
                        title: 'Editar',
                        text: 'La edición fue todo un exito',
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
        <!-- Eliminar -->
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