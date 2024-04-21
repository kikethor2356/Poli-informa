<?php

include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();
session_start();

if(isset($_POST["submit"])){
    if($_POST["submit"] == "Agregar"){
        add();
    }
    
    else if($_POST["submit"] == "Editar"){
        edit();
    }
    else if($_POST["submit"] == "borrar"){
        delete();
    }
}

function add(){
    global $conexion;
    
    $AdCode= $_POST ['AdCode'];
    $AdNombre= $_POST ['AdNombre'];
    $AdApellidoP= $_POST ['AdApellidoP'];
    $AdApellidoM= $_POST ['AdApellidoM'];
    $AdCarrera= $_POST ['AdCarrera'];
    $AdCorreo= $_POST ['AdCorreo'];
    $AdImagen = $_FILES['AdImagen']['name'];
    $AdPassword= $_POST ['AdPassword'];
    $AdPassword_encriptada = sha1($AdPassword);//captura la contraseña y la encripta
    $sqlcode = "SELECT  id FROM  registro
                        WHERE   AdCode = '$AdCode'";
    $resultadocode = $conexion->query($sqlcode);
    $filas = $resultadocode->num_rows;

    if ($filas > 0){
        echo "<script>
            alert('El usuario ya esta registrado');
        </script>";
    }else{
        $query = "INSERT INTO registro (AdCode, AdNombre, AdApellidoP, AdApellidoM, AdCarrera, AdCorreo, AdImagen, AdPassword) VALUES('$AdCode', '$AdNombre', '$AdApellidoP', '$AdApellidoM', '$AdCarrera', '$AdCorreo', '$AdImagen', '$AdPassword')";
        $resultado = mysqli_query($conexion, $query);
    }


    if ($resultado) {
        move_uploaded_file($_FILES["AdImagen"]["tmp_name"], "imagenes/".$_FILES["AdImagen"]["name"]);
        $_SESSION['success'] = true;
        header("location: AdControl.php");
    } else {
        $_SESSION['error'] = true;
        header("location: AdControl.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }

}


function edit(){
    global $conexion;

    $id = $_POST["idUsuario"];
    $AdCode= $_POST['AdCode'];
    $AdNombre= $_POST['AdNombre'];
    $AdApellidoP= $_POST['AdApellidoP'];
    $AdApellidoM= $_POST['AdApellidoM'];
    $AdCarrera= $_POST['AdCarrera'];
    $AdCorreo= $_POST['AdCorreo'];

    $new_imagen  = $_FILES['AdImagen']['name'];
    $old_imagen = $_POST['AdImagen_old'];

    $AdPassword= md5($_POST ['AdPassword']);

    if($new_imagen != ''){
        // Genera un nombre único para la nueva imagen
        $AdImagen = uniqid().'_'.$_FILES['AdImagen']['name'];
        // Mueve la nueva imagen a la carpeta temporal con el nombre único
        move_uploaded_file($_FILES["AdImagen"]["tmp_name"], "imagenes/".$AdImagen);

        if($old_imagen != ''){
            $check_sql = "SELECT COUNT(*) as count FROM registro WHERE AdImagen = '$old_imagen' AND id != '$id'";
            $check_result = mysqli_query($conexion, $check_sql);
            $row = mysqli_fetch_assoc($check_result);
            $imageInUse = $row['count'] > 0;
    
            // Si la imagen no está siendo utilizada por otro registro, elimínala
            if(!$imageInUse) {
                unlink("imagenes/".$old_imagen);
            }
        }
    } else {
        $AdImagen = $old_imagen;
    }

    // if($_FILES["file"]["error"] !=8){
    //     $filename = $_FILES["file"]["name"];
    //     $tmpName = $_FILES["file"]["tmp_name"];
    //     // Esto es esto sip, gracias

    //     $newfilename = uniqid() . "-" . $filename;

    //     move_uploaded_file($tmpName, 'imagenes/' . $newfilename);
    //     $query = "UPDATE registro SET AdImagen = '$newfilename' WHERE id = $id";
    //     mysqli_query($conexion, $query);

    // }

    $sql = "UPDATE registro SET AdCode = '$AdCode',  AdNombre = '$AdNombre', AdApellidoP = '$AdApellidoP', AdApellidoM = '$AdApellidoM', AdCarrera = '$AdCarrera', AdCorreo = '$AdCorreo', AdImagen = '$AdImagen', AdPassword = '$AdPassword' WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $_SESSION['success1'] = true;
        header("location: AdControl.php");
    } else {
        $_SESSION['error1'] = true;
        header("location: AdControl.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
        
}



function delete(){

    global $conexion;

    // $id = $_POST["idEliminar"];
    $id = $_POST['idEliminar'];
    $eliminar_imagen = $_POST['eliminar_imagen'];

    // Comprobar si la imagen todavía está en uso por otros registros
    $check_sql = "SELECT COUNT(*) as count FROM registro WHERE AdImagen = '$eliminar_imagen' AND id != '$id'";
    $check_result = mysqli_query($conexion, $check_sql);
    $row = mysqli_fetch_assoc($check_result);
    $imageInUse = $row['count'] > 0;

    $query = "DELETE FROM registro WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        if(!$imageInUse){
            unlink("imagenes/".$eliminar_imagen);
        }
        $_SESSION['success2'] = true;
        header("location: AdControl.php");
    } else {
        $_SESSION['error2'] = true;
        header("location: AdControl.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }

}

?>