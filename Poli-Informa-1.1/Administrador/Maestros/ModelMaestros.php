<?php
require_once '../../Conexion/conexion.php'; // Asegúrate de incluir tu clase Database aquí

class Maestro extends Database {
    public function crearMaestro($nombre, $apellidos, $correo, $codigo, $imagen) {
        $conn = $this->connect();

        // Directorio de destino para la imagen
        $directorio_destino = "ImgCroquis/";

        // Obtener el nombre del archivo y la ubicación temporal
        $nombre_archivo = $_FILES["imagen_croquis"]["name"];
        $ubicacion_temporal = $_FILES["imagen_croquis"]["tmp_name"];

        // Mover el archivo al directorio de destino
        $ruta_destino = $directorio_destino . $nombre_archivo;
        if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
            echo "Imagen subida correctamente.";
        } else {
            echo "Error al subir la imagen.";
        }

        // Preparar la consulta con marcadores de posición
        $sql = "INSERT INTO maestros (Nombre, Apellidos, Correo, Codigo, Imagen_croquis)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("sssss", $nombre, $apellidos, $correo, $codigo, $nombre_archivo);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro creado correctamente.";
        } else {
            echo "Error al crear el registro: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }

   
    public function PerfilMaestros($id) {
        $conn = $this->connect();
    
        // Preparar la consulta SQL para seleccionar un maestro basado en su ID
        $sql = "SELECT * FROM maestros WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            // Obtener el perfil del maestro
            $row = $result->fetch_assoc();
            echo "Nombre: " . $row["Nombre"]. " - Apellidos: " . $row["Apellidos"]. " - Código: " . $row["Codigo"]. " - Correo: " . $row["Correo"]. "<br>";
            echo '<img src="ImgCroquis/' . $row["Imagen_croquis"] . '" alt="Imagen de Maestro">';
        } else {
            echo "No se encontró ningún maestro con el ID proporcionado.";
        }
    
        $stmt->close();
    }



    //Esta funcion te regresa una tabla de maestros
    public function MostrarMaestrosTabla() {
        $conn = $this->connect();

        $sql = "SELECT * FROM maestros";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            echo '<center><h1>Tabla de maestros</h1></center>';
            echo '<table style="border-collapse: collapse; width: 100%;">';
            echo '<tr>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Nombre</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Apellidos</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Código</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Correo</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Imagen</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Editar</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Eliminar</th>';

            echo '</tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="ControllerShow.php?id=' . $row["id"] . '">' . $row["Nombre"] . '</a></td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $row["Apellidos"] . '</td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $row["Codigo"] . '</td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $row["Correo"] . '</td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><img src="ImgCroquis/' . $row["Imagen_croquis"] . '" alt="Imagen de Maestro" style="max-width: 100px;"></td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="ControllerEdit.php?id=' . $row["id"] . '">Editar</a></td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="ControllerDelete.php?id=' . $row["id"] . '">Eliminar</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "0 resultados";
        }
    }


    
    function editarRegistro($id, $nombre, $apellidos, $correo, $codigo, $imagen)
    {
        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE maestros SET Nombre=?, Apellidos=?, Correo=?, Codigo=?, Imagen_croquis=? WHERE id=?";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
    
        // La cadena de definición de tipo debe incluir también el tipo de dato para el parámetro de ID
        $stmt->bind_param('sssssi', $nombre, $apellidos, $correo, $codigo, $imagen, $id);
    
        if ($stmt->execute()) {
            
            return "Registro actualizado correctamente";
            
           
        } else {
            return "Error al actualizar el registro: " . $conn->error;
        }
    }
    
    function mostrarFormularioEdicion($id)
    {
        // Consulta SQL para obtener los datos del registro
        $sql = "SELECT * FROM maestros WHERE id=?";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            // Mostrar el formulario de edición con los datos actuales del registro
            $fila = $resultado->fetch_assoc();
?>
            <h2>Editar Registro</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <label for="Nombre">Nombre del maestro:</label>
                <input type="text" name="Nombre" value="<?php echo $fila['Nombre']; ?>"><br><br>
                <label for="Apellidos">Apellidos del maestro:</label>
                <input type="text" name="Apellidos" value="<?php echo $fila['Apellidos']; ?>"><br><br>
                <label for="Correo">Correo del maestro:</label>
                <input type="text" name="Correo" value="<?php echo $fila['Correo']; ?>"><br><br>
                <label for="Codigo">Codigo del maestro:</label>
                <input type="text" name="Codigo" value="<?php echo $fila['Codigo']; ?>"><br><br>
                <label for="Imagen_croquis">Imagen:</label>
                <input type="file" name="Imagen" value="<?php echo $fila['Imagen_croquis']; ?>"><br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
<?php
       /*  $maestro = new Maestro();
        $maestro->editarMaestro($id_maestro, $nombre, $apellidos, $correo, $codigo, $imagen); */
        } else {
            echo "No se encontró ningún registro con el ID proporcionado";
        }
    }
    // Función para eliminar un registro basado en el ID
    function eliminarRegistro($id) {
        
        $conn = $this->connect();
        // Verifica la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }
        
        // Prepara la consulta SQL para eliminar el registro con el ID proporcionado
        $consulta = $conn->prepare("DELETE FROM maestros WHERE id = ?");
        
        // Vincula el parámetro ID a la consulta preparada
        $consulta->bind_param("i", $id);
        
        // Ejecuta la consulta
        if ($consulta->execute()) {
            echo "Registro eliminado correctamente.";
        } else {
            echo "Error al eliminar el registro: " . $conn->error;
        }
        
        // Cierra la conexión y la consulta
        $consulta->close();
        $conn->close();
    }
    
}
?>
