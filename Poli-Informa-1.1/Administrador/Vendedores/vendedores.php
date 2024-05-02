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
    <link rel="stylesheet" href="css/ventanaAdministradores.css">
    <link rel="stylesheet" href="../Menu/menu.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="css/diseño.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    <div id="mostrarVendedores">
                        <h1>Lista de vendedores</h1>                        
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
                            
                            $sql = "SELECT COUNT(*) AS total FROM vendedores";
                            $resultado = mysqli_query($conexion, $sql);
                            $fila = mysqli_fetch_assoc($resultado);
                            $total_resultados = $fila['total'];
                            $total_paginas = ceil($total_resultados / $resultados_por_pagina);
                            
                            $consulta = "SELECT * FROM vendedores LIMIT $inicio, $resultados_por_pagina";
                            $resultado = mysqli_query($conexion, $consulta);
                            ?>
                        </div>
                        <table id="tablaVendedores" border="1px">
                            <thead>
                                <tr>
                                    <th id="cabezaCodigoVendedor">Código</th>
                                    <th id="cabezaNombreVendedor">Nombre</th>
                                    <th id="cabezaDescripcionVendedor">Descripción</th>
                                    <th id="cabezaCorreoVendedor">Correo electrónico</th>
                                    <th id="cabezaTelefonoVendedor">Telefono</th>
                                    <th id="cabezaHoraInicio">Inicio</th>
                                    <th id="cabezaHoraFin">Fin</th>
                                    <th id="cabezaFotoVendedor">foto</th>
                                    <th id="cabezaAccionesVendedor">Acciones</th>
                                </tr>
                            </thead>
                            <?php
                                $consulta = "SELECT * FROM VENDEDORES";
                                $resultado = mysqli_query($conexion, $consulta);
                                $numeroID;
                                $contador = 1;
                            while($mostrar = mysqli_fetch_array($resultado)){
                                $clase_fila = ($contador % 2 == 0) ? 'fila2' : 'fila1';
                            ?>
                                <tbody>
                                    <tr>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCodigoVendedor" name="campoCodigoVendedor" value="<?php echo $mostrar['codigoVendedor']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombreVendedor" name="campoNombreVendedor" value="<?php echo $mostrar['nombre']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoDescripcionVendedor" name="campoDescripcionVendedor" value="<?php echo $mostrar['descripcion']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCorreoVendedor" name="campoCorreoVendedor" value="<?php echo $mostrar['correo']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoTelefonoVendedor" name="campoTelefonoVendedor" value="<?php echo $mostrar['telefono']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoHoraInicio" name="campoHoraInicio" value="<?php echo $mostrar['horaInicio']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoHoraFin" name="campoHoraFin" value="<?php echo $mostrar['horaFin']?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoFotoVendedor" name="campoFotoVendedor" value="<?php echo $mostrar['foto']?>" readonly></td>
                                        <td id="campoAccionesVendedor" name="campoAccionesVendedor" class="<?php echo $clase_fila; ?>">
                                            <a class="modal_abrir_borrar_vendedor_<?php echo $mostrar['id']; ?>" onclick="modalBorrarVendedor('<?php echo $mostrar['id']; ?>', '<?php echo $mostrar['foto']; ?>' )">
                                                <img src="iconos/basura.png" alt="eliminar" id="iconoEliminarVendedor" title="Eliminar vendedor">
                                            </a>
                                            <a class="modal_abrir_editar_vendedor_<?php echo $mostrar['id']; ?>"  onclick="modalEditarVendedor('<?php echo $mostrar['id']; ?>', '<?php echo $mostrar['codigoVendedor']; ?>', '<?php echo $mostrar['nombre']; ?>', '<?php echo $mostrar['descripcion']; ?>', '<?php echo $mostrar['correo']; ?>', '<?php echo $mostrar['telefono']; ?>', '<?php echo $mostrar['horaInicio']; ?>', '<?php echo $mostrar['horaFin']; ?>', '<?php echo $mostrar['foto']; ?>')">
                                                <img src="iconos/editar.png" alt="editar" id="iconoEditarVendedor" title="Editar vendedor">
                                            </a>
                                            <a class="modal_abrir_ver_vendedor_<?php echo $mostrar['id']; ?>"  onclick="modalVerVendedor('<?php echo $mostrar['id']; ?>', '<?php echo $mostrar['codigoVendedor']; ?>', '<?php echo $mostrar['nombre']; ?>', '<?php echo $mostrar['descripcion']; ?>', '<?php echo $mostrar['correo']; ?>', '<?php echo $mostrar['telefono']; ?>', '<?php echo $mostrar['horaInicio']; ?>', '<?php echo $mostrar['horaFin']; ?>', '<?php echo $mostrar['foto']; ?>')">
                                                <img src="iconos/ver.png" alt="ver" id="iconoVerVendedor" title="ver vendedor">
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>                            
                                <?php 
                                    $contador++;
                            }//FIN WHILE
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
                    <!-- FIN DE MOSTRAR VENDEDORES -->
                    </div>     
                    
                    <!-- VENTANAS MODALES -->
                            
                    <!-- VENTANA MODAL PARA EDITAR AL VENDEDOR -->                                
                    <div class="modal_editar_vendedor">
                        <div id="ventana-editar-vendedor" class="ventana-editar-vendedor">
                            <h1>Editar vendedor</h1>        
                            <div id="cerrar" class="modal_cerrar_editar_vendedor">✖</div>
                            <form action="PHP/Acciones.php?metodo=5" id="formulario-editar-vendedor" name="formulario-editar-vendedor" enctype="multipart/form-data" method="post">
                                <input type="hidden" id="IdEditarVendedor" name="IdEditarVendedor" value="">
                                <div class="codigoVendedor">
                                    <label for="codigoVendedor">Código:</label><br>
                                    <input type="text" id="codigoEditarVendedor" name="codigoEditarVendedor" value="">
                                </div>
                                <div class="nombreVendedor">
                                    <label for="nombreVendedor">Nombre:</label><br>
                                    <input type="text" id="nombreEditarVendedor" name="nombreEditarVendedor" value="">
                                </div>
                                <div class="descripcionVendedor">
                                    <label for="descripcionVendedor">Descripción:</label><br>
                                    <textarea name="descripcionEditarVendedor" id="descripcionEditarVendedor"></textarea>
                                </div>
                                <div class="correoVendedor">
                                    <label for="correoVendedor">Correo electrónico:</label><br>
                                    <input type="text" id="correoEditarVendedor" name="correoEditarVendedor" value="">
                                </div>
                                <div class="telefonoVendedor">
                                    <label for="telefonoVendedor">Télefono:</label><br>
                                    <input type="text" id="telefonoEditarVendedor" name="telefonoEditarVendedor" value="">
                                </div>
                                <div class="horaInicio">
                                    <label for="horaInicio">Hora de inicio:</label>
                                    <select name="horaInicioEditarVendedor" id="horaInicioEditarVendedor">
                                        <option value="7:00 am">7:00 am</option>';
                                        <option value="8:00 am">8:00 am</option>';
                                        <option value="9:00 am">9:00 am</option>';
                                        <option value="10:00 am">10:00 am</option>';
                                        <option value="11:00 am">11:00 am</option>';
                                        <option value="12:00 pm">12:00 pm</option>';
                                        <option value="13:00 pm">13:00 pm</option>';
                                        <option value="14:00 pm">14:00 pm</option>';
                                        <option value="15:00 pm">15:00 pm</option>';
                                        <option value="16:00 pm">16:00 pm</option>';
                                        <option value="17:00 pm">17:00 pm</option>';
                                        <option value="18:00 pm">18:00 pm</option>';
                                        <option value="19:00 pm">19:00 pm</option>';
                                        <option value="20:00 pm">20:00 pm</option>';
                                    </select>
                                </div>
                                <div class="horaFin">
                                    <label for="horaFin">Hora de finalización:</label>
                                    <select name="horaFinEditarVendedor" id="horaFinEditarVendedor">
                                        <option value="7:00 am">7:00 am</option>';
                                        <option value="8:00 am">8:00 am</option>';
                                        <option value="9:00 am">9:00 am</option>';
                                        <option value="10:00 am">10:00 am</option>';
                                        <option value="11:00 am">11:00 am</option>';
                                        <option value="12:00 pm">12:00 pm</option>';
                                        <option value="13:00 pm">13:00 pm</option>';
                                        <option value="14:00 pm">14:00 pm</option>';
                                        <option value="15:00 pm">15:00 pm</option>';
                                        <option value="16:00 pm">16:00 pm</option>';
                                        <option value="17:00 pm">17:00 pm</option>';
                                        <option value="18:00 pm">18:00 pm</option>';
                                        <option value="19:00 pm">19:00 pm</option>';
                                        <option value="20:00 pm">20:00 pm</option>';
                                        <option value="21:00 pm">21:00 pm</option>';                        
                                    </select>
                                </div>
                                <div class="fotoVendedor">
                                    <input type="file" id="archivoVendedor" name="archivoVendedor" onchange="mostrarArchivoEditarVendedor(event)" accept="image/jpeg, image/png">
                                    <label for="archivoVendedor"><i class="fa-solid fa-upload"></i></label>
                                    <input type="text" id="fotoEditarVendedor" name="fotoEditarVendedor" value="" readonly><br><br>
                                </div>                        
                                <div class="finalEditar">
                                    <button type="submit" id="editarVendedor" name="editarVendedor"><i class="fa-solid fa-check"></i> Guardar</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                    <!-- FIN DE VENTANA MODAL PARA EDITAR AL VENDEDOR --> 
                    <!-- VENATANA DE VERIFICACION -->
                    <?php
                    if(isset($_SESSION['success4']) && $_SESSION['success4']) {
                        echo "<script>
                                Swal.fire({
                                    title: 'Editar',
                                    text: 'La editación fue todo un éxito',
                                    icon: 'success',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>";
                        unset($_SESSION['success4']); // Eliminar la variable de sesión
                    } else if(isset($_SESSION['error4']) && $_SESSION['error4']) {
                        echo "<script>
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No fue posible editarlo, inténtelo de nuevo',
                                    icon: 'error',
                                    confirmButtonText: 'Cerrar'
                                });
                            </script>";
                        unset($_SESSION['error4']); // Eliminar la variable de sesión
                    }
                    ?>
                    <!-- FIN DE VENTANA DE VERIFICACION -->                   

                    <!-- VENTANA MODAL PARA BORRAR AL VENDEDOR -->
                    <div class="modal_borrar_vendedor">
                        <div id="ventana-borrar-vendedor">
                            <h1>Borrar registro</h1>
                            <div id="cerrar" class="modal_cerrar_borrar_vendedor">✖</div>
                            <form action="PHP/Acciones.php?metodo=6" id="formulario-borrar-vendedor" enctype="multipart/form-data" method="post">
                                <div id="contenedorEliminar">
                                    <p id="informacion">¿Desea eliminar el registro?</p>
                                    <input type="text" id="fotoEliminarVendedor" name="fotoEliminarVendedor" value="" hidden>
                                    <input type="text" id="idEliminarVendedor" name="idEliminarVendedor" value="" hidden>    
                                </div>
                                <button id="borrarVendedor" name="Borrar"><i class="fa-solid fa-trash"></i>&nbsp;Borrar</button>
                            </form>
                        </div>
                    </div>
                    <!-- FIN DE VENTANA MODAL PARA ELIMINAR AL VENDEDOR -->  
                    <!-- VENATANA DE VERIFICACION -->
                    <?php
                    if(isset($_SESSION['success5']) && $_SESSION['success5']) {
                        echo "<script>
                                Swal.fire({
                                    title: 'Eliminar',
                                    text: 'La eliminación fue todo un éxito',
                                    icon: 'success',
                                    confirmButtonText: 'Aceptar'
                                });
                            </script>";
                        unset($_SESSION['success5']); // Eliminar la variable de sesión
                    } else if(isset($_SESSION['error5']) && $_SESSION['error5']) {
                        echo "<script>
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No fue posible eliminarlo, inténtelo de nuevo',
                                    icon: 'error',
                                    confirmButtonText: 'Cerrar'
                                });
                            </script>";
                        unset($_SESSION['error5']); // Eliminar la variable de sesión
                    }
                    ?>
                    <!-- FIN DE VENTANA DE VERIFICACION --> 
                    
                    <!-- Ventana modal para ver al vendedor -->
                    <div class="modal_ver_vendedor">
                        <div id="ventana-ver-vendedor" class="ventana-ver-vendedor">
                            <h1>Vendedor</h1>  
                            <div id="cerrarVerVendedor" class="modal_cerrar_ver_vendedor">✖</div>
                            <form action="" id="formulario-ver-vendedor" name="formulario-ver-vendedor" enctype="multipart/form-data" method="post">
                                <div class="codigoVerVendedor">
                                    <label for="codigoVerVendedor">Código:</label><br>
                                    <input type="text" id="codigoVerVendedor" name="codigoVerVendedor" value="" readonly>
                                </div>
                                <div class="nombreVerVendedor">
                                    <label for="nombreVerVendedor">Nombre:</label><br>
                                    <input type="text" id="nombreVerVendedor" name="nombreVerVendedor" value="" readonly>
                                </div>
                                <div class="descripcionVerVendedor">
                                    <label for="descripcionVerVendedor">Descripción:</label><br>
                                    <textarea name="descripcionVerVendedor" id="descripcionVerVendedor" readonly></textarea>                                </div>

                                <div class="correoVerVendedor">
                                    <label for="correoVerVendedor">Correo electrónico:</label><br>
                                    <input type="text" id="correoVerVendedor" name="correoVerVendedor" value="" readonly>
                                </div>
                                <div class="telefonoVerVendedor">
                                    <label for="telefonoVerVendedor">Télefono:</label><br>
                                    <input type="text" id="telefonoVerVendedor" name="telefonoVerVendedor" value="" readonly>
                                </div>
                                <div class="horarioVerVendedor">
                                    <label for="horarioVerVentas">Horario de ventas</label><br>
                                    <label for="horaInicioVerVendedor">Inicio:</label>
                                    <input type="text" name="horaInicioVerVendedor" id="horaInicioVerVendedor" readonly><br>
                                    <label for="horaFinVerVendedor">Fin:</label>
                                    <input type="text" name="horaFinVerVendedor" id="horaFinVerVendedor" readonly>
                                </div>
                                <img class="imagenVerVendedor" id="imagenVerVendedor" src="" alt="imagen del vendedor">
                            </form> 
                        </div>
                    </div>
                    <!-- FIN DE VENTANA MODAL PARA VER AL VENDEDOR-->
            </section>
        </main>            
    </div>

    <?php
            if(isset($_GET['message'])){
                ?>
                    <div>
                        <?php
                            switch ($_GET['message']){
                                case 'ok':
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Revisa',
                                            text: 'Porfavor revisa tu correo',
                                            icon: 'warning',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>";
                                break;

                                case 'success_password':
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Revisa',
                                            text: 'Inicia sesion con tu nueva contraseña',
                                            icon: 'success',
                                            confirmButtonText: 'Aceptar'
                                        });
                                    </script>";
                                break;

                                default:
                                    echo "<script>
                                        Swal.fire({
                                            title: 'Error',
                                            text: 'Algo salio mal, intentelo de nuevo',
                                            icon: 'error',
                                            confirmButtonText: 'Cerrar'
                                        });
                                    </script>";
                                break;
                            }
                        ?>
                    </div>
                <?php
            }
        ?>
</body>
</html>