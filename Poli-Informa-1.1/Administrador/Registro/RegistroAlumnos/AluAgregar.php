<?php require 'ConexFuncion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/AdReg.css">
    <title>Registro Administradores</title>
</head>
<body>
    <div class="envoltura">
        <div class="registroEnvoltura">
            <form class="" action="" method="post" enctype="multipart/form-data">
                <table>
                    <h1 class="tit">Registrate!</h1>
                    <a href="AluControlR.php">Control Administrador</a>
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
                        <input type="email" name="AluCorreo" placeholder="anonimato@gmail.com" required>
                    </div>
                    <div class="input-group">
                        <label>Imagen Administrador:</label>
                        <input type="file" name="file" required>
                    </div>
                    <div class="input-group">
                        <label>Contraseña:</label>
                        <input type="password" name="AluPassword" id="password" placeholder="Anonimato123" onblur="validarPassword()" required>
                        <span id="passwordError" class="error-message"></span>
                    </div>

                        <button type="submit" name="submit" value="add">Guardar</button>
                        <button type="reset">Borrar</button>
                </table>
            </form>
        </div>
    </div>
<script src="JS/AdFunciones.js"></script>
</body>

</html>