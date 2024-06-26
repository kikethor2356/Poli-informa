<?php
    include("../../../Conexion/conexion.php");
    $db = new Database();
    $conexion = $db->connect();
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require '../../../PHPMailer/Exception.php';
    require '../../../PHPMailer/PHPMailer.php';
    require '../../../PHPMailer/SMTP.php';

    // Después de abrir la conexión con la base de datos
    mysqli_set_charset($conexion, "utf8");

    $metodoAccion = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);


// Apartado de productos
if($metodoAccion == 1){
    if(isset($_POST['enviar'])){
        $nombre = $_POST['nombre'];
        $codigoVendedor = $_POST['codigoVendedor'];
        $precio = $_POST['precio'];
        $descripcion = $_POST['descripcion'];
        $categoria = $_POST['categoria'];
        $archivo = $_FILES['imagen']['name'];
        $temporal = $_FILES['imagen']['tmp_name'];
        $carpeta = 'imagenes';

        if (!empty($archivo) && !empty($temporal)) {
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            $ruta = $carpeta . "/" . $archivo;
            if (!move_uploaded_file($temporal, $ruta)) {
                echo "Ocurrió un error al enviar la imagen";
                exit(); // Salir del script si hay un error
            }
        }
        $stmt = $conexion->prepare("INSERT INTO PRODUCTOS (nombre, codigoVendedor, precio, descripcion, nombreImagen, categoria) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $nombre, $codigoVendedor, $precio, $descripcion, $archivo, $categoria);
        if ($stmt->execute()) {
            $_SESSION['success'] = true;
            header("Location: ../vendedores.php");
            exit(); // Salir del script después de la redirección
        } else {
            $_SESSION['error'] = true;
            header("Location: ../vendedores.php");
            exit(); // Salir del script después de la redirección
        }
        $stmt->close();    
        exit();
    }

}//FIN MÉTODOACCIÓN 1

// Editar productos
if($metodoAccion == 2){
    $idProducto = (int) filter_var($_POST['idEditarProducto'], FILTER_SANITIZE_NUMBER_INT);
    $nombreProducto = filter_var($_POST['nombreEditarProducto'], FILTER_SANITIZE_STRING);
    $codigoVendedor = filter_var($_POST['vendedorEditarProducto'], FILTER_SANITIZE_STRING);
    $precioProducto = filter_var($_POST['precioEditarProducto'], FILTER_VALIDATE_FLOAT);
    $descripcionProducto = filter_var($_POST['descripcionEditarProducto'], FILTER_SANITIZE_STRING);
    $nombreImagenProducto = filter_var($_POST['rutaArchivoEditarProducto'], FILTER_SANITIZE_STRING);
    $categoriaProducto = filter_var($_POST['comboBoxCategoriaEditarProducto'], FILTER_SANITIZE_STRING);

    $updateProducto = ("UPDATE productos 
    set nombre='$nombreProducto',
    codigoVendedor='$codigoVendedor',
    precio='$precioProducto',
    descripcion='$descripcionProducto',
    nombreImagen='$nombreImagenProducto',
    categoria='$categoriaProducto'
    WHERE id='$idProducto' ");

    $resultadoUpdate = mysqli_query($conexion, $updateProducto);

    if(!empty($_FILES['archivoEditarProducto']['name'])){
        $nombreFoto = $_FILES['archivoEditarProducto']['name'];
        $temporal = $_FILES['archivoEditarProducto']['tmp_name'];
        $carpeta = 'imagenes';
        $miCarpeta = opendir($carpeta);
        $urlFoto = $carpeta. '/' .$nombreFoto;
        if(move_uploaded_file($temporal, $urlFoto)){
            $updateFoto = ("UPDATE productos set nombreImagen='$nombreFoto' WHERE id='$idProducto' ");
            $resultUpdate = mysqli_query($conexion, $updateFoto);
        }
    }

    if ($resultadoUpdate) {
        $_SESSION['success1'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error1'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    }
}//FIN METODOACCIÓN 2

//ELIMINAR PRODUCTO
if($metodoAccion == 3){
    $idProducto = (int) filter_var($_REQUEST['idEliminarProducto'], FILTER_SANITIZE_NUMBER_INT);
    $nombreFoto = filter_var($_REQUEST['archivoEliminarProducto'], FILTER_SANITIZE_STRING);
    $SqlDeleteAlumno = ("DELETE FROM productos WHERE id='$idProducto'");
    $resultDeleteAlumno = mysqli_query($conexion, $SqlDeleteAlumno);
    $fotoProducto = "imagenes/".$nombreFoto;
    if(file_exists($fotoProducto)){
        if($resultDeleteAlumno != 0){
            unlink($fotoProducto);
        }
    }
    if ($resultDeleteAlumno) {
        $_SESSION['success2'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error2'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    } 
}//FIN MÉTODOACCIÓN3




// Apartado de vendedores
// AGREGA AL VENDEDOR
if($metodoAccion == 4){
    if(isset($_POST['enviarVendedor'])){    
        $nombre = $_POST['nombreVendedor'];
        $correo = $_POST['correoVendedor'];
        $descripcion = $_POST['descripcionVendedor'];
        $codigo = $_POST['codigoVendedor'];
        $telefono = $_POST['telefonoVendedor'];
        $inicio = $_POST['horarioVendedorInicio'];
        $fin = $_POST['horarioVendedorFin'];
        $archivo = $_FILES['fotoVendedor']['name'];
        $temporal = $_FILES['fotoVendedor']['tmp_name'];
        $carpeta = 'imagenes';

        if(!empty($archivo) && !empty($temporal)){
            if(!file_exists($carpeta)){
                mkdir($carpeta, 0777, true);
            }
            $ruta = $carpeta. "/" .$archivo;
            if(!move_uploaded_file($temporal, $ruta)){
                echo "Ocurrió un error al mandar la foto del vendedor";
            }
        }
        
        $stmt = $conexion->prepare("INSERT INTO VENDEDORES (codigoVendedor, nombre, descripcion, correo, telefono, horaInicio, horaFin, foto) VALUES (?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssss", $codigo, $nombre, $descripcion, $correo, $telefono, $inicio, $fin, $archivo);
        $stmt->execute();
        
        if ($stmt->execute()) {
            $_SESSION['success3'] = true;
            header("Location: ../productos.php");
            exit(); // Salir del script después de la redirección
        } else {
            $_SESSION['error3'] = true;
            header("Location: ../productos.php");
            exit(); // Salir del script después de la redirección
        }
        $stmt->close();
        exit();
    }
}//FIN MÉTODOACCIÓN 4

//ACTUALIZA LOS DATOS DEL VENDEDOR
if($metodoAccion == 5){
    $idVendedor = (int) filter_var($_POST['IdEditarVendedor'], FILTER_SANITIZE_NUMBER_INT);
    $codigoVendedor = (int) filter_var($_POST['codigoEditarVendedor'], FILTER_SANITIZE_NUMBER_INT);
    $nombreVendedor = filter_var($_POST['nombreEditarVendedor'], FILTER_SANITIZE_STRING);
    $descripcionVendedor = filter_var($_POST['descripcionEditarVendedor'], FILTER_SANITIZE_STRING);
    $correoVendedor = filter_var($_POST['correoEditarVendedor'], FILTER_SANITIZE_STRING);
    $telefonoVendedor = filter_var($_POST['telefonoEditarVendedor'], FILTER_SANITIZE_STRING);
    $horaInicioVendedor = filter_var($_POST['horaInicioEditarVendedor'], FILTER_SANITIZE_STRING);
    $horaFinVendedor = filter_var($_POST['horaFinEditarVendedor'], FILTER_SANITIZE_STRING);
    $fotoVendedor = filter_var($_POST['fotoEditarVendedor'], FILTER_SANITIZE_STRING);

    $updateVendedor = ("UPDATE vendedores set 
    codigoVendedor='$codigoVendedor',
    nombre='$nombreVendedor',
    descripcion='$descripcionVendedor',
    correo='$correoVendedor',
    telefono='$telefonoVendedor',
    horaInicio='$horaInicioVendedor',
    horaFin='$horaFinVendedor',
    foto='$fotoVendedor'
    WHERE id='$idVendedor' ");

    $resultadoUpdateVendedor = mysqli_query($conexion, $updateVendedor);

    if(!empty($_FILES['archivoVendedor']['name'])){
        $nombreFotoVendedor = $_FILES['archivoVendedor']['name'];
        $temporalVendedor = $_FILES['archivoVendedor']['tmp_name'];
        $carpeta = 'imagenes';
        $miCarpeta = opendir($carpeta);
        $urlFotoVendedor = $carpeta. "/" .$nombreFotoVendedor;

        if(move_uploaded_file($temporalVendedor, $urlFotoVendedor)){
            $updateFotoVendedor = ("UPDATE vendedores set foto='$fotoVendedor' WHERE id='$idVendedor' ");
            $resultadoUpdateVendedor = mysqli_query($conexion, $updateFotoVendedor);                       
        }
    }

    if ($resultadoUpdateVendedor) {
        $_SESSION['success4'] = true;
        header("Location: ../vendedores.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error4'] = true;
        header("Location: ../vendedores.php");
        exit(); // Salir del script después de la redirección
    } 
}//FIN MÉTODOACCIÓN 5


// ELIMINA A LOS VENDEDORES
if($metodoAccion == 6){
    $idVendedor = (int) filter_var($_REQUEST['idEliminarVendedor'], FILTER_SANITIZE_NUMBER_INT);
    $nombreFoto = filter_var($_REQUEST['fotoEliminarVendedor'], FILTER_SANITIZE_STRING);

    // Obtener el correo electrónico del vendedor eliminado
    $stmtCorreoVendedor = $conexion->prepare("SELECT correo FROM VENDEDORES WHERE id = ?");
    $stmtCorreoVendedor->bind_param("i", $idVendedor);
    $stmtCorreoVendedor->execute();
    $stmtCorreoVendedor->bind_result($emailVendedor);
    $stmtCorreoVendedor->fetch();
    $stmtCorreoVendedor->close();
        
    // Obtener el código del vendedor eliminado
    $stmtCodigoVendedor = $conexion->prepare("SELECT codigoVendedor FROM VENDEDORES WHERE id = ?");
    $stmtCodigoVendedor->bind_param("i", $idVendedor);
    $stmtCodigoVendedor->execute();
    $stmtCodigoVendedor->bind_result($codigoVendedorEliminado);
    $stmtCodigoVendedor->fetch();
    $stmtCodigoVendedor->close();
    
    $stmtCodigo = $conexion->prepare("SELECT codigoVendedor FROM vendedores WHERE id = ?");
    $stmtCodigo->bind_param("s", $idVendedor);
    $stmtCodigo->execute();
    $resultCodigo = $stmtCodigo->get_result();
    $mostrar = $resultCodigo->fetch_assoc();


    // Elimina los productos en la tabla de productos oficiales relacionados al vendedor
    $stmtDeleteProductos = $conexion->prepare("DELETE FROM productos WHERE codigoVendedor = ?");
    $stmtDeleteProductos->bind_param("i", $mostrar['codigoVendedor']);
    $resultDeleteProductos = $stmtDeleteProductos->execute();
    $stmtDeleteProductos->close();

    // Eliminar al vendedor
    $stmtDeleteVendedor = $conexion->prepare("DELETE FROM VENDEDORES WHERE id = ?");
    $stmtDeleteVendedor->bind_param("i", $idVendedor);
    $resultDeleteVendedor = $stmtDeleteVendedor->execute();
    $stmtDeleteVendedor->close();


    // Si la eliminación fue exitosa, actualizar el estado en la tabla registroalu
    if ($resultDeleteVendedor) {
        $updateEstado = $conexion->prepare("UPDATE registroalu SET esVendedor = 0 WHERE CodeAlu = ?");
        $updateEstado->bind_param("s", $codigoVendedorEliminado);
        $resultUpdateEstado = $updateEstado->execute();
        $updateEstado->close();

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
            $mail->CharSet = 'UTF-8'; //Lenguaje

            //Recipients
            $mail->setFrom('poliinforma1@gmail.com', 'POLI-INFORMA');
            $mail->addAddress($emailVendedor);     //Add a recipient

            //Content
            $mail->isHTML(true);     //Set email format to HTML
            $mail->Subject = 'Eliminación como vendedor';
            $mail->Body = 'Lamentamos informarte que has sido eliminado como vendedor en nuestro portal POLI-INFORMA.';
            
            $mail->send();
            // echo 'El mensaje se envio correctamente';
            $_SESSION['success5'] = true;
        } catch (Exception $e) {
            echo "Hubo un error a enviar el mensaje: ", $mail->ErrorInfo;
            $_SESSION['error5'] = true;
        }
    } else {
        $_SESSION['error5'] = true;
    }

    header("Location: ../vendedores.php");
    exit();
}//FIN MÉTODOACCIÓN 6


// Apartado de vendedores pendientes

//ELIMINA AL VENDEDOR PENDIENTE
if($metodoAccion == 7){
    $idVendedor = (int) filter_var($_REQUEST['idEliminarVendedorPendiente'], FILTER_SANITIZE_NUMBER_INT);
    $nombreFoto = filter_var($_REQUEST['fotoEliminarVendedorPendiente'], FILTER_SANITIZE_STRING);

    $sqlDeleteVendedor = ("DELETE FROM VENDEDORES_PENDIENTES WHERE id = '$idVendedor' ");
    $resultDeleteVendedorPendiente = mysqli_query($conexion, $sqlDeleteVendedor);

    $fotoVendedor = "imagenes/".$nombreFoto;
    if(file_exists($fotoVendedor)){

        if($resultDeleteVendedorPendiente != 0){
            unlink($fotoVendedor);
        }
    }
    header("Location: ../Vendedores_pendientes.php");
    if ($resultDeleteVendedorPendiente) {
        $_SESSION['success7'] = true;
        header("Location: ../Vendedores_pendientes.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error7'] = true;
        header("Location: ../Vendedores_pendientes.php");
        exit(); // Salir del script después de la redirección
    } 
}

// AGREGA AL VENDEDOR PENDIENTE A LA TABLA DE VENDEDORES
if($metodoAccion == 8){
    
    if(isset($_POST['idAceptarVendedorPendiente'])) {
        $idVendedor = $_POST['idAceptarVendedorPendiente'];

        // Obtener información del vendedor
        $stmtGetVendedorInfo = $conexion->prepare("SELECT * FROM VENDEDORES_PENDIENTES WHERE id = ?");
        $stmtGetVendedorInfo->bind_param("i", $idVendedor);
        $stmtGetVendedorInfo->execute();
        $resultVendedor = $stmtGetVendedorInfo->get_result();
        $vendedorData = $resultVendedor->fetch_assoc();
        $stmtGetVendedorInfo->close();

        $email = $vendedorData['correo'];

        // Copiar datos del vendedor pendiente a la tabla de vendedores
        $stmt = $conexion->prepare("INSERT INTO VENDEDORES (codigoVendedor, nombre, descripcion, correo, telefono, horaInicio, horaFin, foto) SELECT codigoVendedor, nombre, descripcion, correo, telefono, horaInicio, horaFin, foto FROM VENDEDORES_PENDIENTES WHERE id = ?");
        $stmt->bind_param("i", $idVendedor);
        $resultInsertVendedor = $stmt->execute();
        $stmt->close();

        // Actualizar el estado del vendedor pendiente a 1 en la tabla de registro de alumnos
        $updateEstado = $conexion->prepare("UPDATE registroalu SET esVendedor = 1 WHERE CodeAlu = ?");
        $updateEstado->bind_param("s", $vendedorData['codigoVendedor']);
        $resultUpdateEstado = $updateEstado->execute();
        $updateEstado->close();

        if ($resultInsertVendedor) {
                // Eliminar al vendedor pendiente de la tabla de vendedores pendientes
                $stmtDeleteVendedor = $conexion->prepare("DELETE FROM VENDEDORES_PENDIENTES WHERE id = ?");
                $stmtDeleteVendedor->bind_param("i", $idVendedor);
                $resultDeleteVendedor = $stmtDeleteVendedor->execute();
                $stmtDeleteVendedor->close();

            if ($resultUpdateEstado) {
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

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Aceptación como vendedor';
                    $mail->Body = '¡Felicidades! Has sido aceptado como vendedor en nuestro portal POLI-INFORMA. Ahora puedes comenzar a vender tus productos.';
                    
                    $mail->send();
                    // echo 'El mensaje se envio correctamente';
                    $_SESSION['success8'] = true;
                } catch (Exception $e) {
                    echo "Hubo un error a enviar el mensaje: ", $mail->ErrorInfo;
                    $_SESSION['error8'] = true;
                }
            } else {
                $_SESSION['error8'] = true;
            }
        } else {
            $_SESSION['error8'] = true;
        }

        header("Location: ../Vendedores_pendientes.php");
        exit();
    } else {
        $_SESSION['error8'] = true;
        header("Location: ../Vendedores_pendientes.php");
        exit();
    }
}//FIN MÉTODOACCIÓN 8


if($metodoAccion == 9){
    $idProducto = (int) filter_var($_REQUEST['idEliminarProductoPendiente'], FILTER_SANITIZE_NUMBER_INT);
    $nombreFoto = filter_var($_REQUEST['archivoEliminarProductoPendiente'], FILTER_SANITIZE_STRING);

    $sqlDeleteVendedor = ("DELETE FROM PRODUCTOS_PENDIENTES WHERE ID = '$idProducto' ");
    $resultDeleteVendedorPendiente = mysqli_query($conexion, $sqlDeleteVendedor);

    $fotoVendedor = "imagenes/".$nombreFoto;
    if(file_exists($fotoVendedor)){

        if($resultDeleteVendedorPendiente != 0){
            unlink($fotoVendedor);
        }
    }
    header("Location: ../Productos_pendiente.php");
    if ($resultDeleteVendedorPendiente) {
        $_SESSION['success9'] = true;
        header("Location: ../Productos_pendiente.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error9'] = true;
        header("Location: ../Productos_pendiente.php");
        exit(); // Salir del script después de la redirección
    } 
}

if ($metodoAccion == 10) {

    $idProducto = (int) filter_var($_REQUEST['idAceptarProductoPendiente'], FILTER_SANITIZE_NUMBER_INT);

    $stmt = $conexion->prepare("INSERT INTO PRODUCTOS (nombre, codigoVendedor, precio, descripcion, nombreImagen, categoria) SELECT nombre, codigoVendedor, precio, descripcion, nombreImagen, categoria FROM PRODUCTOS_PENDIENTES WHERE ID = ?");
    $stmt->bind_param("i", $idProducto);
    $resultado = $stmt->execute();
    $stmt->close();
    
    $stmtDeleteVendedor = $conexion->prepare("DELETE FROM PRODUCTOS_PENDIENTES WHERE ID = ?");
    $stmtDeleteVendedor->bind_param("i", $idProducto);
    $resultDeleteVendedor = $stmtDeleteVendedor->execute();
    $stmtDeleteVendedor->close();

    header("Location: ../Productos_pendiente.php");
    if ($resultado) {
        $_SESSION['success10'] = true;
        header("Location: ../Productos_pendiente.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error10'] = true;
        header("Location: ../Productos_pendiente.php");
        exit(); // Salir del script después de la redirección
    }
}
?>