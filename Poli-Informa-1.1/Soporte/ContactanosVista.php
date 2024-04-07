<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactanos</title>
    <link rel="stylesheet" href="estilos.css">
    <script src="https://kit.fontawesome.com/eb496ab1a0.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


</head>

<body>
    <?php include 'Menu/MenuUsuario.html'; ?>
    <div class="container-form">
        <div class="info-form">
            <h2>Contactanos</h2>
            <p>¡Hola! Esperamos que estés disfrutando de Poli-Informa.
                <br>¿En qué podemos ayudarte? Si necesitas asistencia,
                envía un mensaje al número de teléfono o al correo
                electrónico.<br>lo contrario, ¡llena el formulario
                para recibir ayuda! <br>¡Estamos aquí para ayudarte!
            </p>

            <a href="#">
                <i class="fa fa-phone"></i>
                +52 3326770713
            </a>
            <a href="#">
                <i class="fa fa-envelope"></i>
                poli-informa@gmail.com
            </a>
            <a href="#">
                <i class="fa fa-map-marked"></i>
                Guadalajara, Jalisco, México
            </a>
        </div>
        <form action="Contactanos.php" method="post" autocomplete="off">
            <input type="text" name="nombre" placeholder="Ingresa tu nombre" class="campo">
            <input type="email" name="email" placeholder="Ingresa el email" class="campo">
            <textarea name="mensaje" placeholder="Ingresa un mensaje"></textarea>
            <input type="submit" name="enviar" value="Enviar mensaje" class="btn-enviar">
        </form>

    </div>
    
    <script>
        // Verificar si la URL tiene el parámetro enviado=true
        const urlParams = new URLSearchParams(window.location.search);
        const enviado = urlParams.get('enviado');

        // Si el correo se ha enviado correctamente, mostrar una ventana emergente personalizada
        if (enviado === 'true') {
            // Mensaje de éxito personalizado con SweetAlert
            Swal.fire({ 
                title: '¡Correo enviado!',
                text: 'Tu mensaje se ha enviado correctamente. Nos pondremos en contacto contigo pronto.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        }

    </script>
</body>

</html>