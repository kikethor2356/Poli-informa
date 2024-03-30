<?php
require_once 'Maestro.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre_maestro'];
    $apellidos = $_POST['apellidos_maestro'];
    $correo = $_POST['correo_maestro'];
    $codigo = $_POST['codigo_maestro'];
    $nombre_imagen = $_FILES['imagen_croquis']['name'];
    $ubicacion_temporal_imagen = $_FILES['imagen_croquis']['tmp_name'];
    // Directorio de destino para la imagen
    $directorio_destino = "ImgCroquis/";

    // Mover la imagen al directorio de destino
    $ruta_destino = $directorio_destino . $nombre_imagen;
    if (move_uploaded_file($ubicacion_temporal_imagen, $ruta_destino)) {
        echo "Imagen subida correctamente.";
    } else {
        echo "Error al subir la imagen.";
    }

    // Crear una instancia de la clase Maestro y llamar al método crearMaestro
    $maestro = new Maestro();
    $maestro->crearMaestro($nombre, $apellidos, $correo, $codigo, $imagen);
}

header('Location:ControllerShowTable.php');
?>
