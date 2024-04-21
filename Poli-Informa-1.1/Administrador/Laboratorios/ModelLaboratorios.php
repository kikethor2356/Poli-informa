<!-- <?php include '../../LoginAdministrador/inicio.php'; ?> -->

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

     // Esta función te regresa una tabla de maestros
public function MostrarLaboratoriosTabla() {
    $conn = $this->connect();
    
    $sql = "SELECT * FROM laboratorios";
    $result = $conn->query($sql);

    ?>
        <link rel="stylesheet" href="../Menu/menu.css">

    <style>
        #productos{
            position: absolute;
            left: 0%;
            top: 0%;
            width: 100%;
            height: 100vh;
        }

        #principal-productos{
            position: absolute;
        }

        #principal-productos{
            width: 85%;
            height: 100%;
            top: 0%;
            left: 15%;
            background-color: white;
        }
    </style>
    <div id="productos">

    <main id="principal-productos">
        <section id="section-productos">
        <?php include '../Menu/menu.html';?>

            <?php
            if ($result->num_rows > 0) {
                echo '<center><h1 style="margin-bottom: 20px; font-family: Arial;">Tabla de Aulas</h1></center>';
                echo "<div style='text-align: left; margin-bottom: 20px;'><a href='../../Administrador/Laboratorios/index.php' style='text-decoration: none; color: white; background-color: green; padding: 10px 20px; border-radius: 5px; display: inline-block; font-family: Arial;'>Agregar Laboratorio</a></div>";
                echo '<table style="border-collapse: collapse; width: 100%; border: 2px solid #ddd; font-size: 22px; font-family: Arial;">';
                echo '<tr>';
                echo '<th style="border: 1px solid #dddddd; color:white; text-align: left; padding: 8px; background-color:#343a40 ;">Nombre</th>';
                echo '<th style="border: 1px solid #dddddd; color:white; text-align: left; padding: 8px; background-color:#343a40;">Editar</th>';
                echo '<th style="border: 1px solid #dddddd; color:white; text-align: left; padding: 8px; background-color:#343a40;">Eliminar</th>';
                echo '</tr>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-family: Arial;">' . $row["Nombre"] . '</td>';
                    echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-family: Arial;"><a href="ControllerEdit.php?id=' . $row["id"] . '" style="text-decoration: none; color: black; background-color:#17a2b8; padding: 5px 10px; border-radius: 5px;">Editar</a></td>';
                    echo '<td style="border: 1px solid #dddddd; text-align: left; padding: 8px; font-family: Arial;"><a href="ControllerDelete.php?id=' . $row["id"] . '" style="text-decoration: none; color: black; background-color:#dc3545; padding: 5px 10px; border-radius: 5px;">Eliminar</a></td>';
                    echo '</tr>';
                }
                echo '</table>';
            } else {
                echo "<p style='margin-top: 20px; text-align: center; font-size: 18px; font-family: Arial;'>No se encontraron resultados.</p>";
            }
            ?>
            </section>
        </main>
    </div>
    <?php
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
        <!DOCTYPE html>
        <html lang="es">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Editar Registro</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f5f5f5;
                    margin: 0;
                    padding: 0;
                }

                form {
                    max-width: 400px;
                    margin: 20px auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                label {
                    font-weight: bold;
                    color: #555;
                }

                input[type="text"] {
                    width: 100%;
                    padding: 10px;
                    margin-bottom: 15px;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                input[type="submit"] {
                    background-color: #007bff;
                    color: white;
                    padding: 15px 20px;
                    border: none;
                    border-radius: 4px;
                    cursor: pointer;
                    font-size: 16px;
                    width: 100%;
                    transition: background-color 0.3s ease;
                }

                input[type="submit"]:hover {
                    background-color: #0056b3;
                }
            </style>
        </head>

        <body>
            <h2>Editar Registro</h2>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                <label for="Nombre">Nombre del laboratorio:</label>
                <input type="text" name="Nombre" value="<?php echo $fila['Nombre']; ?>"><br><br>

                <input type="submit" value="Guardar Cambios">
            </form>
        </body>

        </html>
<?php
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