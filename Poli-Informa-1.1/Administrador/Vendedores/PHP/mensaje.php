<?php
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

    // Después de abrir la conexión con la base de datos
    mysqli_set_charset($conexion, "utf8");
    
    $email = $_POST['AluCorreo'];

    $sql = "SELECT * FROM registroalu WHERE AluCorreo = '$email'";
    $result = $conexion->query($sql);
        
    // Verificar si se recuperaron filas        
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
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
            $mail->Body    = 'El motivo de este correo es para confirmar que fue aceptado como vendedor y ya puede publicar sus productos<br>
            "<a href="localhost/Proyecto/Poli-informa/Poli-Informa-1.1/Cliente/LoginU/index.php">Iniciar sesión</a>" nuevamente y publique sus productos en el apartado "Perfil"
            <br>De no ser el caso, ignora este correo o verifica si tramitó el cambio de contraseña.';    
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            // echo 'El mensaje se envio correctamente';
            header("Location: ../index.php?message=ok");
        } catch (Exception $e) {
            echo "Hubo un error a enviar el mensaje: ", $mail->ErrorInfo;
        }
    } else{
        header("Location: ../index.php?message=not_found");
    }//FIN IF-ELSE
?>