

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactanos</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/Cotactanos.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
    <?php include '../../Partes/MenuUsuario.php'?>

    <div class="home">
        <div class="text">
            <div class="container-form">
                <div class="info-form">
                    <h2>Contactanos</h2>
                    <p>¡Hola! Bienvenido a Poli-Informa. Esperamos que estés disfrutando tu experiencia con nosotros.
                        <br><strong>¿En qué podemos ayudarte?</strong>
                        <br>Si necesitas asistencia, envía un mensaje al número de teléfono <strong>(+52) 3326-770-713</strong> o al correo electrónico <strong>poli-informa.com</strong>.
                        <br>De lo contrario, ¡llena el formulario para recibir ayuda!
                        <br><strong>¡Estamos aquí para ayudarte!</strong>
                    </p>

                    <a href="#">
                        <i class="fa fa-phone"></i>
                        +52 3326770713
                    </a>
                    <a href="mailto:info.poli.informa@gmail.com">
                        <i class="fa fa-envelope"></i>
                        info.poli.informa@gmail.com
                    </a>
                    <a href="#">
                        <i class="fa fa-map-marked"></i>
                        Guadalajara, Jalisco, México
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="contenedor">
        <form action="UsInsertar.php" method="post">
            <h1>Quejas y sugerencias</h1>

            <label>Nombre:</label>
            <input type="text" name="UsNombre" required><br>

            <label>Correo:</label>
            <input type="email" name="UsCorreo" required><br>

            <label>Comentario:</label>
            <textarea id="message" name="UsComentario" rows="4" required></textarea>

            <button class="boton" type="submit" value="registrar" name="registro">Enviar</button>
        </form>
    </div>

    
    
</body>
</html>