
<?php
    include "ModelLaboratorios.php";
    
    $laboratorio = new Laboratorio();

   

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['Nombre'];
    // Crear una instancia de la clase Maestro
    

    $laboratorio->editarRegistro($id, $nombre);
    header('Location: ControllerCreate.php');

}else{
    $id = $_GET['id'];
    $laboratorio->mostrarFormularioEdicion($id);
    
}
?>

