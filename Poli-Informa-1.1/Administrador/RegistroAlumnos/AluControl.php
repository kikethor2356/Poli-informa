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
    <link rel="stylesheet" href="css/AluControl.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
    <title>Registro Alumno</title>
</head>
<body>
    <div id="productos">
        <?php include '../Menu/menu.html'; ?>

        <main id="principal-productos">
            <section id="section-productos">
                <div id="mostrarProductos">
                    <h2>Control de Alumnos</h2>

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

                        $resultados_por_pagina = isset($_GET['resultados_por_pagina']) ? $_GET['resultados_por_pagina'] : 6;
                        $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

                        $inicio = ($pagina_actual - 1) * $resultados_por_pagina;

                        $sql = "SELECT COUNT(*) AS total FROM registroalu";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);

                        $sql = "SELECT * FROM registroalu LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $sql);
                        ?>
                    </div>

                    <form class="" action="ConexFuncion.php" method="post" enctype="multipart/form-data">
                        <a href="AluAgregar.php" id="nuevoProducto"><i class="fa-solid fa-mostrar-plus">Agregar</i></a>

                        <table id="tablaProductos" border="1px">
                            <thead id="cabeceraTabla">
                                <tr>
                                    <th id="cabezaCodigo">Codigo</th>
                                    <th id="cabezaNombre">Nombre</th>
                                    <th id="cabezaApellidoP">Ap. Parteno</th>
                                    <th id="cabezaApellidoM">Ap. Materno</th>
                                    <th id="cabezaCarrera">Carrera</th>
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
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["CodeAlu"]; ?>"  readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["AluNom"]; ?>"  readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["AluApellidoP"]; ?>"  readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["AluApellidoM"]; ?>"  readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["AluCarrera"]; ?>"  readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["AluCorreo"]; ?>"  readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" value="<?php echo $row["AluImage"]; ?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>">
                                            <button type="button" class="btn btn-samll btn-warning" onclick="mostrarEditar('<?php echo $row['id']; ?>' ,'<?php echo $row['CodeAlu']; ?>', 
                                            '<?php echo $row['AluNom']; ?>', '<?php echo $row['AluApellidoP']; ?>', '<?php echo $row['AluApellidoM']; ?>', 
                                            '<?php echo $row['AluCarrera']; ?>', '<?php echo $row['AluCorreo']; ?>', '<?php echo $row['AluImage']; ?>', 
                                            '<?php echo $row['AluImage']; ?>')"><i class="fa-regular fa-pen-to-square"></i></button>
                                            <!-- Button trigger modal -->
                                            <form id="eliminarForm_<?php echo $row['id']; ?>" action="ConexFuncion.php" method="POST" enctype="multipart/form-data">
                                                <input type="hidden" name="idEliminar" value="<?php echo $row['id']; ?>">
                                                <input type="hidden" name="eliminar_imagen" value="<?php echo $row['AluImage']; ?>">
                                                <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="mostrarBorrar(<?php echo $row['id']; ?>)">
                                                    <i class="fa-regular fa-trash-can"></i>
                                                </button>   
                                            </form>
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
                    <br>
                    
                    <!-- Modal Eliminar -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <form class="" action="ConexFuncion.php" method="post" enctype="multipart/form-data">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Usuario</h1>
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
                                <h2>Editar Usuario</h2>
                            </div>
                            <form action="ConexFuncion.php" method="post" enctype="multipart/form-data" class="formulario_modal">
                            <table>
                                <input type="hidden" value="" id="idUsuario" name="idUsuario" >
                                <tr>
                                    <td>Codigo:</td>
                                    <td><input type="text" maxlength="9" minlength="9" name="CodeAlu" placeholder="123456789" value="" id="soloNumeros" oninput="vaslidarLonCo(this)" required></td>
                                </tr>
                                <tr>
                                    <td>Nombre:</td>
                                    <td><input type="text" maxlength="15" name="AluNom" placeholder="Anonimo" value="" id="campoNombre"  onkeypress="validarInput(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Apellido Paterno:</td>
                                    <td><input type="text" maxlength="15" name="AluApellidoP" placeholder="Anonimato" value="" id="campoApellidoPaterno" onkeypress="validarInput(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Apellido Materno:</td>
                                    <td><input type="text" maxlength="15" name="AluApellidoM" placeholder="Anonimatario" value="" id="campoApellidoMaterno" onkeypress="validarInput(event)" required></td>
                                </tr>
                                <tr>
                                    <td>Carrera:</td>
                                    <td><input type="text" maxlength="7" name="AluCarrera" placeholder="TPSI" value="" id="campoCarrera"  required></td>
                                </tr>
                                <tr>
                                    <td>Correo:</td>
                                    <td><input type="email" name="AluCorreo" placeholder="anonimato@alumnos.udg.mx" value="" id="campoCorreo"  required></td>
                                </tr>
                                <tr class="caja_imagen">
                                    <td class="cajita_textImagen">Imagen</td>
                                    <td class="caja_atributos_imagen">
                                        <input type="hidden" name="AluImagen_old" id="AluImagen_old"><br>
                                        <!-- <label for="imagenInputEditar" id="imagen1"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label> -->
                                        <img src="" alt="" id="imagenPreviewEditar" width="100%" height="60%"><br>
                                        <div class="envoltura_imag_1"><input type="text" id="nombreArchivoEditar" readonly></div>
                                        <div class="envoltura_imag_2"><input type="file" name="AluImage" id="imagenInputEditar" onchange="previewImageEditar(this)"></div>
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
                </section>
            </main>
        </div>



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        <script src="JS/AluFunciones.js"></script>
    
        <!-- Agregar -->
            <?php
        if(isset($_SESSION['success']) && $_SESSION['success']) {
            echo "<script>
                    Swal.fire({
                        title: 'Agregar',
                        text: 'El Usuario fue agregado exitosamente',
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