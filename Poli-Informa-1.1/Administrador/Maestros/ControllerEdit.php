<?php
include "Maestro.php";

$maestro = new Maestro();

// Verificar si se ha enviado el formulario de edición
if (isset($_POST['Editar'])) {
    // Obtener los datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['Nombre'];
    $apellidos = $_POST['Apellidos'];
    $correo = $_POST['Correo'];
    $codigo = $_POST['Codigo'];
    $new_imagen = $_FILES['imagen']['name']; // Nombre del nuevo archivo de imagen

    // Verificar si se ha enviado un archivo de imagen
    if (!empty($new_imagen)) {
        // Ruta donde se almacenarán las imágenes en el servidor
        $directorio_subida = 'ImgCroquis/';
        $ruta_archivo = $directorio_subida . $new_imagen;

        // Mover el archivo al directorio de destino
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_archivo)) {
            // Editar el registro en la base de datos con la nueva imagen
            $conn = $maestro->connect(); // Asumiendo que connect() es un método de la clase Maestro que devuelve la conexión a la base de datos

            // Consulta SQL para actualizar el registro en la base de datos
            $sql = "UPDATE maestros SET Nombre=?, Apellidos=?, Correo=?, Codigo=?, Imagen_croquis= ? WHERE id=?";
            $stmt = $conn->prepare($sql);

            // La cadena de definición de tipo debe incluir también el tipo de dato para el parámetro de ID
            $stmt->bind_param('sssssi', $nombre, $apellidos, $correo, $codigo, $new_imagen, $id);

            if ($stmt->execute()) {
                echo "Registro actualizado correctamente " . $new_imagen;
                header("Location: ../Maestros/ControllerShowTable.php");
            } else {
                echo "Error al actualizar el registro: " . $conn->error;
            }
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        // Editar el registro en la base de datos sin actualizar la imagen
        $conn = $maestro->connect(); // Asumiendo que connect() es un método de la clase Maestro que devuelve la conexión a la base de datos

        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE maestros SET Nombre=?, Apellidos=?, Correo=?, Codigo=? WHERE id=?";
        $stmt = $conn->prepare($sql);

        // La cadena de definición de tipo debe incluir también el tipo de dato para el parámetro de ID
        $stmt->bind_param('ssssi', $nombre, $apellidos, $correo, $codigo, $id);

        if ($stmt->execute()) {
            echo "Registro actualizado correctamente";
            header("Location: ../Maestros/ControllerShowTable.php");

        } else {
            echo "Error al actualizar el registro: " . $conn->error;
        }
    }

    // Redireccionar a la página de controlador de creación
    /* header('Location: ControllerCreate.php'); */
    exit;
}
?>
