<?php require 'ConexFuncion.php'; 
    include '../LoginA/inicio.php';
    $db = new Database();
    $conexion = $db->connect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="css/AluReg.css">
    <title>Registro Alumnos</title>
</head>
<body>
    <div class="envoltura">
        <div class="registroEnvoltura">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <table>
                    <h1 class="tit">Registrate!</h1>
                    <a href="AluControl.php">Control Usuario</a>
                    <div class="input-group">
                        <label>Codigo:</label>
                        <input type="text" maxlength="9" minlength="9" name="CodeAlu" placeholder="123456789" id="soloNumeros" oninput="validarLonCo(this)" required>
                    </div>
                    <div class="input-group">
                        <label>Nombre:</label>
                        <input type="text" maxlength="15" name="AluNom" placeholder="Anonimo" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Apellido Paterno:</label>
                        <input type="text" maxlength="15"  name="AluApellidoP" placeholder="Anonimato" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Apellido Materno:</label>
                        <input type="text" maxlength="15" name="AluApellidoM" placeholder="Anonimatario" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Carrera:</label>
                        <input type="text"  maxlength="7" name="AluCarrera" placeholder="TPSI" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Correo:</label>
                        <input type="email" name="AluCorreo" placeholder="anonimato@alumnos.udg.mx" required>
                    </div>
                    <div class="input-group">
                        <label>Imagen Usuario:</label>
                        <!-- <input type="file" name="file" required>
                    </div>

                    <div id="contenedor-imagen">                    -->
                    <input type="file" name="AluImage" id="AluImage" required> 
                        <!-- <label for="imagenInput" id="AdImagen"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label> -->
                        <!-- <img src="" id="imagenPreview" alt="Imagen del producto"> -->
                        <!-- <input type="text" id="nombreArchivo" readonly> -->
                    </div>

                    <div class="input-group">
                        <label>Contraseña:</label>
                        <input type="password" name="AluPassword" id="password" placeholder="Anonimato123" onblur="validarPassword()" required>
                        <i class="fa-solid fa-lock"></i>
                        <a href="#" id="link_ver_contraseña" color="white"><i class="fa-regular fa-eye"></i></a>
                        <span id="passwordError" class="error-message"></span>
                    </div>

                        <button type="submit" name="submit" value="Agregar">Agregar</button>
                        <button type="reset">Borrar</button>
                </table>
            </form>
        </div>
    </div>
<script src="JS/AluFunciones.js"></script>

</body>

</html>