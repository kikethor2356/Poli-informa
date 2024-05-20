<?php
    include '../LoginA/inicio.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
        
    require '../../../PHPMailer/Exception.php';
    require '../../../PHPMailer/PHPMailer.php';
    require '../../../PHPMailer/SMTP.php';
    
    session_start();
    include('../../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();

    $token = bin2hex(random_bytes(16)); // Genera un token aleatorio de 32 caracteres hexadecimales

    // Después de abrir la conexión con la base de datos
    mysqli_set_charset($conexion, "utf8");
    
    $email = $_POST['AdCorreo'];

    $sql = "SELECT * FROM registro WHERE AdCorreo = '$email'";
    $result = $conexion->query($sql);
        
    // Verificar si se recuperaron filas        
    if ($result && $result->num_rows > 0) {
        // Almacena el token en la base de datos junto con la información del usuario
        $row = $result->fetch_assoc();
        $id = $row['id'];
        $token_expiration = date('Y-m-d H:i:s', strtotime('+1 hour')); // Ejemplo: el token expira en 1 hora
        $sql_update_token = "UPDATE registro SET recovery_token = '$token', token_expiration = '$token_expiration' WHERE id = $id";
        $conexion->query($sql_update_token);
        
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'poliinforma1@gmail.com';                     //SMTP username
            $mail->Password   = 'slhfpbzycafzxfhs';                               //SMTP password
            $mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587; 

            // Agregar opciones para desactivar la verificación del certificado SSL
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
                        
            // Set the charset
            $mail->CharSet = 'UTF-8';                                   //Lenguaje

            //Recipients
            $mail->setFrom('poliinforma1@gmail.com', 'POLI-INFORMA');
            $mail->addAddress($email);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Recuperarción de contraseña';
            $mail->Body = 'El motivo de este correo es para confirmar el cambio de contraseña del portal POLI-INFORMA.<br>
            Para continuar, haz clic en el siguiente enlace y el token se guardará automáticamente en tu navegador: 
            <a href="localhost/https/Poli-informa/Poli-Informa-1.1/Administrador/LoginA/guardar_token.php?token='.$token.'">Haz clic aquí para cambiar tu contraseña</a>
            <br>De no ser el caso, ignora este correo o verifica si tramitó el cambio de contraseña.';
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            // echo 'El mensaje se envio correctamente';
            header("Location: ../index.php?message=ok");
        } catch (Exception $e) {
            echo "Hubo un error a enviar el mensaje: ", $mail->ErrorInfo;
        }
            // header("Location: ../index.php?message=not_found");
    } else {
        // Si el correo electrónico no está registrado, redirecciona a olvido.php con un mensaje de error
        header("Location: ../olvido.php?message=correo");
    }
?>