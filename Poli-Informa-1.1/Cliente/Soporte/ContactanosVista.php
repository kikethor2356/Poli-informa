
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
    <?php include '../Partes/MenuUsuario.php'; ?>
    <div class="home">
        <header class="cabecera">
            <img class="cabecera__imagen"  src="imagenes/Contactanos.jpg" alt="imagen terminos y condiciones">
        </header>
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

            <div class="contenedor">
                <form action="Contactanos/UsInsertar.php" method="POST">
                    <h1>Poli-informa</h1>
                    <h2>Comentarios y sugerencias</h2>

                    <label>Nombre:</label>
                    <input type="text" name="UsNombre" id="UsNombre" required><br>

                    <label>Correo:</label>
                    <input type="email" name="UsCorreo" id="UsCorreo" required><br>

                    <label>Comentario:</label>
                    <textarea id="UsComentario" name="UsComentario" rows="4" required></textarea>

                    <button class="boton" type="submit" id="registro" name="registro">Enviar</button>
                </form>
            </div>

        </div>
    </div>

    <?php
    if(isset($_SESSION['success']) && $_SESSION['success']) {
        echo "<script>
                Swal.fire({
                    title: 'Agregar',
                    text: 'El registro fue todo un éxito',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            </script>";
        unset($_SESSION['success']); // Eliminar la variable de sesión
    } else if(isset($_SESSION['error']) && $_SESSION['error']) {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'El registro no fue posible, inténtelo de nuevo',
                    icon: 'error',
                    confirmButtonText: 'Cerrar'
                });
            </script>";
        unset($_SESSION['error']); // Eliminar la variable de sesión
    }
    ?>
    
    <?php include '../Partes/footer.php'; ?>
</body>
</html>