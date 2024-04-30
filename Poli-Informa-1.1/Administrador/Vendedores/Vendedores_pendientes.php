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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../Menu/menu.css">
    <link rel="stylesheet" href="css/diseño.css">
    <script src="js/productos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Administrador - Vendedores</title>
</head>
<body>
    <div id="cafeteria">
        <!-- OPCIONES DEL ADMINISTRADOR -->
        <?php include '../Menu/menu.html'; ?>
        
        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">
            <section id="section-productos">
                <div class="mostrarVendedoresPendientes" id="mostrarVendedoresPendientes">
                    <h1>Lista de vendedores pendientes</h1>
                        
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
                        
                        $sql = "SELECT COUNT(*) AS total FROM VENDEDORES_PENDIENTES";
                        $resultado = mysqli_query($conexion, $sql);
                        $fila = mysqli_fetch_assoc($resultado);
                        $total_resultados = $fila['total'];
                        $total_paginas = ceil($total_resultados / $resultados_por_pagina);
                        
                        $consulta = "SELECT * FROM VENDEDORES_PENDIENTES LIMIT $inicio, $resultados_por_pagina";
                        $resultado = mysqli_query($conexion, $consulta);
                        ?>
                    </div>
                    <table id="tablaVendedoresPendientes" border="1px">
                        <thead>
                            <tr>
                                <th id="cabezaCodigoVendedorPendiente">Código</th>
                                <th id="cabezaNombreVendedorPendiente">Nombre</th>
                                <th id="cabezaDescripcionVendedorPendiente">Descripción</th>
                                <th id="cabezaCorreoVendedorPendiente">Correo electrónico</th>
                                <th id="cabezaTelefonoVendedorPendiente">Telefono</th>
                                <th id="cabezaHoraInicioPendiente">Inicio</th>
                                <th id="cabezaHoraFinPendiente">Fin</th>
                                <th id="cabezaFotoVendedorPendiente">foto</th>
                                <th id="cabezaAccionesVendedorPendiente">Acciones</th>
                            </tr>
                        </thead>
                        <?php 
                            $consulta = "SELECT * FROM VENDEDORES_PENDIENTES";
                            $resultado = mysqli_query($conexion, $consulta);
                            $numeroID;
                            $contador = 1;
                            while($mostrar = mysqli_fetch_array($resultado)){
                                $clase_fila = ($contador % 2 == 0) ? 'fila2' : 'fila1';
                        ?>
                        <tbody>
                            <tr>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCodigoVendedorPendiente" name="campoCodigoVendedorPendiente" value="<?php echo $mostrar['codigoVendedor']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombreVendedorPendiente" name="campoNombreVendedorPendiente" value="<?php echo $mostrar['nombre']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoDescripcionVendedorPendiente" name="campoDescripcionVendedorPendiente" value="<?php echo $mostrar['descripcion']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCorreoVendedorPendiente" name="campoCorreoVendedorPendiente" value="<?php echo $mostrar['correo']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoTelefonoVendedorPendiente" name="campoTelefonoVendedorPendiente" value="<?php echo $mostrar['telefono']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoHoraInicioPendiente" name="campoHoraInicioPendiente" value="<?php echo $mostrar['horaInicio']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoHoraFinPendiente" name="campoHoraFinPendiente" value="<?php echo $mostrar['horaFin']?>" readonly></td>
                                <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoFotoVendedorPendiente" name="campoFotoVendedorPendiente" value="<?php echo $mostrar['foto']?>" readonly></td>
                                <td id="campoAccionesVendedorPendiente" name="campoAccionesVendedor" class="<?php echo $clase_fila; ?>">
                                    <a class="modal_abrir_borrar_vendedor_pendiente_<?php echo $mostrar['id']; ?>" onclick="modalBorrarVendedorPendiente('<?php echo $mostrar['id']; ?>', '<?php echo $mostrar['foto']; ?>' )">
                                        <img src="iconos/basura.png" alt="eliminar" id="iconoEliminarVendedorPendiente" title="Eliminar vendedor">
                                    </a>
                                    <a class="modal_abrir_ver_vendedor_pendiente_<?php echo $mostrar['id']; ?>" onclick="modalVerVendedorPendiente('<?php echo $mostrar['id']; ?>', '<?php echo $mostrar['codigoVendedor']; ?>', '<?php echo $mostrar['nombre']; ?>', '<?php echo $mostrar['descripcion']; ?>', '<?php echo $mostrar['correo']; ?>', '<?php echo $mostrar['telefono']; ?>', '<?php echo $mostrar['horaInicio']; ?>', '<?php echo $mostrar['horaFin']; ?>', '<?php echo $mostrar['foto']; ?>')">
                                        <img src="iconos/ver.png" alt="ver" id="iconoVerVendedorPendiente" title="Ver vendedor">
                                    </a>
                                    <a class="modal_abrir_aceptar_vendedor_pendiente_<?php echo $mostrar['id']; ?>" onclick="modalAceptarVendedorPendiente('<?php echo $mostrar['id']; ?>')">
                                        <img src="iconos/aceptar.png" alt="aceptar" id="iconoAceptarVendedorPendiente" title="Registrar vendedor">
                                    </a>
                                </td>
                            </tr>
                        </tbody>                                 
                        <?php 
                            $contador++;                                    
                        }//FIN WHILE
                        ?>
                    </table>   
                </div>       

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
                <!-- VENTANA MODAL PARA ACEPTAR AL VENDEDOR PENDIENTE -->
                <div class="modal_aceptar_vendedor_pendiente">
                    <div id="ventana-aceptar-vendedor-pendiente">
                        <h1>Aceptar vendedor</h1>
                        <div id="cerrarAceptarVendedorPendiente" class="modal_cerrar_aceptar_vendedor_pendiente">✖</div>
                        <form action="PHP/Acciones.php?metodo=8" id="formulario-aceptar-vendedor-pendiente" enctype="multipart/form-data" method="post">
                            <div id="contenedorAceptarVendedorPendiente">
                                <p id="aceptarInformacionVendedorPendiente">¿Desea agregar al vendedor?</p>
                                <!-- <input type="text" id="fotoAceptarVendedorPendiente" name="fotoAceptarVendedorPendiente" value="" hidden> -->
                                <input type="text" id="idAceptarVendedorPendiente" name="idAceptarVendedorPendiente" value="" hidden>    
                            </div>
                            <button id="aceptarVendedorPendiente" name="aceptarVendedorPendiente"><i class="fa-solid fa-trash"></i>&nbsp;Agregar</button>
                        </form>
                    </div>
                </div>
                <!-- FIN DE VENTANA MODAL PARA ACEPTAR AL VENDEDOR PENDIENTE-->
                <!-- VENATANA DE VERIFICACION -->
                <?php
                if(isset($_SESSION['success8']) && $_SESSION['success8']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Aceptado',
                                text: 'El vendedor fue aceptado',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>";
                    unset($_SESSION['success8']); // Eliminar la variable de sesión
                } else if(isset($_SESSION['error8']) && $_SESSION['error8']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'El vendedor no fue registrado verifique',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    unset($_SESSION['error8']); // Eliminar la variable de sesión
                }
                ?>
                <!-- FIN DE VENTANA DE VERIFICACION -->
                        
                <!-- Ventana modal para ver al vendedor pendiente -->
                <div class="modal_ver_vendedor_pendiente">
                    <div id="ventana-ver-vendedor-pendiente" class="ventana-ver-vendedor-pendiente">
                        <h1>Vendedor</h1>  
                        <div id="cerrarVendedorPendiente" class="modal_cerrar_ver_vendedor_pendiente">✖</div>
                        <form action="" id="formulario-ver-vendedor_Pendiente" name="formulario-ver-vendedor-pendiente" enctype="multipart/form-data" method="post">
                            <div class="codigoVendedorPendiente">
                                <label for="codigoVendedorPendiente">Código:</label><br>
                                <input type="text" id="codigoVerVendedorPendiente" name="codigoVerVendedorPendiente" value="" readonly>
                            </div>
                            <div class="nombreVendedorPendiente">
                                <label for="nombreVendedorPendiente">Nombre:</label><br>
                                <input type="text" id="nombreVerVendedorPendiente" name="nombreVerVendedorPendiente" value="" readonly>
                            </div>
                            <div class="descripcionVendedorPendiente">
                                <label for="descripcionVendedorPendiente">Descripción:</label><br>
                                <textarea name="descripcionVerVendedorPendiente" id="descripcionVerVendedorPendiente" readonly></textarea>
                            </div>
                            <div class="correoVendedorPendiente">
                                <label for="correoVendedorPendiente">Correo electrónico:</label><br>
                                <input type="text" id="correoVerVendedorPendiente" name="correoVerVendedorPendiente" value="" readonly>
                            </div>
                            <div class="telefonoVendedorPendiente">
                                <label for="telefonoVendedorPendiente">Télefono:</label><br>
                                <input type="text" id="telefonoVerVendedor" name="telefonoVerVendedor" value="" readonly>
                            </div>
                            <div class="horarioVendedorPendiente">
                                <label for="horarioVentasPendiente">Horario de ventas</label><br>
                                <label for="horaInicioVendedorPendiente">Inicio:</label>
                                <input type="text" name="horaInicioVendedorPendiente" id="horaInicioVendedorPendiente" readonly><br>
                                <label for="horaFinVendedorPendiente">Fin:</label>
                                <input type="text" name="horaFinVendedorPendiente" id="horaFinVendedorPendiente" readonly>
                            </div>
                            <img class="imagenVendedorPendiente" id="imagenVendedorPendiente" src="" alt="imagen del vendedor pendiente">
                        </form> 
                    </div>
                </div>
                <!-- FIN DE VENTANA MODAL PARA VER AL VENDEDOR PENDIENTE-->               

                <!-- VENTANA MODAL PARA BORRAR AL VENDEDOR PENDIENTE -->
                <div class="modal_borrar_vendedor_pendiente">
                    <div id="ventana-borrar-vendedor-pendiente">
                        <h1>Borrar registro</h1>
                        <div id="cerrarBorrarVendedorPendiente" class="modal_cerrar_borrar_vendedor_pendiente">✖</div>
                        <form action="PHP/Acciones.php?metodo=7" id="formulario-borrar-vendedor-pendiente" enctype="multipart/form-data" method="post">
                            <div id="contenedorEliminarVendedorPendiente">
                                <p id="informacionVendedorPendiente">¿Desea eliminar el registro?</p>
                                <input type="text" id="fotoEliminarVendedorPendiente" name="fotoEliminarVendedorPendiente" value="" hidden>
                                <input type="text" id="idEliminarVendedorPendiente" name="idEliminarVendedorPendiente" value="" hidden>    
                            </div>
                            <button id="borrarVendedorPendiente" name="borrarVendedorPendiente"><i class="fa-solid fa-trash"></i>&nbsp;Borrar</button>
                        </form>
                    </div>
                </div>
                <!-- FIN DE VENTANA MODAL PARA ELIMINAR AL VENDEDOR PENDIENTE-->
 
                <!-- VENATANA DE VERIFICACION -->
                <?php
                if(isset($_SESSION['success7']) && $_SESSION['success7']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Eliminar',
                                text: 'Se elimino el vendedor',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });
                        </script>";
                    unset($_SESSION['success7']); // Eliminar la variable de sesión
                } else if(isset($_SESSION['error7']) && $_SESSION['error7']) {
                    echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No fue posible eliminarlo, inténtelo de nuevo',
                                icon: 'error',
                                confirmButtonText: 'Cerrar'
                            });
                        </script>";
                    unset($_SESSION['error7']); // Eliminar la variable de sesión
                }
                ?>
                <!-- FIN DE VENTANA DE VERIFICACION -->   
                </div>                                           
            </section>
        </main>

        <!-- PIE DE PÁGINA -->
        <footer id="pie-productos">
        </footer>            

    </div>
</body>
</html>