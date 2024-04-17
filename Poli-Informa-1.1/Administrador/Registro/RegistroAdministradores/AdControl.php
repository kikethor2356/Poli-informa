<?php require 'ConexFuncion.php'; ?>

<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/AdControlR1.css">
    <link rel="stylesheet" href="menu.css">
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="tit">Control de Administrador</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">

        <a href="AdAgregar.php" class="btn btn-primary" ><i class="fa-solid fa-mostrar-plus">Agregar</i></a>

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
                $registro = mysqli_query($conn, "SELECT * FROM registro");

                while($mostrar = mysqli_fetch_array($registro)){
                ?>

                <tr>
                    
                    <td> <?php echo $mostrar["AdCode"]; ?> </td>
                    <td> <?php echo $mostrar["AdNombre"]; ?> </td>
                    <td> <?php echo $mostrar["AdApellidoP"]; ?> </td>
                    <td> <?php echo $mostrar["AdApellidoM"]; ?> </td>
                    <td> <?php echo $mostrar["AdCarrera"]; ?> </td>
                    <td> <?php echo $mostrar["AdCorreo"]; ?> </td>
                    <td> <?php echo $mostrar["AdImagen"]; ?></td>
                    <td> <?php echo $mostrar["AdPassword"]; ?> </td>
                    <td>

                        <a onclick="mostrarEditar('<?php echo $mostrar['AdCode']; ?>', '<?php echo $mostrar['AdNombre']; ?>', 
                        '<?php echo $mostrar['AdApellidoP']; ?>', '<?php echo $mostrar['AdApellidoM']; ?>', 
                        '<?php echo $mostrar['AdCarrera']; ?>', '<?php echo $mostrar['AdCorreo']; ?>', 
                        '<?php echo $mostrar['AdPassword']; ?>', '<?php echo $mostrar['id']; ?>')" 
                        id="abrirModal_<?php echo $mostrar['AdCode']; ?>" 
                        class="btn btn-samll btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="mostrarBorrar('<?php echo $mostrar['id'];?>')">
                            <i class="fa-regular fa-trash-can"></i>
                        </button>

                    </td>
                </tr>
                <?php 
                
                    }//FIN WHILE
                    
                ?>
            </table>
        </form>    
        <br>


        <div class="modal_editar">
            <div class="contenidoVentanaEmergente">
                <div class="contenidoFooter">
                    <h2>Editar Administrador</h2>
                </div>
                <form  action="" method="post" enctype="multipart/form-data" class="formulario_modal">
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
                        <td><input type="text" maxlength="15" name="AdApellidoM" placeholder="Anonimatario" value="" id="campoApellidoMaterno"  onkeypress="validarInput(event)" required></td>
                    </tr>
                    <tr>
                        <td>Carrera:</td>
                        <td><input type="text" maxlength="7" name="AdCarrera" placeholder="TPSI" value="" id="campoCarrera"  required></td>
                    </tr>
                    <tr>
                        <td>Correo:</td>
                        <td><input type="email" name="AdCorreo" placeholder="anonimato@gmail.com" value="" id="campoCorreo"  required></td>
                    </tr>
                    <tr>
                        <td>Imagen Administrador:</td>
                        <td><input type="file" name="file" required></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td><input type="password" name="AdPassword" id="password" placeholder="Anonimato123" value="" onblur="validarPassword()" required></td>
                                            <span id="passwordError" class="error-message"></span>
                    </tr>
                    <tr>
                        <td><button class="cerrarModal" onclick="mostrarEditar()">Cancelar</button></td>
                        <td><input type="submit" name="submit" value="Editar"></td>
                    </tr>
                </table>
                </form>
            </div>
        </div> <!-- .modal_editar -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="" action="" method="post" enctype="multipart/form-data">
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



        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        
        <script src="JS/AdFunciones.js"></script>
    </body>
</html>