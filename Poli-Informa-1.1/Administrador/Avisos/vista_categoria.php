<?php 
    require '../../Conexion/conexion.php';
    session_start();
    $db = new Database();
$conexion = $db->connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/DiseñoAvisos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Avisos</title>
</head>
<body>
    <div id="productos">
        <!-- OPCIONES DEL ADMINISTRADOR -->
        <nav id="navegacion-productos">        
            <h4>Avisos</h4>
            <ul id="opciones-productos">
            </ul>
        </nav>

        <!-- ÁREA DE TRABAJO -->
        <main id="principal-productos">
            <section id="section-productos">
                <div id="mostrarProductos">
                    <h1>Avisos</h1>
                    
                    <button id="nuevoProducto" class="nuevoProducto" name="nuevoProducto" title="Agregar Producto" onclick="mostrarVentana()"><i class="fa-solid fa-circle-plus"></i> Agregar Producto</button>   

                    <table id="tablaProductos" border="1px">
                        <thead id="cabeceraTabla">
                            <tr class="tabla">
                                <th id="cabezaNombre">Informacion</th>
                                <th id="cabezaImagen">Imagen</th>
                                <th id="Acciones">Opciones</th>
                            </tr>
                        </thead>

                        <?php
                            $consulta="SELECT * FROM avisos";
                            $row = mysqli_query($conexion, $consulta);
                            
                            if (mysqli_num_rows($row) > 0){ 
                                $contador = 1; //LLEVA EL SEGUIMIENTO DE LAS FILAS

                                foreach($row as $fila){
                                    $categoria = $fila['categoria'];
                                    $foto = $fila['foto'];
                                    $id_categoria = $fila['id_categoria'];

                                    //DETERMINA LA CLASE QUE SE ASIGNARÁ A CADA FILA EN FUNCIÓN DE SI ES PAR O IMPAR
                                    $clase_fila = ($contador % 2 == 0) ? 'fila2' : 'fila1';
                                    ?>
                                
                                    <tr>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoNombre" name="campoNombre" value="<?php echo $fila['categoria']; ?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>"><input type="text" id="campoImagen" name="campoImagen" value="<?php echo $fila['foto']; ?>" readonly></td>
                                        <td class="<?php echo $clase_fila; ?>" id="cabezaAcciones">
                                            <div class="acciones-buttons">
                                                <button class="iconoVer" type="button" onclick="abrirVentanaVisualizar('<?php echo $fila['categoria']; ?>', '<?php echo $fila['foto']; ?>')"><i class="fa-solid fa-eye"></i></button>
                                                <!-- Aquí cambiamos el ID a una clase y agregamos atributos de datos para toda la fila -->
                                                <button type="button" class="iconoEditar" title="Editar registro" onclick="abrirVentanaEditar('<?php echo $fila['id_categoria']; ?>', '<?php echo $fila['categoria']; ?>', '<?php echo $fila['foto']; ?>', '<?php echo $fila['foto']; ?>')"><i class="fa-solid fa-pen-to-square"></i></button>
                                                <form id="eliminarForm_<?php echo $fila['id_categoria']; ?>" action="eliminar_categoria.php" method="POST">
                                                <input type="hidden" name="eliminar_id" value="<?php echo $fila['id_categoria']; ?>">
                                                <input type="hidden" name="eliminar_imagen" value="<?php echo $fila['foto']; ?>">
                                                <!-- Ventana emergente de confirmación -->
                                                <div class="contenedor-modal">
                                                    <div class="contenedor-eliminar">
                                                        <p>¿Seguro que quieres eliminar el registro?</p>
                                                        <button type="submit" class="confirmarBtn" name="Eliminar_imag_id" id="Eliminar_imag_id">Eliminar</button>
                                                        <button type="button" class="cancelarBtn" onclick="cerrarVentanaEliminar()">Cancelar</button>
                                                    </div>
                                                </div>
                                                <button type="button" class="iconoEliminar" title="Eliminar registro" onclick="mostrarConfirmacion('<?php echo $fila['id_categoria']; ?>')"><i class="fa-solid fa-trash-can"></i></button>
                                            </form>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    // Incrementa el contador
                                    $contador++;
                                }
                            } else {
                                ?>
                                <tr><td colspan=2>No hay avisos disponibles</td></tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>
            </section>
        </main>
    </div>

    <!-- ELIMINAR: FUNCIONES JAVASCRIPT -->
    <script>
        // Para eliminar el producto
        // Función para mostrar la ventana de confirmación al eliminar un producto
        function mostrarConfirmacion(id) {
            let modal = document.querySelector('.contenedor-modal');
            let confirmarBtn = document.querySelector('.confirmarBtn');
            let cancelarBtn = document.querySelector('.cancelarBtn');

            // Mostrar el modal
            modal.classList.add('mostrar-modal');

            // Configurar el evento para cerrar el modal al hacer clic en Cancelar
            cancelarBtn.addEventListener("click", function() {
                modal.classList.remove('mostrar-modal');
            });

            // Configurar el evento para enviar el formulario al hacer clic en Confirmar
            confirmarBtn.addEventListener("click", function(event) {
                console.log("Eliminar el producto con ID:", id);
                modal.classList.remove('mostrar-modal');
                event.preventDefault();
                document.getElementById('eliminarForm_' + id).submit();
            });    
        }
        function cerrarVentanaEliminar() {
            let modal = document.querySelector(".contenedor-modal");
            modal.classList.remove('mostrar-modal');
        }
    </script>

    <!-- MOSTRAR: VENTANA MODAL -->
    <div class="ventanaVisualizarProducto" id="ventanaVisualizarProducto">
        <div class="contenidoVentanaVisualizarProducto">
            <!-- Contenido de la ventana emergente de visualización -->
            <h2>Mostrar Producto</h2>
            <p id="nombreProducto"></p>
            <div id="contenedor-imagen3">
                <img id="imagenProducto" src="" alt="">    
            </div>
            <button onclick="cerrarVentanaVisualizar()" class="vetanacerrarvista">Cerrar</button>
        </div>
    </div>

    <!-- MOSTRAR: FUNCIONES JAVASCRIPT -->
    <script>
        function abrirVentanaVisualizar(nombre, imagen) {
            let modal = document.getElementById('ventanaVisualizarProducto'); // Obtenemos la ventana por su ID único
            modal.classList.add('enseñar_Ver'); // Agrega la clase para mostrar la ventana

            var nombreProducto = document.getElementById("nombreProducto");
            var imagenProducto = document.getElementById("imagenProducto");

            nombreProducto.textContent = "Informacion: " + nombre;
            imagenProducto.src = "fotos/" + imagen;
        }
        function cerrarVentanaVisualizar() {
            let modal = document.getElementById('ventanaVisualizarProducto'); // Obtenemos la ventana por su ID único
            modal.classList.remove('enseñar_Ver'); // Removemos la clase para ocultar la ventana
        }
    </script>

    <!-- EDITAR: VENTANA MODAL -->
    <div class="ventanaEditarProducto">
        <!-- Contenido de la ventana modal -->
        <div class="contenidoVentanaEditarProducto">
            <span class="close">&times;</span>
            <h2>EDITAR CATEGORIA</h2>
            <form action="modificar_categoria.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id_categoria1" name="id_categoria">

                <p>Nombre de categoria</p>
                <input type="text" id="categoria1" name="categoria" placeholder="Nombre del aviso">

                <div id="contenedor-imagen1">
                    <label id="imagen_mos">Elegir imagen:</label>
                    <input type="file" name="foto" id="imagenInputEditar" onchange="previewImageEditar(this)">
                    <input type="hidden" id="imagen_old" name="imagen_old">
                    <label for="imagenInputEditar" id="foto"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label>
                    <img src="" id="imagenPreviewEditar"><br><br>
                    <input type="text" id="nombreArchivoEditar" readonly>
                </div>

                <button type="submit" name="Guardar" id="Guardar">Guardar</button>
                <button type="button" class="ventanacerrarEditar" onclick="cerrarVentanaEditar()">Cancelar</button>
            </form>
        </div>
    </div>

    <!-- EDITAR: FUNCIONES JAVASCRIPT -->
    <script>
        function abrirVentanaEditar(id, nombre, imagen, nombre_imagen){
            // Para mostrar ventana
            let abrir = event.target; // Selecciona el botón que se ha hecho clic
            let modal = document.querySelector('.ventanaEditarProducto');
            let cerrar = document.querySelector('.ventanacerrarEditar');
            modal.classList.add('enseñar_Editar'); // Agrega la clase para mostrar la ventana

            // Datos para editar
            var idInput = document.getElementById("id_categoria1");
            var nombreAviso = document.getElementById("categoria1");
            var imagenOldInput = document.getElementById("imagen_old");
            var imagenPreview = document.getElementById("imagenPreviewEditar");

            // Actualiza los valores de los campos de entrada con los datos del registro seleccionado
            idInput.value = id;
            nombreAviso.value = nombre;
            imagenOldInput.value = imagen;

            // Elimina el atributo readonly de los campos de entrada
            nombreAviso.removeAttribute('readonly');
            imagenOldInput.removeAttribute('readonly');


            if(imagen){
                imagenPreview.src = "fotos/" + imagen;
            } else{
                imagenPreview.src = "";
            }

            // Establecer el valor del campo de entrada de imagen en blanco para que no muestre la imagen anterior
            document.getElementById('imagenInputEditar').value = '';

            // Llama a previewImageEditar con el nombre de la imagen
            previewImageEditar(nombre_imagen);
            }
            function previewImageEditar(input) {
            var filenameInput = document.getElementById('nombreArchivoEditar');
            var file;

            if (input instanceof File) {
                file = input;
                filenameInput.value = file.name;
            } else {
                filenameInput.value = input;
                var files = input.files;
                if (files.length > 0) {
                    file = files[0];
                } else {
                    filenameInput.value = "";
                    return;
                }
            }

            filenameInput.value = file.name;

            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imagenPreviewEditar').src = e.target.result;
            };

            reader.readAsDataURL(file);
        }
            function cerrarVentanaEditar() {
                document.querySelector(".ventanaEditarProducto").classList.remove('enseñar_Editar'); // Oculta la ventana de edición
            }
    </script>

    <!-- AGREGAR: VENTANA MODAL -->
    <div class="ventanaEmergente" >
        <!-- Contenido de la ventana modal -->
        <div class="contenidoVentanaEmergente">
            <span class="close">&times;</span>
            <h2>Registro</h2>
            <form action="agregar_categoria.php" method="post" enctype="multipart/form-data">

                <input type="text" id="nombre" name="categoria" required placeholder="Nombre de Producto">
                
                <div id="contenedor-imagen">                   
                    <input type="file" name="foto" id="imagenInput" onchange="previewImage()" required> 
                    <label for="imagenInput" id="imagen"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label>
                    <img src="" id="imagenPreview" alt="">
                    <input type="text" id="nombreArchivo" readonly>
                </div>

                <button type="submit" name="Agregar1" id="Agregar1">Agregar Producto</button>
                <button type="button" class="ventanacerrar" onclick="limpiarDatos()">Cancelar</button>

            </form>
        </div>
    </div>

    <!-- AGREGAR: FUNCIONES JAVASCRIPT -->
    <script>
        function mostrarVentana() {
            let abrir = document.querySelector('.nuevoProducto');
            let modal = document.querySelector('.ventanaEmergente');
            let cerrar = document.querySelector('.ventanacerrar');
            abrir.addEventListener("click", ()=>{
                modal.classList.add('enseñar_modal');
            });
            cerrar.addEventListener("click", ()=>{
                modal.classList.remove('enseñar_modal');
            });
        }
        // Función para borrar los datos cuando se presiona el botón "Cancelar"
        function limpiarDatos() {
            document.getElementById('nombre').value = "";
            document.getElementById('imagenInput').value = "";
            document.getElementById('imagenPreview').src = "";
            document.getElementById('nombreArchivo').value = "";
        }
        window.onload = mostrarVentana;

        function previewImage() {
            var preview = document.getElementById('imagenPreview');
            var file = document.getElementById('imagenInput').files[0];
            var reader = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
                // Mostrar el nombre del archivo
                document.getElementById('nombreArchivo').value = file.name;
            } else {
                preview.src = "";
                // Borrar el nombre del archivo si no se selecciona ninguna imagen
                document.getElementById('nombreArchivo').value = "";
            }
        }

    </script>

    <!-- ELIMINAR: VENTANA -->
    <div id="ModalAgregar" class="modal" >
        <!-- Contenido de la ventana modal -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <h1>Registro</h1>
            <form action="agregar_categoria.php" method="post" enctype="multipart/form-data">

                <label>Nombre de categoria</label>
                <input REQUIRED type="text" name="categoria"><br><br><br>

                <label>Elegir imagen: </label>
                <input REQUIRED type="file" name="foto" id="imagenInput2" onchange="previewImage2()"><br><br><br>
                <img src="" id="imagenPreview2" width=80px height=auto><br><br><br>
                <label id="fileNameDisplay2"></label><br><br>

                <input type="submit" value="Guardar" name="Enviar1">
                <button type="button" onclick="cerrarModal2()">Cancelar</button>

            </form>
        </div>
    </div>

</body>
</html>