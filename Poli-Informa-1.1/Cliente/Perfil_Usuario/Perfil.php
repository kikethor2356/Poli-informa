
<?php require 'ConexFuncion.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Perfil.css">
    <title>Mi perfil</title>
</head>
<body>
    <div class="contenedor">
    <?php
        $registro = mysqli_query($conexion, "SELECT * FROM registroalu");

        while($mostrar = mysqli_fetch_array($registro)){
                                
        ?>
        <div class="contenidoImg">
            <img src="/Poli-Informa-1.1/Administrador/RegistroAlumnos/imagenes1/<?php echo $mostrar["AluImage"]; ?>">
        </div>
        <div class="c_code">
            <h3><?php echo $mostrar["CodeAlu"]; ?></h3>

        </div>
        <div class="c_nombre">
            <h3><?php echo $mostrar["AluNom"]; ?> <?php echo $mostrar["AluApellidoP"]; ?> <?php echo $mostrar["AluApellidoM"]; ?></h3>
        </div>
        <div class="c_carrera">
            <h4><?php echo $mostrar["AluCarrera"]; ?></h4>
        </div>
        <div class="c_correo">
            <h4><?php echo $mostrar["AluCorreo"]; ?></h4>
        </div>
        <?php                
            }//FIN WHILE
        ?>
    </div>
</body>
</html>