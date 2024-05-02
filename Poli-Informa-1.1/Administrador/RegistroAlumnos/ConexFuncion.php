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
    
    $CodeAlu= $_POST ['CodeAlu'];
    $AluNom= $_POST ['AluNom'];
    $AluApellidoP= $_POST ['AluApellidoP'];
    $AluApellidoM= $_POST ['AluApellidoM'];
    $AluCarrera= $_POST ['AluCarrera'];
    $AluCorreo= $_POST ['AluCorreo'];
    $AluImage = $_FILES['AluImage']['name'];
    $AluPassword= $_POST ['AluPassword'];
    $sqlcode = "SELECT  id FROM  registroalu
                        WHERE   CodeAlu = '$CodeAlu'";
    $resultadocode = $conexion->query($sqlcode);
    $filas = $resultadocode->num_rows;

    if ($filas > 0){
        echo "<script>
            alert('El usuario ya esta registrado');
        </script>";
    }else{
        $query = "INSERT INTO registroalu (CodeAlu, AluNom, AluApellidoP, AluApellidoM, AluCarrera , AluCorreo, AluImage, AluPassword) VALUES('$CodeAlu', '$AluNom', '$AluApellidoP', '$AluApellidoM', '$AluCarrera', '$AluCorreo', '$AluImage', '$AluPassword')";
        $resultado = mysqli_query($conexion, $query);
    }


    if ($resultado) {
        move_uploaded_file($_FILES["AluImage"]["tmp_name"], "imagenes1/".$_FILES["AluImage"]["name"]);
        $_SESSION['success'] = true;
        header("location: AluControl.php");
    } else {
        $_SESSION['error'] = true;
        header("location: AluControl.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }

}


function edit(){
    global $conexion;

    $id = $_POST["idUsuario"];
    $CodeAlu= $_POST['CodeAlu'];
    $AluNom= $_POST['AluNom'];
    $AluApellidoP= $_POST['AluApellidoP'];
    $AluApellidoM= $_POST['AluApellidoM'];
    $AluCarrera= $_POST['AluCarrera'];
    $AluCorreo= $_POST['AluCorreo'];

    $new_imagen  = $_FILES['AluImage']['name'];
    $old_imagen = $_POST['AluImagen_old'];

    $AluPassword= $_POST ['AluPassword'];

    if($new_imagen != ''){
        // Genera un nombre único para la nueva imagen
        $AluImage = uniqid().'_'.$_FILES['AluImage']['name'];
        // Mueve la nueva imagen a la carpeta temporal con el nombre único
        move_uploaded_file($_FILES["AluImage"]["tmp_name"], "imagenes1/".$AluImage);

        if($old_imagen != ''){
            $check_sql = "SELECT COUNT(*) as count FROM registroalu WHERE AluImage = '$old_imagen' AND id != '$id'";
            $check_result = mysqli_query($conexion, $check_sql);
            $row = mysqli_fetch_assoc($check_result);
            $imageInUse = $row['count'] > 0;
    
            // Si la imagen no está siendo utilizada por otro registro, elimínala
            if(!$imageInUse) {
                unlink("imagenes1/".$old_imagen);
            }
        }
    } else {
        $AluImage = $old_imagen;
    }

    // if($_FILES["file"]["error"] !=8){
    //     $filename = $_FILES["file"]["name"];
    //     $tmpName = $_FILES["file"]["tmp_name"];
    //     // Esto es esto sip, gracias

    //     $newfilename = uniqid() . "-" . $filename;

    //     move_uploaded_file($tmpName, 'imagenes1/' . $newfilename);
    //     $query = "UPDATE registro SET AluImage = '$newfilename' WHERE id = $id";
    //     mysqli_query($conexion, $query);

    // }

    $sql = "UPDATE registroalu SET CodeAlu = '$CodeAlu',  AluNom = '$AluNom', AluApellidoP = '$AluApellidoP', AluApellidoM = '$AluApellidoM', AluCarrera  = '$AluCarrera ', AluCorreo = '$AluCorreo', AluImage = '$AluImage', AluPassword = '$AluPassword' WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $_SESSION['success1'] = true;
        header("location: AluControl.php");
    } else {
        $_SESSION['error1'] = true;
        header("location: AluControl.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }
        
}


function delete(){

    global $conexion;

    // $id = $_POST["idEliminar"];
    $id = $_POST['idEliminar'];
    $eliminar_imagen = $_POST['eliminar_imagen'];

    // Comprobar si la imagen todavía está en uso por otros registros
    $check_sql = "SELECT COUNT(*) as count FROM registroalu WHERE AluImage = '$eliminar_imagen' AND id != '$id'";
    $check_result = mysqli_query($conexion, $check_sql);
    $row = mysqli_fetch_assoc($check_result);
    $imageInUse = $row['count'] > 0;

    $query = "DELETE FROM registroalu WHERE id = $id";
    $resultado = mysqli_query($conexion, $query);

    if ($resultado) {
        if(!$imageInUse){
            unlink("imagenes1/".$eliminar_imagen);
        }
        $_SESSION['success2'] = true;
        header("location: AluControl.php");
    } else {
        $_SESSION['error2'] = true;
        header("location: AluControl.php");
        die("Datos NO eliminados: " . mysqli_error($conexion));
    }

}

?>