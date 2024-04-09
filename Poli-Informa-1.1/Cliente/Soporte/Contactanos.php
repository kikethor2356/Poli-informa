<?php
if (isset($_POST['enviar'])) {
    // Recopila los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Configura el correo electrónico
    $destinatario = 'enrique.alejandro2356@gmail.com'; // Cambia esto al correo electrónico al que deseas enviar el mensaje
    $asunto = 'Mensaje de contacto de Poli-Informa de'.$nombre;
    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo electrónico: $email\n\n";
    $contenido .= "Mensaje:\n$mensaje";

    // Envía el correo electrónico
    mail($destinatario, $asunto, $contenido);

    // Redirige al usuario de vuelta al formulario con un mensaje de éxito
    header('Location: ContactanosVista.php?enviado=true');
} else {
    // Si alguien intenta acceder directamente a este script, redirige al formulario
    header('Location: ContactanosVista.php');
    echo "No se puedo mandar el correo";
}
?>
