<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/ventanaAdministradores.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="../style/diseño.css">
    <script src="../js/productos.js"></script>
    <title>Administrador - Productos</title>
</head>
<body>


    <div id="productos">

        <!-- OPCIONES DEL ADMINISTRADOR -->
        <nav id="navegacion-productos">        
            
            <h4>Productos</h4>
            
            <ul id="opciones-productos">
                <li onclick="opcionAdministrador(1)">Mostrar</li>
            </ul>

            <h4>Vendedores</h4>
            
            <ul id="opciones-productos">
                <li onclick="opcionAdministrador(2)">Lista</li>
            </ul>


        </nav>



        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">

            <section id="section-productos">

                    <div id="mostrarProductos" hidden>

                        <h1>Lista de productos</h1>

                        <input type="text" id="buscar-producto" placeholder="Ingresar nombre del producto">

                        <a href="BD/agregar.php"><button id="nuevoProducto" name="nuevoProducto"><i class="fa-solid fa-plus"></i>&nbsp;Agregar producto</button></a>

                        <table id="tablaProductos" border="1px">
                            
                            <thead id="cabeceraTabla">
                                <tr>
                                    <th id="cabezaID">ID</th>
                                    <th id="cabezaNombre">Producto</th>
                                    <th id="cabezaVendedor">Vendedor</th>
                                    <th id="cabezaPrecio">Precio</th>
                                    <th id="cabezaDescripcion">Descripción</th>
                                    <th id="cabezaImagen">Imagen</th>
                                    <th id="cabezaCategoria">Categoría</th>
                                    <th id="cabezaAcciones">Acciones</th>
                                </tr>
                            </thead>
                


                            <?php 

                            include("../../../Conexion/conexion.php");
                            $consulta = "SELECT * FROM PRODUCTOS";
                            $resultado = mysqli_query($conexion, $consulta);
                            
                            $contador = 1; //LLEVA EL SEGUIMIENTO DE LAS FILAS
        
                            while($mostrar=mysqli_fetch_array($resultado)) {

                                //DETERMINA LA CLASE QUE SE ASIGNARÁ A CADA FILA EN FUNCIÓN DE SI ES PAR O IMPAR
                                $clase_fila = ($contador % 2 == 0) ? 'fila2' : 'fila1';
                                ?>
                                <tr>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoID" name="campoID" value="<?php echo $mostrar['ID']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" name="campoNombre" value="<?php echo $mostrar['nombre']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoVendedor" name="campoVendedor" value="<?php echo $mostrar['codigoVendedor']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoPrecio" name="campoPrecio" value="<?php echo $mostrar['precio']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoDescripcion" name="campoDescripcion" value="<?php echo $mostrar['descripcion']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoImagen" name="campoImagen" value="<?php echo $mostrar['nombreImagen']?>" readonly></td>
                                    <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoCategoria" name="campoCategoria" value="<?php echo $mostrar['categoria']?>" readonly></td>
                                    <td id="campoAcciones" name="campoAcciones" class="<?php echo $clase_fila; ?>">
                                        <a href="../PHP/BD/borrar.php?id=<?php echo $mostrar['ID']?>"><img src="../iconos/basura.png" alt="eliminar" id="iconoEliminar" title="Eliminar registro"></a>
                                        <a href="../PHP/BD/editar.php?id=<?php echo $mostrar['ID']?>"><img src="../iconos/editar.png" alt="editar" id="iconoEditar" title="Editar registro"></a>
                                    </td>
                                </tr>
                                <?php

                                // Incrementa el contador
                                $contador++;
                            }
                            ?>

                        </table>

                    </div>


                    <!-- MOSTRAR VENDEDORES -->
                    <div id="mostrarVendedores" >

                        <h1>Lista de vendedores</h1>

                        <a class="modal_abrir_agregar_vendedor" onclick="modalAgregarVendedor()"><button id="nuevoVendedor" name="nuevoVendedor"><i class="fa-solid fa-user-plus"></i>&nbsp;Añadir vendedor</button></a>

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
                            
                                include("../../../Conexion/conexion.php");
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
                                                <img src="../iconos/basura.png" alt="eliminar" id="iconoEliminarVendedor" title="Eliminar vendedor">
                                            </a>
                                            <a class="modal_abrir_editar_vendedor_<?php echo $mostrar['id']; ?>"  onclick="modalEditarVendedor('<?php echo $mostrar['id']; ?>', '<?php echo $mostrar['codigoVendedor']; ?>', '<?php echo $mostrar['nombre']; ?>', '<?php echo $mostrar['descripcion']; ?>', '<?php echo $mostrar['correo']; ?>', '<?php echo $mostrar['telefono']; ?>', '<?php echo $mostrar['horaInicio']; ?>', '<?php echo $mostrar['horaFin']; ?>', '<?php echo $mostrar['foto']; ?>')">
                                                <img src="../iconos/editar.png" alt="editar" id="iconoEditarVendedor" title="Editar vendedor">
                                            </a>
                                        </td>
                                    </tr>
                            </tbody>
                                
                        <?php 

                            $contador++;

                        }//FIN WHILE
                        ?>
                        
                    </table>
                            
                <!-- FIN DE MOSTRAR VENDEDORES -->
                </div>     
                    

                <!-- VENTANAS MODALES -->

                <!-- VENTANA MODAL PARA AGREGAR AL VENDEDOR -->
                <div class="modal_agregar_vendedor">
    
                    <div id="ventana-agregar-vendedor">

                        <h1>Registrar vendedor</h1>

                        <div id="cerrar" class="modal_cerrar_agregar_vendedor">✖</div>

                        <form action="../PHP/BD/Acciones.php?metodo=4" method="post" enctype="multipart/form-data" id="formulario-agregar-vendedor">

                            <div class="formularioIzquierdo">
                                <div class="nombreVendedor">
                                    <label for="nombreVendedor">Nombre</label><br>
                                    <input type="text" id="nombreVendedor" name="nombreVendedor">
                                </div>                

                                <div class="correoVendedor">
                                    <label for="correoVendedor">Correo institucional</label><br>
                                    <input type="text" id="correoVendedor" name="correoVendedor">
                                </div>

                                <div class="descripcionVendedor">
                                    <label for="descripcionVendedor">Descripción</label><br>
                                    <textarea name="descripcionVendedor" id="descripcionVendedor"></textarea>
                                </div>
                            </div>

                            <div class="formularioDerecho">

                                <div class="codigoVendedor">
                                    <label for="codigoVendedor">Código de estudiante</label><br>
                                    <input type="text" id="codigoVendedor" name="codigoVendedor">
                                </div>

                                <div class="telefonoVendedor">
                                    <label for="telefonoVendedor">Teléfono</label><br>
                                    <input type="text" id="telefonoVendedor" name="telefonoVendedor">
                                </div>
                                        
                                <div class="horarioVendedor">
                                    <label>Horario</label><br>

                                    <div class="horarioInicio">
                                        <label for="horarioVendedorInicio">Inicio: </label>
                                        <select name="horarioVendedorInicio" id="horarioVendedorInicio">
                                            <option value="7:00 am">7:00 am</option>
                                            <option value="8:00 am">8:00 am</option>
                                            <option value="9:00 am">9:00 am</option>
                                            <option value="10:00 am">10:00 am</option>
                                            <option value="11:00 am">11:00 am</option>
                                            <option value="12:00 pm">12:00 pm</option>
                                            <option value="13:00 pm">13:00 pm</option>
                                            <option value="14:00 pm">14:00 pm</option>
                                            <option value="15:00 pm">15:00 pm</option>
                                            <option value="16:00 pm">16:00 pm</option>
                                            <option value="17:00 pm">17:00 pm</option>
                                            <option value="18:00 pm">18:00 pm</option>
                                            <option value="19:00 pm">19:00 pm</option>
                                            <option value="20:00 pm">20:00 pm</option>
                                        </select><br>
                                    </div>

                                    <div class="horarioFin">
                                        <label for="horarioVendedorFin">Finalización:</label>
                                        <select name="horarioVendedorFin" id="horarioVendedorFin">
                                            <option value="7:00 am">7:00 am</option>
                                            <option value="8:00 am">8:00 am</option>
                                            <option value="9:00 am">9:00 am</option>
                                            <option value="10:00 am">10:00 am</option>
                                            <option value="11:00 am">11:00 am</option>
                                            <option value="12:00 pm">12:00 pm</option>
                                            <option value="13:00 pm">13:00 pm</option>
                                            <option value="14:00 pm">14:00 pm</option>
                                            <option value="15:00 pm">15:00 pm</option>
                                            <option value="16:00 pm">16:00 pm</option>
                                            <option value="17:00 pm">17:00 pm</option>
                                            <option value="18:00 pm">18:00 pm</option>
                                            <option value="19:00 pm">19:00 pm</option>
                                            <option value="20:00 pm">20:00 pm</option>
                                            <option value="21:00 pm">21:00 pm</option>
                                        </select>
                                    </div>

                                    <div class="fotoVendedor">
                                        <input type="file" id="fotoVendedor" name="fotoVendedor" onchange="mostrarArchivoAgregarVendedor(event)">
                                        <input type="text" id="rutaFotoVendedor" name="rutaFotoVendedor" placeholder="Subir foto del vendedor" readonly>
                                        <label for="fotoVendedor"><i class="fa-solid fa-upload"></i></label>
                                    </div>
                            
                                </div>

                            </div>

                                <input type="submit" id="enviarVendedor" name="enviarVendedor" value="Guardar vendedor" >

                        </form>


                    </div>

                </div>
                <!-- FIN DE VENTANA MODAL PARA AGREGAR AL VENDEDOR -->
                        

                <!-- VENTANA MODAL PARA EDITAR AL VENDEDOR -->
                <?php 

                    include("../../../Conexion/conexion.php");
            
                ?>

                <div class="modal_editar_vendedor">

                    <div id="ventana-editar-vendedor" class="ventana-editar-vendedor">

                        <h1>Editar vendedor</h1>        

                        <div id="cerrar" class="modal_cerrar_editar_vendedor">✖</div>

                        <form action="../PHP/BD/Acciones.php?metodo=5" id="formulario-editar-vendedor" name="formulario-editar-vendedor" enctype="multipart/form-data" method="post">
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
                                <input type="file" id="archivoVendedor" name="archivoVendedor" onchange="mostrarArchivoEditarVendedor(event)">
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
                    

                <!-- VENTANA MODAL PARA BORRAR AL VENDEDOR -->
                <div class="modal_borrar_vendedor">

                    <div id="ventana-borrar-vendedor">

                        <h1>Borrar registro</h1>

                        <div id="cerrar" class="modal_cerrar_borrar_vendedor">✖</div>

                        <form action="../PHP/BD/Acciones.php?metodo=6" id="formulario-borrar-vendedor" enctype="multipart/form-data" method="post">

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

                                
            </section>

        </main>





        <!-- PIE DE PÁGINA -->
        <footer id="pie-productos">


        </footer>
                    
    </div>






</body>
</html>