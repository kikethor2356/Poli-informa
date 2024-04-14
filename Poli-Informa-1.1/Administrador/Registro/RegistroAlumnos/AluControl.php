<?php require 'ConexFuncion.php'; ?>

<html>
    <head>
    <link rel="stylesheet" href="style/AluAgregar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/AluControl.css">
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <h1 class="tit">Control de Alumnos</h1>
        <form class="" action="" method="post" enctype="multipart/form-data">

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa-solid fa-user-plus"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Registrate</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <table>
                    <tr>
                        <td>Codigo:</td>
                        <td><input type="text" maxlength="9" minlength="9" name="CodeAlu" placeholder="123456789" id="soloNumeros" oninput="validarLonCo(this)" required></td>
                    </tr>
                    <tr>
                        <td>Nombre:</td>
                        <td><input type="text" maxlength="15" name="AluNom" placeholder="Anonimo" onkeypress="validarInput(event)" required></td>
                    </tr>
                    <tr>
                        <td>Apellido Paterno:</td>
                        <td><input type="text" maxlength="15"  name="AluApellidoP" placeholder="Anonimato" onkeypress="validarInput(event)" required></td>
                    </tr>
                    <tr>
                        <td>Apellido Materno:</td>
                        <td><input type="text" maxlength="15" name="AluApellidoM" placeholder="Anonimatario" onkeypress="validarInput(event)" required></td>
                    </tr>
                    <tr>
                        <td>Carrera:</td>
                        <td><input type="text"  maxlength="7" name="AluCarrera" placeholder="TPSI" onkeypress="validarInput(event)" required></td>
                    </tr>
                    <tr>
                        <td>Correo:</td>
                        <td><input type="email" name="AluCorreo" placeholder="anonimato@gmail.com" required></td>
                    </tr>
                    <tr>
                        <td>Imagen Administrador:</td>
                        <td><input type="file" name="file" required></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td><input type="password" name="AluPassword" id="password" placeholder="Anonimato123" onblur="validarPassword()" required></td>
                        <span id="passwordError" class="error-message"></span>
                    </tr>
                </table>
                </div>
                <div class="modal-footer">
                    <tr>
                        <td><input type="submit" name="submit" value="add"></td>
                        <td><input type="reset"></td>
                    </tr>
                </div>
                </div>
            </div>
            </div> 
            <table class="table" cellpadding = 10 cellspacing = 0>
                <tr>
                    <th scope="col">ID</th>
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
                $registro = mysqli_query($conn, "SELECT * FROM registroalu");
                $i = 1;

                foreach($registro as $user) :
                ?>
                <tr>
                    <td> <?php echo $i++; ?> </td>
                    <td> <?php echo $user["CodeAlu"]; ?> </td>
                    <td> <?php echo $user["AluNom"]; ?> </td>
                    <td> <?php echo $user["AluApellidoP"]; ?> </td>
                    <td> <?php echo $user["AluApellidoM"]; ?> </td>
                    <td> <?php echo $user["AluCarrera"]; ?> </td>
                    <td> <?php echo $user["AluCorreo"]; ?> </td>
                    <td> <?php echo $user["AluImage"]; ?></td>
                    <td> <?php echo $user["AluPassword"]; ?> </td>
                    <td>
                        <a href="AluEditar.php?id=<?php echo $user["id"]; ?>" class="btn btn-samll btn-warning"><i class="fa-regular fa-pen-to-square"></i></a>

                        <form class="" action="" method="post">
                            <button class="btn btn-samll btn-danger" type="submit" name="submit" value = <?php echo $user["id"]?>><i class="fa-regular fa-trash-can"></i></button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        </form>    
        <br>
        <script src="JS/AluFunciones.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>