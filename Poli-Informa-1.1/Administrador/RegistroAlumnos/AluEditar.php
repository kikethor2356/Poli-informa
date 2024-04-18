<?php
require 'ConexFuncion.php';
$id = $_GET["id"];
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM registroalu WHERE id = $id"));

$db = new Database();
$conexion = $db->connect();
?>
<html>
<head>
    <link rel="stylesheet" href="style/AdEditar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
</head>
<body>
    <form class="col-4 p-3 m-auto" action="" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>Codigo:</td>
                <td><input type="text" maxlength="9" minlength="9" name="CodeAlu" placeholder="123456789" value ="<?php echo $user["CodeAlu"]; ?>" id="soloNumeros" oninput="vaslidarLonCo(this)" required></td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" maxlength="15" name="AluNom" placeholder="Anonimo" value ="<?php echo $user["AluNom"]; ?>" onkeypress="validarInput(event)" required></td>
            </tr>
            <tr>
                <td>Apellido Paterno:</td>
                <td><input type="text" maxlength="15" name="AluApellidoP" placeholder="Anonimato" value ="<?php echo $user["AluApellidoP"]; ?>" onkeypress="validarInput(event)" required></td>
            </tr>
            <tr>
                <td>Apellido Materno:</td>
                <td><input type="text" maxlength="15" name="AluApellidoM" placeholder="Anonimatario" value ="<?php echo $user["AluApellidoM"]; ?>" onkeypress="validarInput(event)" required></td>
            </tr>
            <tr>
                <td>Carrera:</td>
                <td><input type="text" maxlength="7" name="AluCarrera" placeholder="TPSI" value ="<?php echo $user["AluCarrera"]; ?>" required></td>
            </tr>
            <tr>
                <td>Correo:</td>
                <td><input type="email" name="AluCorreo" placeholder="anonimato@gmail.com" value ="<?php echo $user["AluCorreo"]; ?>" required></td>
            </tr>
            <tr>
                <td>Imagen Administrador:</td>
                <td><input type="file" name="file" required></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" name="AluPassword" id="password" placeholder="Anonimato123" value ="<?php echo $user["AluPassword"]; ?>" onblur="validarPassword()" required></td>
                <span id="passwordError" class="error-message"></span>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="edit" >Editar</td>
                <td><a href="AluControlR.php"><i class="fa-solid fa-right-to-bracket"></i></a></td>
            </tr>
        </table>
    </form>
    <br>
</body>
    <script src="JS/AdFunciones.js"></script>
</html>