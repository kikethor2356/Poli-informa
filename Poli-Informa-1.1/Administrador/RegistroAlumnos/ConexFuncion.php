<?php
include('../../Conexion/conexion.php');
$db = new Database();
$conexion = $db->connect();

if(isset($_POST["submit"])){
    if($_POST["submit"] == "add"){
        add();
    }
    
    else if($_POST["submit"] == "edit"){
        edit();
    }
    else{
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
    $AluPassword= md5($_POST ['AluPassword']);
    $filename = $_FILES["file"]["AdNombre"];
    $tmpName = $_FILES["file"]["tmp_name"];

    $newfilename = uniqid() . "-" . $filename;

    move_uploaded_file($tmpName, 'imagenes/' . $newfilename);
    $query = "INSERT INTO registroalu VALUES('', '$CodeAlu', '$AluNom', '$AluApellidoP', '$AluApellidoM', '$AluCarrera', '$AluCorreo', '$newfilename', '$AluPassword')";
    
    mysqli_query($conexion, $query);

    echo
    "
    <script> alert('Usuario agregado correctamente :)'); document.location.href = 'AluControlR.php'; </script>
    ";

}

function edit(){
    global $conexion;

    $id = $_GET["id"];
    $CodeAlu= $_POST ['CodeAlu'];
    $AluNom= $_POST ['AluNom'];
    $AluApellidoP= $_POST ['AluApellidoP'];
    $AluApellidoM= $_POST ['AluApellidoM'];
    $AluCarrera= $_POST ['AluCarrera'];
    $AluCorreo= $_POST ['AluCorreo'];
    $AluPassword= md5($_POST ['AluPassword']);

    if($_FILES["file"]["error"] !=8){
        $filename = $_FILES["file"]["name"];
        $tmpName = $_FILES["file"]["tmp_name"];

        $newfilename = uniqid() . "-" . $filename;

        move_uploaded_file($tmpName, 'imagenes/' . $newfilename);
        $query = "UPDATE registroalu SET AluImage = '$newfilename' WHERE id = $id";
        mysqli_query($conexion, $query);

    }
    $query = "UPDATE registroalu SET CodeAlu = '$CodeAlu',  AluNom = '$AluNom', AluApellidoP = '$AluApellidoP', AluApellidoM = '$AluApellidoM', AluCarrera = '$AluCarrera', AluCorreo = '$AluCorreo', AluPassword = '$AluPassword' WHERE id like $id";

    mysqli_query($conexion, $query);
    echo
    "
    <script> alert('Usuario editado exitosamente ;)'); document.location.href = 'AluControlR.php'; </script>
    ";

}

function delete(){
    global $conexion;

    $id = $_POST["submit"];

    $query = "DELETE FROM registroalu WHERE id = $id";
    mysqli_query($conexion, $query);

    echo
    "
    <script>
    alert('Usuario eliminado exitosamente');
    </script>
    ";

}

?>