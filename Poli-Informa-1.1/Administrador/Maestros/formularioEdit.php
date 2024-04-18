<?php
require_once '../../Conexion/conexion.php'; // Asegúrate de incluir tu clase Database aquí
$database = new Database();
$conn = $database->connect();


if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$sql = "SELECT * FROM maestros WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    // Mostrar el formulario de edición con los datos actuales del registro
    $fila = $resultado->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        #editForm {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="file"] {
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

        #imagePreview {
            max-width: 100%;
            margin-bottom: 15px;
            display: none;
        }
    </style>
</head>

<body>
    <h2>Editando a <?php echo $fila['Nombre']?></h2>
    <form method="post" action="ControllerEdit.php" enctype="multipart/form-data" >
        <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">

        <label for="Nombre">Nombre del maestro:</label>
        <input type="text" name="Nombre" value="<?php echo $fila['Nombre']; ?>"><br>

        <label for="Apellidos">Apellidos del maestro:</label>
        <input type="text" name="Apellidos" value="<?php echo $fila['Apellidos']; ?>"><br>

        <label for="Correo">Correo del maestro:</label>
        <input type="text" name="Correo" value="<?php echo $fila['Correo']; ?>"><br>

        <label for="Codigo">Codigo del maestro:</label>
        <input type="text" name="Codigo" value="<?php echo $fila['Codigo']; ?>"><br>

        <label for="Imagen_croquis">Imagen:</label>
        <input type="file" name="imagen"><br>
        <!-- <img id="imagePreview" alt="Previsualización de la imagen"> -->

        <input type="submit" value="Guardar Cambios" name="Editar">
    </form>

    <script>
        document.getElementById('previewImage').onchange = function(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function() {
                var dataURL = reader.result;
                var output = document.getElementById('imagePreview');
                output.src = dataURL;
                output.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        };
    </script>
</body>
</html>

<?php
            /*  $maestro = new Maestro();
        $maestro->editarMaestro($id_maestro, $nombre, $apellidos, $correo, $codigo, $imagen); */
        } else {
            echo "No se encontró ningún registro con el ID proporcionado";
        }