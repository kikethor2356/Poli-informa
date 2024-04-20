<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
        
    require '../../PHPMailer/Exception.php';
    require '../../PHPMailer/PHPMailer.php';
    require '../../PHPMailer/SMTP.php';
    
    session_start();
    include('../../Conexion/conexion.php');
    $db = new Database();
    $conexion = $db->connect();
    
    $email = $_POST['correo'];

    $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
    $result = $conexion->query($sql);
        
    // Verificar si se recuperaron filas        
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        
        try {
            //Server settings
            $mail->SMTPDebug =  0;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'poliinforma1@gmail.com';                     //SMTP username
            $mail->Password   = 'slhfpbzycafzxfhs';                               //SMTP password
            $mail->SMTPSecure = 'tls'; //PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
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
            $mail->Body    = 'El motivo de este correo es para confirmar el cambio de contraseña del portal POLI-IFORMA<br>
            del siguiente enlace, <a href="localhost/Proyecto/Poli-informa/Poli-Informa-1.1/Login/new_password.php?id='.$row['id'].'">Haz clic aquí para cambiar tu contraseña</a>
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