<?php 
    include("../../../Conexion/conexion.php");
    $db = new Database();
    $conexion = $db->connect();
    session_start();

    $metodoAccion = (int) filter_var($_REQUEST['metodo'], FILTER_SANITIZE_NUMBER_INT);


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
        header("Location: ../vendedores.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error1'] = true;
        header("Location: ../vendedores.php");
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
        header("Location: ../vendedores.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error2'] = true;
        header("Location: ../vendedores.php");
        exit(); // Salir del script después de la redirección
    } 
}//FIN MÉTODOACCIÓN3


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
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error4'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    } 

}//FIN MÉTODOACCIÓN 5



// ELIMINA A LOS VENDEDORES
if($metodoAccion == 6){

    $idVendedor = (int) filter_var($_REQUEST['idEliminarVendedor'], FILTER_SANITIZE_NUMBER_INT);
    $nombreFoto = filter_var($_REQUEST['fotoEliminarVendedor'], FILTER_SANITIZE_STRING);

    $sqlDeleteVendedor = ("DELETE FROM VENDEDORES WHERE id = '$idVendedor' ");
    $resultDeleteVendedor = mysqli_query($conexion, $sqlDeleteVendedor);

    $fotoVendedor = "imagenes/".$nombreFoto;

    if(file_exists($fotoVendedor)){

        if($resultDeleteVendedor != 0){
            unlink($fotoVendedor);
        }
    }

    if ($resultDeleteVendedor) {
        $_SESSION['success5'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    } else {
        $_SESSION['error5'] = true;
        header("Location: ../productos.php");
        exit(); // Salir del script después de la redirección
    }     
}//FIN MÉTODOACCIÓN 6

?>
