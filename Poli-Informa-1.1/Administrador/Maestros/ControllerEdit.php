
<?php
    include "ModelMaestros.php";
    
    $maestro = new Maestro();

   

// Verificar si se ha enviado el formulario de edición
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $codigo = $_POST['Codigo'];
    $imagen = $_POST['Imagen']; // Obtener el nombre de la nueva imagen (si se está actualizando)
    
    // Crear una instancia de la clase Maestro
    

    $maestro->editarRegistro($id, $nombre, $apellidos, $correo, $codigo, $imagen);


}else{
    $id = $_GET['id'];
    $maestro->mostrarFormularioEdicion($id);
}
?>

