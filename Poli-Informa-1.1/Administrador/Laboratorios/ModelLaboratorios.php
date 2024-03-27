<?php
require_once '../../Conexion/conexion.php'; // Asegúrate de incluir tu clase Database aquí


class Laboratorio extends Database{


    public function crearLaboratorio($nombre) {
        $conn = $this->connect();
        // Preparar la consulta con marcadores de posición
        $sql = "INSERT INTO laboratorios (Nombre)
                VALUES (?)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("s", $nombre);

        // Ejecutar la consulta
        if ($stmt->execute()) {
          
        } else {
            echo "Error al crear el registro: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }

     //Esta funcion te regresa una tabla de maestros
     public function MostrarLaboratoriosTabla() {
        $conn = $this->connect();

        $sql = "SELECT * FROM laboratorios";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            echo '<center><h1>Tabla de Laboratorios</h1></center>';
            echo '<table style="border-collapse: collapse; width: 100%;">';
            echo '<tr>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Nombre</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Editar</th>';
            echo '<th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Eliminar</th>';

           
            echo '</tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;">' . $row["Nombre"] . '</a></td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="ControllerEdit.php?id=' . $row["id"] . '">Editar</a></td>';
                echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px;"><a href="ControllerDelete.php?id=' . $row["id"] . '">Eliminar</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "0 resultados";
        }
    }


    function editarRegistro($id, $nombre)
{
    // Consulta SQL para actualizar el registro en la base de datos
    $sql = "UPDATE laboratorios SET Nombre=? WHERE id=?";
    $conn = $this->connect();
    $stmt = $conn->prepare($sql);

    // La cadena de definición de tipo debe incluir el tipo de dato para cada parámetro
    $stmt->bind_param('si', $nombre, $id); // 'si' indica que el primer parámetro es una cadena y el segundo es un entero

    if ($stmt->execute()) {
        return "Registro actualizado correctamente";
    } else {
        return "Error al actualizar el registro: " . $conn->error;
    }
}

    
    function mostrarFormularioEdicion($id)
    {
        // Consulta SQL para obtener los datos del registro
        $sql = "SELECT * FROM laboratorios WHERE id=?";
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
                <label for="Nombre">Nombre del laboratorio:</label>
                <input type="text" name="Nombre" value="<?php echo $fila['Nombre']; ?>"><br><br>

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
        $consulta = $conn->prepare("DELETE FROM laboratorios WHERE id = ?");
        
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