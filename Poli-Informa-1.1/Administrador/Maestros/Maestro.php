<!-- <?php include '../LoginA/inicio.php'; ?> -->

<?php
require_once '../../Conexion/conexion.php'; // Asegúrate de incluir tu clase Database aquí

class Maestro extends Database
{
    public function crearMaestro($nombre, $apellidos, $correo, $codigo, $imagen,$imagen_croquis)
    {
        $conn = $this->connect();

        // Directorio de destino para la imagen
        $directorio_destino = "ImgCroquis/";

        // Obtener el nombre del archivo y la ubicación temporal

        $nombre_archivo_croquis = $_FILES["imagen_croquis2"]["name"];
        $ubicacion_temporal_croquis = $_FILES["imagen_croquis2"]["tmp_name"];

        $nombre_archivo = $_FILES["imagen_croquis"]["name"];
        $ubicacion_temporal = $_FILES["imagen_croquis"]["tmp_name"];

        // Mover el archivo al directorio de destino
        $ruta_destino = $directorio_destino . $nombre_archivo;
        $ruta_destino_croquis = $directorio_destino . $nombre_archivo_croquis;
        if (move_uploaded_file($ubicacion_temporal, $ruta_destino)) {
            echo "Imagen subida correctamente.";
            if (move_uploaded_file($ubicacion_temporal_croquis, $ruta_destino_croquis)) {
                echo "Imagen subida correctamente.";
            } else {
                echo "Error al subir la imagen.";
            }
        } else {
            echo "Error al subir la imagen.";
        }

        // Preparar la consulta con marcadores de posición
        $sql = "INSERT INTO maestros (Nombre, Apellidos, Correo, Codigo, Imagen, imagen_croquis)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("ssssss", $nombre, $apellidos, $correo, $codigo, $nombre_archivo, $nombre_archivo_croquis);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Registro creado correctamente.";
        } else {
            echo "Error al crear el registro: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    }


    public function PerfilMaestros($id, $db)
    {
        // Preparar la consulta SQL para seleccionar un maestro basado en su ID
        $sql = "SELECT * FROM maestros WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Obtener el perfil del maestro    
            $row = $result->fetch_assoc();


?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                <title>Perfil</title>
            </head>

            <body>
                <style>
                    .gradient-custom {
                        /* fallback for old browsers */
                        background: #f6d365;

                        background: linear-gradient(to right bottom, rgba(51, 196, 255), black);
                        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                    }

                    .card {
                        border-radius: 0.5rem;
                        overflow: hidden;
                    }

                    .card-body {
                        padding: 1.5rem;
                    }

                    .card h6 {
                        font-weight: 500;
                    }

                    .card hr {
                        border: 0;
                        height: 1px;
                        background-image: linear-gradient(to right, rgba(0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0));
                    }

                    .card p {
                        margin-bottom: 0;
                    }

                    .card-img-top {
                        width: 80px;
                        height: 80px;
                        object-fit: cover;
                    }

                    p{
                        font-size: 20px;
                    }

                    .social-links a {
                        font-size: 1.75rem;
                        margin-right: 0.5rem;
                        color: #333;
                        transition: color 0.2s;
                    }

                    .social-links a:hover {
                        color: #555;
                    }
                </style>


                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex justify-content-center align-items-center h-100">
                            <div class="col col-lg-6 mb-4 mb-lg-0">
                                <div class="card mb-3" style="border-radius: .5rem;">
                                    <div class="row g-0">
                                        <div class="col-md-4 gradient-custom text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                            <img src="../Maestros/ImgCroquis/<?php echo $row['Imagen']; ?>" alt="Avatar" class="img-fluid my-5" style="width: 120px;" />
                                            <h5><?php echo $row["Nombre"] ?></h5>
                                            <p><?php echo $row["Apellidos"] ?></p>
                                            <i class="far fa-edit mb-5"></i>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body p-4">
                                                <h4>Información personal</h4>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h5>Email</h5>
                                                        <p class="text-muted"><?php echo $row["Correo"] ?></p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h5>Codigo UDG</h5>
                                                        <p class="text-muted"><?php echo $row["Codigo"] ?></p>
                                                    </div>
                                                </div>
                                                <h6>Projects</h6>
                                                <hr class="mt-0 mb-4">
                                                <div class="row pt-1">
                                                    <div class="col-6 mb-3">
                                                        <h5>Nombre</h5>
                                                        <p class="text-muted"><?php echo $row["Nombre"] ?></p>
                                                    </div>
                                                    <div class="col-6 mb-3">
                                                        <h5>Apelidos</h5>
                                                        <p class="text-muted"><?php echo $row["Apellidos"] ?></p>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </body>

            </html>
        <?php



        } else {
            echo "No se encontró ningún maestro con ese nombre.";
        }

        $stmt->close();
    }



    // Esta función te regresa una tabla de maestros
    public function MostrarMaestrosTabla()
    {
        $conn = $this->connect();

        $sql = "SELECT * FROM maestros";
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
            echo '<style>';
            echo 'body { font-family: Arial, sans-serif; }'; // Cambiar la fuente del cuerpo del documento
            echo '.container { text-align: center; }'; // Centrar todo el contenido
            echo '.table { width: 100%; border-collapse: collapse; }';
            echo '.table th, .table td { padding: 12px; border: 1px solid #ddd; text-align: center; }'; // Centrar el texto en las celdas
            echo '.table th { background-color: #f2f2f2; }';
            echo '.table tr:nth-child(even) { background-color: #f9f9f9; }';
            echo '.table tr:hover { background-color: #f2f2f2; }';
            echo '.table img { max-width: 80px; height: auto; }';
            echo '.btn { display: inline-block; padding: 8px 12px; background-color: #007bff; color: #fff; text-decoration: none; border: none; border-radius: 4px; cursor: pointer; }';
            echo '.btn:hover { background-color: #0056b3; }';
            echo '</style>';

            echo '<div class="container">';
            echo '<center><h1>Tabla de maestros</h1></center>';
            echo "<div style='text-align: center; margin-bottom: 20px; font-family: Arial, sans-serif;'>";
            echo "<div style='display: inline-block; margin-right: 10px;'><a href='../../Administrador/Maestros/index.php' style='text-decoration: none; color: white; background-color: #6610f2; padding: 10px 20px; border-radius: 5px;'>Agregar Maestro</a></div>";
            echo "</div>";
            echo '<table class="table">';
            echo '<tr>';
            echo '<th>Nombre</th>';
            echo '<th>Apellidos</th>';
            echo '<th>Código</th>';
            echo '<th>Correo</th>';
            echo '<th>Croquis</th>';
            echo '<th>Imagen</th>';
            echo '<th>Editar</th>';
            echo '<th>Eliminar</th>';
            echo '</tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td><a href="ControllerShowProfile.php?id=' . $row["id"] . '" class="btn">' . $row["Nombre"] . '</a></td>'; // Convertir el nombre en un botón
                echo '<td>' . $row["Apellidos"] . '</td>';
                echo '<td>' . $row["Codigo"] . '</td>';
                echo '<td>' . $row["Correo"] . '</td>';
                echo '<td><img src="ImgCroquis/' . $row["imagen_croquis"] . '" alt="Imagen de croquis"></td>';
                echo '<td><img src="ImgCroquis/' . $row["Imagen"] . '" alt="Imagen de Maestro"></td>';
                echo '<td><a href="formularioEdit.php?id=' . $row["id"] . '" class="btn">Editar</a></td>';
                echo '<td><a href="ControllerDelete.php?id=' . $row["id"] . '" class="btn">Eliminar</a></td>';
                echo '</tr>';
            }
            echo '</table>';
            echo '</div>'; // Cerrar el contenedor
        } else {
            echo "0 resultados";
        }
        ?>
        </section>
    </main>
</div>
<?php
    }


    function editarRegistro($id, $nombre, $apellidos, $correo, $codigo, $imagen)
    {
        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE maestros SET Nombre=?, Apellidos=?, Correo=?, Codigo=?, Imagen= $imagen WHERE id=?";
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


    public function editarMaestroSoloInfo($id, $nombre, $apellidos, $correo, $codigo){

        // Consulta SQL para actualizar el registro en la base de datos
        $sql = "UPDATE maestros SET Nombre=?, Apellidos=?, Correo=?, Codigo=? WHERE id=?";
        $conn = $this->connect();
        $stmt = $conn->prepare($sql);

        // La cadena de definición de tipo debe incluir también el tipo de dato para el parámetro de ID
        $stmt->bind_param('ssssi', $nombre, $apellidos, $correo, $codigo, $id);

        if ($stmt->execute()) {

            return "Registro actualizado correctamente";
            
        } else {
            return "Error al actualizar el registro: " . $conn->error;
        }
    }




    // Función para eliminar un registro basado en el ID
    function eliminarRegistro($id)
    {

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