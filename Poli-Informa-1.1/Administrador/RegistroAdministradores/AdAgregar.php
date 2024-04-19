<?php require 'ConexFuncion.php'; 

$db = new Database();
$conexion = $db->connect();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/AdReg.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Registro Administradores</title>
</head>
<body>
    <div class="envoltura">
        <div class="registroEnvoltura">
            <form class="" action="ConexFuncion.php" method="POST" enctype="multipart/form-data">
                <table>
                    <h1 class="tit">Registrate!</h1>
                    <a href="AdControlR.php">Control Administrador</a>
                    <div class="input-group">
                        <label>Codigo:</label>
                        <input type="text" maxlength="9" minlength="9" name="AdCode" placeholder="123456789" id="soloNumeros" oninput="validarLonCo(this)" required>
                    </div>
                    <div class="input-group">
                        <label>Nombre:</label>
                        <input type="text" maxlength="15" name="AdNombre" placeholder="Anonimo" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Apellido Paterno:</label>
                        <input type="text" maxlength="15"  name="AdApellidoP" placeholder="Anonimato" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Apellido Materno:</label>
                        <input type="text" maxlength="15" name="AdApellidoM" placeholder="Anonimatario" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Carrera:</label>
                        <input type="text"  maxlength="7" name="AdCarrera" placeholder="TPSI" onkeypress="validarInput(event)" required>
                    </div>
                    <div class="input-group">
                        <label>Correo:</label>
                        <input type="email" name="AdCorreo" placeholder="anonimato@gmail.com" required>
                    </div>
                    <div class="input-group">
                        <label>Imagen Administrador:</label>
                        <!-- <input type="file" name="file" required>
                    </div>

                    <div id="contenedor-imagen">                    -->
                        <input type="file" name="AdImagen" id="AdImagen" required> 
                        <!-- <label for="imagenInput" id="AdImagen"><i class="fa-solid fa-upload"></i>Seleccionar Imagen</label> -->
                        <!-- <img src="" id="imagenPreview" alt="Imagen del producto"> -->
                        <!-- <input type="text" id="nombreArchivo" readonly> -->
                    </div>
                    
                    <div class="input-group">
                        <label>Contraseña:</label>
                        <input type="password" name="AdPassword" id="password" placeholder="Anonimato123" onblur="validarPassword()" required>
                        <span id="passwordError" class="error-message"></span>
                    </div>
                        <button type="submit" name="submit" value="Agregar">Agregar</button>
                        <button type="reset">Borrar</button>
                </table>
            </form>
        </div>
    </div>

    
</body>
<script src="JS/AdFunciones.js"></script>

</html>