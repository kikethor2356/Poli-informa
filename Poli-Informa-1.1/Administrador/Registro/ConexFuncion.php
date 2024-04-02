<?php
$conn = mysqli_connect("localhost", "root", "", "radministrador");

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
    global $conn;

    $AdCode= $_POST ['AdCode'];
    $AdNombre= $_POST ['AdNombre'];
    $AdApellidoP= $_POST ['AdApellidoP'];
    $AdApellidoM= $_POST ['AdApellidoM'];
    $AdCarrera= $_POST ['AdCarrera'];
    $AdCorreo= $_POST ['AdCorreo'];
    $AdPassword= $_POST ['AdPassword'];
    $filename = $_FILES["file"]["AdNombre"];
    $tmpName = $_FILES["file"]["tmp_name"];

    $newfilename = uniqid() . "-" . $filename;

    move_uploaded_file($tmpName, 'imagenes/' . $newfilename);
    $query = "INSERT INTO registro VALUES('', '$AdCode', '$AdNombre', '$AdApellidoP', '$AdApellidoM', '$AdCarrera', '$AdCorreo', '$newfilename', '$AdPassword')";
    mysqli_query($conn, $query);

    echo
    "
    <script> alert('Usuario agregado correctamente :)'); document.location.href = 'AdControlR.php'; </script>
    ";

}


function edit(){
    global $conn;

    $id = $_GET["id"];
    $AdCode= $_POST['AdCode'];
    $AdNombre= $_POST['AdNombre'];
    $AdApellidoP= $_POST['AdApellidoP'];
    $AdApellidoM= $_POST['AdApellidoM'];
    $AdCarrera= $_POST['AdCarrera'];
    $AdCorreo= $_POST['AdCorreo'];
    $AdPassword= $_POST['AdPassword'];

    if($_FILES["file"]["error"] !=8){
        $filename = $_FILES["file"]["name"];
        $tmpName = $_FILES["file"]["tmp_name"];

        $newfilename = uniqid() . "-" . $filename;

        move_uploaded_file($tmpName, 'imagenes/' . $newfilename);
        $query = "UPDATE registro SET AdImagen = '$newfilename' WHERE id = $id";
        mysqli_query($conn, $query);

    }

    $query = "UPDATE registro SET AdCode = '$AdCode',  AdNombre = '$AdNombre', AdApellidoP = '$AdApellidoP', AdApellidoM = '$AdApellidoM', AdCarrera = '$AdCarrera', AdCorreo = '$AdCorreo', AdPassword = '$AdPassword' WHERE id like $id";

    mysqli_query($conn, $query);
    echo
    "
    <script> alert('Usuario editado exitosamente ;)'); document.location.href = 'AdControlR.php'; </script>
    ";

}



function delete(){
    global $conn;

    $id = $_POST["submit"];

    $query = "DELETE FROM registro WHERE id = $id";
    mysqli_query($conn, $query);

    echo
    "
    <script>
    alert('Usuario eliminado exitosamente');
    </script>
    ";

}

?>