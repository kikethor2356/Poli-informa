<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script src="JS/java.js"></script>
    <link rel="stylesheet" href="style/diseño.css">
    <title>Enviar Correo</title>
</head>
<body>

    <img src="Img/fondo.png" alt="fondo" id="fondo">
    <div class="contenedor_inicio_sesion" style="height: 65vh;">
        <div class="inicio_sesion">
            <div class="elemento">
                <img src="Img/usuario.png" alt="img_usuario">
            </div>
            <div class="elemento">
                <h1>Recuperar contraseña</h1>
            </div>
            <form action="PHP/nueva_recovery.php" method="post" enctype="multipart/form-data">
                <div class="elemento">
                    <input type="text" name="new_pass" id="new_pass" placeholder=" ">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <label for="correo">Nueva contraseña</label>
                    <i class="fa-regular fa-user"></i>
                </div>
                <div class="elemento">
                    <button type="submit" id="btn_iniciar_sesion" name="btn_iniciar_sesion">Enviar</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>