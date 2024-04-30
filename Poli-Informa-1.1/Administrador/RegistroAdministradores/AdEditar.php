<?php
require 'ConexFuncion.php';
$id = $_GET["id"];
$user = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM registro WHERE id = $id"));

$db = new Database();
$conexion = $db->connect();
?>
<html>
<head>
    <link rel="stylesheet" href="css/AdEditar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/d6736406d6.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form class="col-4 p-3 m-auto" action="ConexFuncion.php" method="post" enctype="multipart/form-data">
        <table border="1">
            <tr>
                <td>Codigo:</td>
                <td><input type="text" maxlength="9" minlength="9" name="AdCode" placeholder="123456789" value ="<?php echo $user["AdCode"]; ?>" id="soloNumeros" oninput="vaslidarLonCo(this)" required></td>
            </tr>
            <tr>
                <td>Nombre:</td>
                <td><input type="text" maxlength="15" name="AdNombre" placeholder="Anonimo" value ="<?php echo $user["AdNombre"]; ?>" onkeypress="validarInput(event)" required></td>
            </tr>
            <tr>
                <td>Apellido Paterno:</td>
                <td><input type="text" maxlength="15" name="AdApellidoP" placeholder="Anonimato" value ="<?php echo $user["AdApellidoP"]; ?>" onkeypress="validarInput(event)" required></td>
            </tr>
            <tr>
                <td>Apellido Materno:</td>
                <td><input type="text" maxlength="15" name="AdApellidoM" placeholder="Anonimatario" value ="<?php echo $user["AdApellidoM"]; ?>" onkeypress="validarInput(event)" required></td>
            </tr>
            <tr>
                <td>Carrera:</td>
                <td><input type="text" maxlength="7" name="AdCarrera" placeholder="TPSI" value ="<?php echo $user["AdCarrera"]; ?>" required></td>
            </tr>
            <tr>
                <td>Correo:</td>
                <td><input type="email" name="AdCorreo" placeholder="anonimato@gmail.com" value ="<?php echo $user["AdCorreo"]; ?>" required></td>
            </tr>
            <tr>
                <td>Imagen Administrador:</td>
                <td><input type="file" name="file" required></td>
            </tr>
            <tr>
                <td>Contraseña:</td>
                <td><input type="password" name="AdPassword" id="password" placeholder="Anonimato123" value ="<?php echo $user["AdPassword"]; ?>" onblur="validarPassword()" required></td>
                <span id="passwordError" class="error-message"></span>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Editar" >Editar</td>
                <td><a href="AdControlR.php"><i class="fa-solid fa-right-to-bracket"></i></a></td>
            </tr>
        </table>
    </form>
    <br>
</body>
    <script src="JS/AdFunciones.js"></script>
</html>