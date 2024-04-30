<?php require 'ConexFuncion.php'; 

$db = new Database();
$conexion = $db->connect();
?>
<?php include '../LoginA/inicio.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/AluControl.css">
    <link rel="stylesheet" href="../Menu/menu.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
    <title>Registro Usuario</title>
</head>
<body>
    <div id="productos">
        <main id="principal-productos">
            <section id="section-productos">
                <?php include '../Menu/menu.html'; ?>

                    <h1 class="tit">Control de Usuarios</h1>
                    <form class="ConexFuncion.php" action="" method="post" enctype="multipart/form-data">

                    <a href="AluAgregar.php" class="btn btn-primary" ><i class="fa-solid fa-mostrar-plus">Agregar</i></a>

                        <table class="table" cellpadding = 10 cellspacing = 0>
                            <tr>
                                <th scope="col">Codigo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ap. Parteno</th>
                                <th scope="col">Ap. Materno</th>
                                <th scope="col">Carrera</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Password</th>
                                <th scope="col">Opciones</th>
                            </tr>
                            <?php
                            $registro = mysqli_query($conexion, "SELECT * FROM registroalu");

                            while($mostrar = mysqli_fetch_array($registro)){
                                
                                            
                            
                            ?>

                            <tr>
                                
                                <td> <?php echo $mostrar["CodeAlu"]; ?> </td>
                                <td> <?php echo $mostrar["AluNom"]; ?> </td>
                                <td> <?php echo $mostrar["AluApellidoP"]; ?> </td>
                                <td> <?php echo $mostrar["AluApellidoM"]; ?> </td>
                                <td> <?php echo $mostrar["AluCarrera"]; ?> </td>
                                <td> <?php echo $mostrar["AluCorreo"]; ?> </td>
                                <td> <?php echo $mostrar["AluImage"]; ?></td>
                                <td> <?php echo $mostrar["AluPassword"]; ?> </td>
                                <td>

                                    <button type="button" class="btn btn-samll btn-warning" onclick="mostrarEditar('<?php echo $mostrar['id']; ?>' ,'<?php echo $mostrar['CodeAlu']; ?>', 
                                    '<?php echo $mostrar['AluNom']; ?>', '<?php echo $mostrar['AluApellidoP']; ?>', '<?php echo $mostrar['AluApellidoM']; ?>', 
                                    '<?php echo $mostrar['AluCarrera']; ?>', '<?php echo $mostrar['AluCorreo']; ?>', '<?php echo $mostrar['AluImage']; ?>', 
                                    '<?php echo $mostrar['AluPassword']; ?>', '<?php echo $mostrar['AluImage']; ?>')"><i class="fa-regular fa-pen-to-square"></i></button>
                                    <!-- Button trigger modal -->
                                    <form id="eliminarForm_<?php echo $mostrar['id']; ?>" action="ConexFuncion.php" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="idEliminar" value="<?php echo $mostrar['id']; ?>">
                                        <input type="hidden" name="eliminar_imagen" value="<?php echo $mostrar['AluImage']; ?>">

                                        <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="mostrarBorrar(<?php echo $mostrar['id']; ?>)">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>   
                                    </form>
                                </td>
                            </tr>
                            <?php 
                            
                                }//FIN WHILE
                                
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
                                    <td><input type="email" name="AluCorreo" placeholder="anonimato@gmail.com" value="" id="campoCorreo"  required></td>
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
                                    <td>Contraseña:</td>
                                    <td><input type="password" name="AluPassword" id="password" placeholder="Anonimato123" value="" onblur="validarPassword()" required></td>
                                    <span id="passwordError" class="error-message"></span>
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